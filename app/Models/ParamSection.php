<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamSection extends Model
{
    use HasFactory;
    protected $fillable = ['org_code','section_name','school_year'];
}
