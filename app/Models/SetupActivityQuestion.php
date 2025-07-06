<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetupActivityQuestion extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'activity_id',
        'question',
        'answer',
        'points',
        'image'
    ];

}
