<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Balance extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['id', 'charge_date', 'user_id', 'email_id', 'price_type','price', 'qty', 'supply', 'used', 'ending_date'];

    public function sluggable(): array
    {
        return [
            //'slug' => [
                //'source' => 'title'
            //]
        ];
    }
}
