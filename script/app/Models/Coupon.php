<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Coupon extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['id', 'user_id', 'coupon_code', 'coupon_type', 'coupon_amt','expiry_date','state'];

    public function sluggable(): array
    {
        return [
            //'slug' => [
                //'source' => 'title'
            //]
        ];
    }

    public function user() {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
