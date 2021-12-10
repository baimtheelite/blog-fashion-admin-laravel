<?php

namespace Modules\Article\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;
use Modules\Article\Entities\ArticleCategory;

class ArticleCategoryController extends Controller
{
    public function index(Request $request)
    {
        $display_status = $request->input('display_status', 'active');

        $articlesCategory = ArticleCategory::query();

        $articlesCategory->when($display_status, function ($query) use ($display_status) {
            return $query->where('display_status', $display_status);
        });

        if ($articlesCategory) {
            return ResponseFormatter::success(
                $articlesCategory->get(),
                'Data Kategori Artikel berhasil diambil'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Data Kategori Artikel tidak ada',
                404
            );
        }
    }
}
