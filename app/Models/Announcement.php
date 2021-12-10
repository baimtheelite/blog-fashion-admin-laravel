<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = 'announcements';

    public function scopeIsHighLight()
    {
        return $this->where('is_highlight', 'true');
    }
}
