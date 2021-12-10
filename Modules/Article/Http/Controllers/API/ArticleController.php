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
        $show = $request->input('show', 10);

        $articles = Article::query()
            // ->with('')
            ->with('category')
            ->with('editor')
            ->with('author');

        if ($articles) {
            return ResponseFormatter::success(
                $articles->simplePaginate($show),
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
}
