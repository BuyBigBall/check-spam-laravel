<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Profile extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'address',
        'city',
        'country',
        'mail_addr',
        'company',
        'vatnum',
        'postcode',
        'telephone',
        'state',
        'default_address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'mail_addr',
        // 'company',
        // 'vatnum',
        // 'postcode',
        // 'telephone',
        // 'state',
        // 'default_address',
        'created_at',
        'updated_at'

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'timestamp',
    ];

    
    // get setting by key
    public static function selectUserProfile($userid)
    {
        $profile = Profile::where('user_id', $userid)->first();
        if ($profile) {
            return $profile->value;
        }
        return false;
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
