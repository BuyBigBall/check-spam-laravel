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
use App\Models\TrashMail;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;



class MicroPayment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'email_id', 'profit_ratio', 'payed_email', 'charge_date', 'pay_type', 'pay_amount'
                    , 'expire_date', 'supply_count', 'fee', 'income'
                    , 'guest_email', 'firstname', 'lastname', 'country'
                    , 'bank', 'mode', 'type', 'deal_id', 'pay_id', 'Authrity'
                    , 'use_count'
            ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    // because "Base table or view not found: 1146 Table 'trash_mail.micro_payments' doesn't exist" 
    // deleted by yasha
    // public function email() {
    //     return $this->belongsTo('App\Models\TrashMail', 'email_id');
    // }
}
