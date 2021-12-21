<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ddeboer\Imap\Server;
use Ddeboer\Imap\Message;
use Carbon\Carbon;
use Ddeboer\Imap\SearchExpression;
use Ddeboer\Imap\Search\Email\To;
use Ddeboer\Imap\Search\Email\Cc;
use Ddeboer\Imap\Search\Email\Bcc;
use Ddeboer\Imap\Message\Attachment;
use Exception;
use App\Models\Settings;
use App\Models\MailBlacklistCheck;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;



class TrashMail extends Model
{
    use HasFactory;

    protected $fillable = ['delete_in', 'email', 'user_id'];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function useroption() {
        return $this->hasOne('App\Models\UserOption', 'email_id');
    }

    public static function connection($email = null)
    {
        
        $flag = '/imap/' . Settings::selectSettings('imap_encryption') ;
        if(Settings::selectSettings('imap_certificate') == 0){
            $flag .= '/novalidate-cert';
        }else{
            $flag .= '/validate-cert';
        }

        try
        {
            $server = new Server(Settings::selectSettings('imap_host'),Settings::selectSettings('imap_port'),$flag);
            if($email==null)
                $connection = $server->authenticate(Settings::selectSettings('imap_user'), Settings::selectSettings('imap_pass'));
            else
                $connection = $server->authenticate($email, env('TEMPORARY_MAIL_PASSWORD'));
        }
        catch (Exception $e)
        {
            return null;
        }
        return $connection;
    }

    public static function GetLastUnreadMail($email)
    {
        # look for unread message for me
        $results = TrashMail::allMessages($email, false);   // from cache
        foreach($results["messages"] as $key=>&$last_message)
        {
            if( !empty($last_message['error'])) continue;
            // if( in_array($email, $last_message["to"][]->getAddress()) ||
            //     in_array($email, $last_message["cc"][]->getAddress()) ||
            //     in_array($email, $last_message["bcc"][]->getAddress()) 
            //     )
            {
                if(!$last_message['is_seen'])
                {
                    $id = $last_message['id'];  // this will be $Hashid
                    return $last_message;
                }
            }
            break;
        }
		return null;
    }
  
    public static function GetLastReceiveMail($email)
    {
        # look for unread message for me
        $results = TrashMail::allMessages($email);
		
        foreach($results["messages"] as $key=>&$last_message)
        {
            if( !empty($last_message['error'])) continue;

            //if($last_message['is_seen'])
            {
                $id = $last_message['id'];
				return $id;  // this will be $Hashid
            }
            break;
        }
		return null;
    }
  

