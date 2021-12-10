<?php

namespace Modules\Article\Http\Controllers;

use App\Repositories\UserActivityRepository;
use App\Traits\GroceryCrudTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\Article\Entities\ArticleCategory;

class ArticleCategoryController extends Controller
{
    use GroceryCrudTrait;

    public function index()
    {
        $crud = $this->_getGroceryCrudEnterprise();

        $crud->setTable('article_categories');
        $crud->setSubject('Kategori Artikel');

        $crud->columns(['name', 'display_status']);
        $crud->fields(['name', 'display_status']);

        $crud->fieldType('display_status', 'dropdown_search', [
            'inactive' => 'Tidak Aktif',
            'active' => 'Aktif',
        ]);

        $crud->callbackBeforeInsert(function($state) {
            $state->data['slug'] = Str::slug($state->data['name']);
            $state->data['created_at'] = date('Y-m-d H:i:s');
            $state->data['updated_at'] = date('Y-m-d H:i:s');

            return $state;
        });

        $crud->callbackBeforeUpdate(function($state) {
            $state->data['slug'] = Str::slug($state->data['name']);
            $state->data['updated_at'] = date('Y-m-d H:i:s');

            return $state;
        });

        $crud->callbackAfterInsert(function ($stateParameters) {
            $id = $stateParameters->insertId;
            $articleCategory = ArticleCategory::find($id);

            UserActivityRepository::insertLog('Kategori Artikel', Auth::user()->name . " Membuat Kategori Artikel"); //insert log user_activities

            return $stateParameters;
        });

        $crud->callbackAfterUpdate(function ($stateParameters) {
            $id = $stateParameters->primaryKeyValue;
            $articleCategory = ArticleCategory::find($id);

            UserActivityRepository::insertLog('Kategori Artikel', Auth::user()->name . " Memperbarui Kategori Artikel"); //insert log user_activities

            return $stateParameters;
        });


        $output = $crud->render();

        return $this->_show_output($output, 'article::index');
    }
}
