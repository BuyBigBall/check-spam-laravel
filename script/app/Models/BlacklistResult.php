<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Exception;

class BlacklistResult extends Model
{
    use HasFactory;

    protected $fillable = ['domain_key', 'domain_url', 'link_url', 'serverip', 'result'];
}
