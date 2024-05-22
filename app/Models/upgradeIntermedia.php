<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpgradeIntermedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'like_pressed',
        'user_id',
        'upgrade_id'
    ];
}
