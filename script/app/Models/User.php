<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 
        'name',
        'email',
        'password',
        'role',
        'mode',
        'remember_token',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'avater',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function TestResults() {
        return $this->hasMany('App\Models\TestResult');
    }
    public function useroption() {
        return $this->hasOne('App\Models\UserOption');
    }
    public function profile() {
        return $this->hasMany('App\Models\Profile');
    }
    public function trashmail() {
        return $this->hasMany('App\Models\TrashMail',  'user_id', 'id');
    }
    public function default() {
        return $this->hasOne('App\Models\Profile')->where('default_address','=', 1);
    }
}
