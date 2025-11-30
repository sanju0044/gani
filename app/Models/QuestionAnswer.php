<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class QuestionAnswer extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = "question_answers";

    public function mentor()
    {
        return $this->belongsTo("\App\Models\User",  'mentor_id', 'id');
    }

    public function moderator()
    {
        return $this->belongsTo("\App\Models\User",  'approved_by', 'id');
    }

    public function student()
    {
        return $this->belongsTo("\App\Models\User",  'student_id', 'id');
    }

}
