<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Transaction extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['id', 'charge_date', 'user_id', 'email_id', 'price_type','price', 'qty', 'mode', 'authority', 'bank', 'type', 'income', 'gift', 'balance_id', 'remain_time'];

    public function sluggable(): array
    {
        return [
            //'slug' => [
                //'source' => 'title'
            //]
        ];
    }
}
