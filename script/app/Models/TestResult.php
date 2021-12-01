<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class TestResult extends Model
{
    use HasFactory;
    use Sluggable;
    
    protected $fillable = ['mail_id', 'user_id', 'email', 'name', 'tested_at','received_at', 'subject', 'header', 'content', 'score', 'sender'];
    
    public function sluggable(): array
    {
        return [
            //'slug' => [
                //'source' => 'title'
            //]
        ];
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
