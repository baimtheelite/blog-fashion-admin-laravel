<?php

namespace App\Http\Controllers;

use App\Repositories\FCMNotificationRepository;
use App\Traits\GroceryCrudTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    use GroceryCrudTrait;

    public function index()
    {
        $crud = $this->_getGroceryCrudEnterprise();

        $crud->setTable('announcements');
        $crud->setSubject('Pengumuman');

        $crud->defaultOrdering('created_at', 'desc');

        $crud->columns(['text', 'is_highlight', 'created_by', 'created_at']);
        $crud->fields(['text', 'is_highlight']);

        $crud->displayAs([
            // 'article_category_id' => 'Kategori Artikel',
            // 'created_by' => 'Dibuat oleh'
        ]);

        $crud->setRelation('created_by', 'users', 'name');
        $crud->setRelation('updated_by', 'users', 'name');

        $crud->setTexteditor(['text']);

        // $crud->setFieldUpload('cover', 'storage/articles', 'storage/articles');


        $crud->callbackBeforeInsert(function ($state) {
            $state->data['created_by'] = Auth::id();
            $state->data['updated_by'] = Auth::id();
            $state->data['created_at'] = date('Y-m-d H:i:s');
            $state->data['updated_at'] = date('Y-m-d H:i:s');

            return $state;
        });

        $crud->callbackBeforeUpdate(function ($state) {
            $state->data['updated_by'] = Auth::id();
            $state->data['updated_at'] = date('Y-m-d H:i:s');

            return $state;
        });

        $crud->callbackAfterInsert(function ($stateParameters) {
            // $id = $stateParameters->insertId;
            // $article = Article::find($id);

            // Auth::user()->notify(new ArticleCreated($article));

            // UserActivityRepository::insertLog('Artikel', Auth::user()->name . " Membuat Artikel"); //insert log user_activities
            FCMNotificationRepository::sendNotification2('Pengumuman', Auth::user()->name . " Membuat Pengumuman");

            return $stateParameters;
        });

        $crud->callbackAfterUpdate(function ($stateParameters) {
            $id = $stateParameters->primaryKeyValue;
            // $article = Article::find($id);

            // UserActivityRepository::insertLog('Artikel', Auth::user()->name . " Memperbarui Artikel"); //insert log user_activities

            return $stateParameters;
        });


        $output = $crud->render();

        return $this->_show_output($output, 'announcements');
    }
}
