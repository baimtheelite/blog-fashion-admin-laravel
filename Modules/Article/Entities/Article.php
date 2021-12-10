<?php

namespace Modules\Article\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    protected $table = 'articles';
    protected $guarded = [];

    public function category()
    {
        // return $this->belongsToMany(ArticleCategory::class, 'article_article_categories', 'article_id', 'article_category_id');
        return $this->belongsTo(ArticleCategory::class, 'article_category_id')->select('id', 'name', 'slug', 'display_status');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by')->select('id', 'name');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by')->select('id', 'name');
    }
}
