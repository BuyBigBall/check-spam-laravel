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
use App\Models\User;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;



class UserOption extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'email_id', 'email_key', 'from_ips', 'test_ips'
                        , 'xmt_token', 'use_micropay', 'pay_types'];

    public function user() {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function email() {
        return $this->belongsTo('App\Models\TrashMail', 'id', 'email_id');
    }

    public static function getOption($user_id)
    {
        $options = UserOption::where('user_id', $user_id)->first();

        if ($options) {
            return $options;
        }
        return false;
    }

}
