<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentOrg extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'college_id', 'org_name', 'org_acronym'];
}
