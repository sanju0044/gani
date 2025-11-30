<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PostComment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function commentedBy()
    {
        return $this->belongsTo("\App\Models\User",  'commented_by', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo("\App\Models\User",  'commented_by', 'id');
    }

    public function mentor()
    {
        return $this->belongsTo("\App\Models\User",  'mentor_id', 'id');
    }

    public function moderator()
    {
        return $this->belongsTo("\App\Models\User",  'approved_by', 'id');
    }
}
