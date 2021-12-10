<?php

namespace Modules\Article\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleCategory extends Model
{
    protected $guarded = [];
    protected $table = 'article_categories';

    public function creator()
    {
        return $this->belongsTo(Article::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(Article::class, 'updated_by');
    }
}
