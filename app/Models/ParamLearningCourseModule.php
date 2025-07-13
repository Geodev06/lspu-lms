<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamLearningCourseModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'learning_course_id',
        'description'
    ];

    public function files()
    {
        return $this->hasMany(ParamModuleAttachment::class, 'module_id', 'id');
    }
}
