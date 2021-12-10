<?php

namespace App\Traits;

use GroceryCrud\Core\GroceryCrud;

trait GroceryCrudTrait {
    private function _getDatabaseConnection()
    {
        $databaseConnection = config('database.default');
        $databaseConfig = config('database.connections.' . $databaseConnection);


        return [
            'adapter' => [
                'driver' => 'Pdo_Mysql',
                'host' => $databaseConfig['host'],
                'database' => $databaseConfig['database'],
                'username' => $databaseConfig['username'],
                'password' => $databaseConfig['password'],
                'charset' => 'utf8'
            ]
        ];
    }

    private function _getGroceryCrudEnterprise()
    {
        $database = $this->_getDatabaseConnection();
        $config = config('grocerycrud');

        $crud = new GroceryCrud($config, $database);

        $crud->setSkin('bootstrap-v4');


        return $crud;
    }

    private function _show_output($output, $view, $data = [])
    {
        if ($output->isJSONResponse) {
            return response($output->output, 200)
                  ->header('Content-Type', 'application/json')
                  ->header('charset', 'utf-8');
        }

        $css_files = $output->css_files;
        $js_files = $output->js_files;
        $output = $output->output;
        // dd([
        //     $css_files, $js_files
        // ]);
        return view($view, [
            'output' => $output,
            'css_files' => $css_files,
            'js_files' => $js_files,
            'data' => $data
        ]);
    }

    // public function datagrid()
    // {
    //     $crud = $this->_getGroceryCrudEnterprise();

    //     $crud->setTable('service_categories');
    //     $crud->setSubject('Service Category', 'Service Categories');

    //     $crud->where(['service_categories.parent_id IS NULL']);

    //     $crud->unsetEdit();
    //     $crud->unsetAdd();

    //     $crud->unsetColumns(['category_service_slug', 'keterangan', 'parent_id', 'created_by', 'modified_by', 'created_at', 'modified_by', 'created_at', 'updated_at']);

    //     $crud->displayAs([
    //         'category_service_name' => 'Nama Kategori',
    //         'category_icon' => 'Icon'
    //     ]);

    //     $crud->callbackColumn('display_status', function ($value, $row) {
    //         if($value == 0)
    //             return "Tidak Aktif";
    //         if($value == 1)
    //             return "Aktif";
    //     });

    //     $crud->callbackColumn('feature_status', function ($value, $row) {
    //         if($value == 0)
    //             return "Tidak Aktif";
    //         if($value == 1)
    //             return "Aktif";
    //     });

    //     $crud->callbackColumn('category_icon', function ($value, $row) {
    //          return "<img style='width: 35%' alt='icon' src='" . Storage::url($value) . "'>";
    //     });

    //     $crud->callbackColumn('category_service_name', function ($value, $row) {
    //         return "<a href='" . route('services.category.edit', $row->id) . "'>". $value ."</a>";
    //     });

    //     $output = $crud->render();

    //     return $this->_show_output($output, 'service::categories.index');
    // }
}
