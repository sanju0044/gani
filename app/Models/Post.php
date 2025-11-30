<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function mentor()
    {
        return $this->belongsTo("\App\Models\User",  'mentor_id', 'id');
    }

    public function commentedBy()
    {
        return $this->belongsTo("\App\Models\User",  'mentor_id', 'id')->withDefault();
    }
    
    public function moderator()
    {
        return $this->belongsTo("\App\Models\User",  'approved_by', 'id');
    }

}
