<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelHasRole extends Model
{
    use HasFactory;

    protected $fillable = ['role_id', 'model_type', 'model_id'];
    protected $table = 'model_has_roles';
}
