<?php

namespace Modules\Article\Http\Controllers;

use App\Notifications\ArticleCreated;
use App\Repositories\UserActivityRepository;
use App\Traits\GroceryCrudTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Article\Entities\Article;

class ArticleController extends Controller
{
    use GroceryCrudTrait;

    public function index()
    {
        $crud = $this->_getGroceryCrudEnterprise();

        $crud->setTable('articles');
        $crud->setSubject('Artikel');

        $crud->columns(['article_category_id', 'title', 'content', 'cover', 'status', 'publish_date', 'created_by']);
        $crud->fields(['article_category_id', 'title', 'content', 'cover', 'status', 'publish_date', 'meta_keywords', 'meta_description']);

        $crud->displayAs([
            'article_category_id' => 'Kategori Artikel',
            'created_by' => 'Dibuat oleh'
        ]);

        $crud->setRelation('created_by', 'users', 'name');
        $crud->setRelation('article_category_id', 'article_categories', 'name');

        $crud->setTexteditor(['content']);

        $crud->setFieldUpload('cover', 'storage/articles', 'storage/articles');

        $crud->requiredFields(['title', 'content']);
        // $crud->uniqueFields(['title']);


        $crud->callbackBeforeInsert(function($state) {
            $slugUnique = Article::where('slug', Str::slug($state->data['title']))->exists();
            if($slugUnique) {
                $errorMessage = new \GroceryCrud\Core\Error\ErrorMessage();
                return $errorMessage->setMessage("Slug sudah dipakai");
            }

            $state->data['slug'] = Str::slug($state->data['title']);
            $state->data['cover'] = Storage::url('articles/'. $state->data['cover']);
            $state->data['created_by'] = Auth::id();
            $state->data['updated_by'] = Auth::id();
            $state->data['created_at'] = date('Y-m-d H:i:s');
            $state->data['updated_at'] = date('Y-m-d H:i:s');

            return $state;
        });

        $crud->callbackBeforeUpdate(function($state) {
            $state->data['slug'] = Str::slug($state->data['title']);
            $state->data['cover'] = Storage::url('articles/'. $state->data['cover']);
            $state->data['updated_by'] = Auth::id();
            $state->data['updated_at'] = date('Y-m-d H:i:s');

            return $state;
        });

        $crud->callbackAfterInsert(function ($stateParameters) {
            $id = $stateParameters->insertId;
            $article = Article::find($id);

            Auth::user()->notify(new ArticleCreated($article));

            UserActivityRepository::insertLog('Artikel', Auth::user()->name . " Membuat Artikel"); //insert log user_activities

            return $stateParameters;
        });

        $crud->callbackAfterUpdate(function ($stateParameters) {
            $id = $stateParameters->primaryKeyValue;
            $article = Article::find($id);

            UserActivityRepository::insertLog('Artikel', Auth::user()->name . " Memperbarui Artikel"); //insert log user_activities

            return $stateParameters;
        });


        $output = $crud->render();

        return $this->_show_output($output, 'article::index');
    }
}
