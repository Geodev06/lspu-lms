<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable  = [
        'icon',
        'title',
        'message',
        'seen_flag',
        'receiver_id',
        'link'
    ];
}
