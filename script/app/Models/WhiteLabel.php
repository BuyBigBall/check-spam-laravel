<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class WhiteLabel extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['id', 'user_id', 'email', 'css', 'active'];

    public function sluggable(): array
    {
        return [
            //'slug' => [
                //'source' => 'title'
            //]
        ];
    }
}
