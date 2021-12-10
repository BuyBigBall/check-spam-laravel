<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Exception;



class MailBrokenlinkCheck extends Model
{
    use HasFactory;

    protected $fillable = ['mail_id', 'cron_number'];
}
