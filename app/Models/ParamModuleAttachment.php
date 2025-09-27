<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamModuleAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id','sys_file_name','file_name','category',
        'a_flag','k_flag','v_flag','r_flag'
    ];
}