    public static function allMessages($email, $asSeenFlag = null)
    {
        //Cache::Flush(); 

        $response = [
            'mailbox' => $email,
            'messages' => []
        ];
        
        try {
            $connection = TrashMail::connection(env('MAIL_FROM_ADDRESS'));
            if($connection==null)
            {
                $response['messages'][] = ['error'=>'Server settings Exception'];
                return $response;
            }
            
            $mailbox = $connection->getMailbox('INBOX');
            
            $search = new SearchExpression();
            $search->addCondition(new To($email));
            // $search->addCondition(new Cc($email));
            $messages = $mailbox->getMessages($search, \SORTDATE, true);
            
            // added by yasha for refresh asseenmark
            // if(!empty($asSeenFlag)) Cache::Flush(); 
            //<---
            
            foreach ($messages as $message) {

                $Hashid = Hashids::encode($message->getNumber());
                
                if( $asSeenFlag!=null)
                if (!$message->isSeen()) {
                    // //deleted 2021.11.20 by yasha
                    //     Settings::updateSettings(
                    //         'total_messages_received',
                    //         Settings::selectSettings('total_messages_received') + 1
                    //     );
                    $message->markAsSeen(); 
                }
                
                $cashtime = Settings::selectSettings("email_lifetime") * Settings::selectSettings("email_lifetime_type") * 60;
                $data = Cache::remember(
                    $Hashid, 
                    $cashtime, 
                    function () use ($message, $Hashid) 
                    {
                        $sender = $message->getFrom();
                        $date = $message->getDate();
                        $date = new Carbon($date);
                       
                        $data['subject'] = $message->getSubject();
                        $data['is_seen'] = $message->isSeen();
                        $data['from'] = $sender->getName();
                        $data['from_email'] = $sender->getAddress();
                        $data['receivedAt'] = $date->format('Y-m-d H:i:s');
                        $data['id'] = $Hashid;
                        $data['no'] = $message->getNumber();    //added by yasha
                        $data['to']  = $message->getTo();
                        $data['cc']  = $message->getCc();
                        $data['bcc'] = $message->getBcc();
                        $data['attachments'] = [];
                        $data['header'] = $message->getRawHeaders();

                        $html = $message->getBodyHtml();
                        if ($html) {
                            $data['content'] = str_replace('<a', '<a target="blank"', $html);
                        } else {
                            $text = $message->getBodyText();
                            $data['content'] = str_replace('<a', '<a target="blank"', str_replace(array("\r\n", "\n"), '<br/>', $text));
                        }

                        if ($message->hasAttachments()) {
                            $attachments = $message->getAttachments();
                            $directory = './temp/attachments/' . $message->getNumber() . '/';
                            $download = './download/' . $Hashid . '/';
                            is_dir($directory) ?: mkdir($directory, 0777, true);
                            foreach ($attachments as $attachment) {
                                $filenameArray = explode('.', $attachment->getFilename());
                                $extension = strtolower(end($filenameArray));
                                $allowed = explode(',', Settings::selectSettings('allowed_files'));
                                if (in_array($extension, $allowed)) {
                                    if (!file_exists($directory . $attachment->getFilename())) {
                                        file_put_contents(
                                            $directory . $attachment->getFilename(),
                                            $attachment->getDecodedContent()
                                        );
                                    }
                                    if ($attachment->getFilename() !== 'undefined') {
                                        $url = Settings::selectSettings('site_url') . str_replace('./', '/', $download . $attachment->getFilename());
                                        array_push($data['attachments'], [
                                            'file' => $attachment->getFilename(),
                                            'url' => $url
                                        ]);
                                    }
                                }
                            }
                        }
                        return $data;
                });

                array_push($response["messages"], $data);
            }
            return $response;
        } catch (Exception $e) {
            $response = [
                'mailbox' => "Erorr : Please Reload Page Again ",
                'messages' => []
            ];
        }
    }



    public static function DeleteEmail($email)
    {
        $receive_email = env('MAIL_FROM_ADDRESS');
        try {
            $connection = TrashMail::connection(env('MAIL_FROM_ADDRESS'));
            $mailbox = $connection->getMailbox('INBOX');
            $search = new SearchExpression();
            $search->addCondition(new To($email));
            // $search->addCondition(' OR ');
            // $search->addCondition(new Cc($email));
            // $search->addCondition(' OR ');
            // $search->addCondition(new Bcc($email));

            $messages = $mailbox->getMessages($search, \SORTDATE, true);

            foreach ($messages as $message) {

                $id = $message->getNumber();

                $hashid = Hashids::encode($message->getNumber());

                Cache::forget($hashid);

                $mailbox->getMessage($id)->delete();

                if (file_exists('../temp/attachments/' . $id)) {

                    File::deleteDirectory('../temp/attachments/' . $id);
                }
            }

            $tashmail = TrashMail::where('email', $email)->first();

            if ($tashmail) {
                $tashmail->delete();
            }

            $connection->expunge();

            return "Email Deleted \n";

        } catch (Exception $e) {
            return $e->getMessage() . "\n";
        }
    }

