<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningCourseModality extends Model
{
    use HasFactory;
    protected $fillable = [
        'learning_course_id',
        'modality_code'
    ];
}
