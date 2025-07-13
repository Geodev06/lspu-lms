<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivitySubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'course_name',
        'module_name',
        'activity_name',
        'activity_desc',
        'activity_type',
        'points',
        'grade',
        'checked_flag',
        'created_by'
    ];
}