    public static function GetUserEmail($user_id)
    {
        $email = null;
        
        $user_email = TrashMail::where('user_id', $user_id)->get();
        
        if ( !$user_email->isEmpty()) 
        {
            $user_email = $user_email->first();
            $email = $user_email->email;
        }
        else
            return null;
        return $email;
    }

    public static function DeleteMessage($email, $id)
    {
        try {
            $receive_email = env('MAIL_FROM_ADDRESS');            
            $connection = TrashMail::connection(env('MAIL_FROM_ADDRESS'));
            $mailbox = $connection->getMailbox('INBOX');
            $mailbox->getMessage($id)->delete();
            $connection->expunge();
        } catch (Exception $e) {
            \abort(404);
        }
    }

    # this function not affect the cache's mails. only return a incoming mail from mailbox getting.
    public static function messages($email, $Hashid)
    {
        try {
            $receive_email = env('MAIL_FROM_ADDRESS');

            $id_hash = Hashids::decode($Hashid);

            $connection = TrashMail::connection(env('MAIL_FROM_ADDRESS'));
            if($connection==null)
            {
                $response = [
                    'mailbox' => $email,
                    'messages' => []
                ];                
                $response['messages'][] = ['error'=>'Server settings Exception'];
                return $response;
            }
                        
            $mailbox = $connection->getMailbox('INBOX');
            $message = $mailbox->getMessage($id_hash[0]);

            $response = [];
            
            $message->markAsSeen(); //added by yasha

            $sender = $message->getFrom();
            $date = $message->getDate();
            $date = new Carbon($date);
            $data['subject'] = $message->getSubject();
            $data['is_seen'] = $message->isSeen();
            $data['from'] = $sender->getName();
            $data['from_email'] = $sender->getAddress();
            $data['receivedAt'] = $date->format('Y-m-d H:i:s');
            $data['id'] = $Hashid;
            $data['no'] = $message->getNumber();    //added by yasha
            $data['to']  = $message->getTo();
            $data['cc']  = $message->getCc();
            $data['bcc'] = $message->getBcc();
            $data['attachments'] = [];
            $data['header'] = $message->getRawHeaders();

            $html = $message->getBodyHtml();
            if ($html) {
                $data['content'] = str_replace('<a', '<a target="blank"', $html);
            } else {
                $text = $message->getBodyText();
                $data['content'] = str_replace('<a', '<a target="blank"', str_replace(array("\r\n", "\n"), '<br/>', $text));
            }

            if ($message->hasAttachments()) {
                $attachments = $message->getAttachments();
                $directory = './temp/attachments/' . $data['id'] . '/';
                $download = './download/' . $Hashid . '/';
                is_dir($directory) ?: mkdir($directory, 0777, true);
                foreach ($attachments as $attachment) {
                    $filenameArray = explode('.', $attachment->getFilename());
                    $extension = strtolower(end($filenameArray));
                    $allowed = explode(',', Settings::selectSettings('allowed_files'));
                    if (in_array($extension, $allowed)) {
                        if (!file_exists($directory . $attachment->getFilename())) {
                            file_put_contents(
                                $directory . $attachment->getFilename(),
                                $attachment->getDecodedContent()
                            );
                        }
                        if ($attachment->getFilename() !== 'undefined') {
                            $url = Settings::selectSettings('site_url') . str_replace('./', '/', $download . $attachment->getFilename());
                            array_push($data['attachments'], [
                                'file' => $attachment->getFilename(),
                                'url' => $url
                            ]);
                        }
                    }
                }
            }

            # added by yasha for mark as seen
            $cashtime = Settings::selectSettings("email_lifetime") * Settings::selectSettings("email_lifetime_type") * 60;
            Cache::put($Hashid, $data, $cashtime);
            ## //<-------------
            array_push($response, $data);
            //$message->markAsSeen(); comment by yasha

            return $response;
        } catch (Exception $e) {
            \abort(404);
        }
    }
	

