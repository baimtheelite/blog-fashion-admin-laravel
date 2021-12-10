<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    protected $guarded = [];
    protected $table = 'user_activities';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
