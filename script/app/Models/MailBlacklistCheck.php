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
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;



class MailBlacklistCheck extends Model
{
    use HasFactory;

    protected $fillable = ['mail_id', 'cron_number', 'to_email', 'checkflag', 'starttime', 'endtime'];
}
