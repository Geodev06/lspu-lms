<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetupActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'course_id',
        'module_id',
        'org_code',
        'created_by',
        'active_flag',
        'type',
        'image',
        'ide_id',

        'a_flag',
        'k_flag',
        'v_flag',
        'r_flag',

    ];
}