    public static function GetLastMail()
    {
        # look for unread message for me
        $receive_email = env('MAIL_FROM_ADDRESS');

        $results = [
            'mailbox' => $receive_email,
            'messages' => []
        ];
        
        try {
            $connection = TrashMail::connection(env('MAIL_FROM_ADDRESS'));
			
            if($connection==null)
            {
                $results['messages'][] = ['error'=>'Server settings Exception'];
            }            
            else
            {
                $mailbox = $connection->getMailbox('INBOX');
                
                $search = new SearchExpression();
				
                //$search->addCondition(new To($receive_email));
				
                $messages = $mailbox->getMessages($search, \SORTDATE, true);
                
                foreach ($messages as $message) {
					//dd($message->getTo()[0]->getAddress());	
					//dd($message->getTo());	
											/*array:1 [▼
											  0 => Ddeboer\Imap\Message\EmailAddress {#1615 ▼
												-mailbox: "bfjzjwc770"
												-hostname: "mail-analyzer.com"
												-name: null
												-address: "bfjzjwc770@mail-analyzer.com"
											  }
											]*/
					//dd($message->getCc());	// []
					//dd($message->getBcc());	// []
					//dd($message->getReplyTo());
											/*array:1 [▼
											  0 => Ddeboer\Imap\Message\EmailAddress {#1615 ▼
												-mailbox: "khkj"
												-hostname: "obistar.com"
												-name: "admin"
												-address: "khkj@obistar.com"
											  }
											]
											*/
                    $mail_id = $message->getNumber();
					$Hashid = Hashids::encode($mail_id);
                    $sender = $message->getFrom();
                    $date = $message->getDate();
                    $date = new Carbon($date);
					
					$to_email = null;
					foreach($message->getTo() as $to_email_addr)
					{
						if(stripos($to_email_addr->getHostname(), env('MAIL_HOST'), 0)!==false)
						{
							$to_email = $to_email_addr; break;
						}
					}
					if($to_email==null)
					foreach($message->getCc() as $to_email_addr)
					{
						if(stripos($to_email_addr->getHostname(), env('MAIL_HOST'), 0)!==false)
						{
							$to_email = $to_email_addr; break;
						}
					}
					
					if( $to_email==null ) continue;		// error continue;
					
					$data['to_mailbox'] = $to_email->getMailbox();
					$data['to_host'] = $to_email->getHostname();
					$data['to'] = $to_email->getName();
					$data['to_email'] = $to_email->getAddress();
					
					
                    $data['subject'] = $message->getSubject();
                    $data['is_seen'] = $message->isSeen();
                    $data['from'] = $sender->getName();
                    $data['from_email'] = $sender->getAddress();
                    $data['receivedAt'] = $date->format('Y-m-d H:i:s');

                    $data['id'] = $Hashid;
                    $data['no'] = $message->getNumber();    //added by yasha
                    $data['to']  = $message->getTo();
                    $data['cc']  = $message->getCc();
                    $data['bcc'] = $message->getBcc();
					$data['header'] = $message->getRawHeaders();

                    $data['attachments'] = [];
					
					
                    if ( ($html = $message->getBodyHtml()) ) 
                    {
                        $data['content'] = str_replace('<a', '<a target="blank"', $html);
                    } else {
                        $text = $message->getBodyText();
                        $data['content'] = str_replace('<a', '<a target="blank"', str_replace(array("\r\n", "\n"), '<br/>', $text));
                    }
                    
                    if($message->isSeen()) continue;
                    
                    $mail_id = $data['no'];
                    if( !!empty(MailBlacklistCheck::where("mail_id",$mail_id)->first()))
                    {
                        array_push($results["messages"], $data);
                    }
                    //return $results;
                }
            }
        } catch (Exception $e) {
            $results = [
                'mailbox' => "Erorr : Please Reload Page Again ",
                'messages' => []
            ];
        }

		return $results;
    }
  

}
