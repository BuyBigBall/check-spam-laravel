<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Transaction extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['id', 'charge_date', 'user_id', 'email_id', 'price_type','price', 'qty', 'mode', 'authority', 'bank', 'type', 'income', 'gift', 'balance_id', 'remain_time'
                        ,'mail_addr'
                        ,'firstname'
                        ,'lastname'
                        ,'company'
                        ,'vatnum'
                        ,'address'
                        ,'postcode'
                        ,'city'
                        ,'telephone'
                        ,'country'
                        ,'state'
                    ];

    public function sluggable(): array
    {
        return [
            //'slug' => [
                //'source' => 'title'
            //]
        ];
    }
    
    public function balance()
    {
        return $this->hasOne('App\Models\Balance','id','balance_id');
    }
    public function profile()
    {
        return $this->hasOne('App\Models\Profile','id','user_id');
    }
    
    public function buyer() {
        return $this->belongsTo('App\Models\Profile','user_id');
    }

    public function trash_mail() {
        return $this->belongsTo('App\Models\TrashMail','email_id');
    }

}
