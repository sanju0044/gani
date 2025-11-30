<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongsTo("\App\Models\User",  'student_id', 'id');
    }
}
