<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upgrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'zone',
        'type',
        'worry',
        'benefit',
        'state',

        'likes',
        'like_pressed',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

    
}

