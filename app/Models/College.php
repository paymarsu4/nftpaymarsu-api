<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;

    protected $fillable = ['college_name', 'acronym', 'status'];

    public function getColleges($status = 1)
    {
        return $this->select('colleges.*')->where('status', $status)->get();
    }
}
