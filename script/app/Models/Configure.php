<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Configure extends Model
{
    use HasFactory;
    use Sluggable;


    protected $fillable = [
        'user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'private_key',
        'server_ips',
        'client_ips',
        'x_mt_tocken',
        'micro_payment'
    ];

    // public function posts()
    // {
    //     return $this->hasMany(Post::class);
    // }
    public static function selectConfigures($user_id)
    {
        $configures = Configure::where('user_id', $user_id)->first();

        if ($configures) {
            return $configures;
        }
        return false;
    }

    public function sluggable(): array
    {
        return [
            // 'slug' => [
            //     'source' => 'name'
            // ]
        ];
    }
}
