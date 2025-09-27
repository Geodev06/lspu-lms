<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivitySubmissionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_submission_id',
        'question',
        'answer',
        'correct_answer',
        'points',
        'max_points',
        'image'
    ];
}
