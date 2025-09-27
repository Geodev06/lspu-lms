<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamLearningCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'banner',
        'org_code',
        'created_by',
        'active_flag',
        'course_code'
    ];
}
