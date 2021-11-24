<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Visitor extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['id', 'user_ip', 'test_count', 'test_email', 'mail_id'];

    public function sluggable(): array
    {
        return [
            //'slug' => [
                //'source' => 'title'
            //]
        ];
    }
}
