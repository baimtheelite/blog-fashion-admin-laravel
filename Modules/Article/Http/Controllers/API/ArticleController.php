<?php

namespace Modules\Article\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $show = $request->input('show', 5);
        $keywords = $request->input('keywords', '');

        $articles = Article::query()
            ->select('id', 'article_category_id', 'title', 'slug', 'meta_description', 'cover', 'status', 'publish_date', 'created_by', 'updated_by')
            ->active()
            ->with('category')
            ->with('editor')
            ->with('author');

        $articles->when($keywords, function ($query) use ($keywords) {
            $query->where('title', 'like', "%{$keywords}%");
        });

        $articles->when($show, function ($query) use ($show) {
            $query->limit($show);
        });

        if ($articles->count() > 0) {
            return ResponseFormatter::success(
                $articles->get(),
                'Data Artikel berhasil diambil'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Data Artikel tidak ada',
                404
            );
        }
    }

    public function show($slug)
    {

        $article = Article::query()
            ->active()
            ->with('category')
            ->with('editor')
            ->with('author')
            ->where('slug', $slug);

        if ($article->count() > 0) {
            return ResponseFormatter::success(
                $article->first(),
                'Data Detail Artikel berhasil diambil'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Data Artikel tidak ada',
                404
            );
        }
    }
}
