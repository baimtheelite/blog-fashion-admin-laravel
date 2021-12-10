<?php

namespace Modules\User\Http\Controllers;

use App\Models\User;
use App\Repositories\UserActivityRepository;
use App\Traits\GroceryCrudTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\ModelHasRole;

class UserController extends Controller
{
    use GroceryCrudTrait;

    public function index()
    {
        $crud = $this->_getGroceryCrudEnterprise();

        $crud->setTable('users');
        $crud->setSubject('Users');

        $crud->columns(['name', 'email']);
        $crud->fields(['name', 'email', 'password']);

        $crud->requiredFields(['name', 'email']);
        $crud->uniqueFields(['email']);
        $crud->fieldType('password', 'password');

        $crud->setActionButton('Role', 'fa fa-sign-in', function($row){
            return route('user.roles', $row->id);
        }, 'false');

        $crud->callbackBeforeInsert(function($stateParameters) {
            $stateParameters->data['password'] = bcrypt($stateParameters->data['password']);
            $stateParameters->data['created_at'] = date('Y-m-d H:i:s');
            $stateParameters->data['updated_at'] = date('Y-m-d H:i:s');

            return $stateParameters;
        });

        $crud->callbackEditField('password', function($fieldValue, $primaryKeyValue, $rowData){
            return '<input class="form-control" name="password" type="password" value="">';
        });

        $crud->callbackBeforeUpdate(function($stateParameters) {
            if($stateParameters->data['password']) {
                $stateParameters->data['password'] = bcrypt($stateParameters->data['password']);
            } else {
                $stateParameters->data['password'] = $stateParameters->data['password'];
            }

            $stateParameters->data['updated_at'] = date('Y-m-d H:i:s');

            return $stateParameters;
        });

        $crud->callbackAfterInsert(function ($stateParameters) {
            $id = $stateParameters->insertId;
            $user = User::find($id);

            UserActivityRepository::insertLog('User', "{Auth::user()->name} Membuat User"); //insert log user_activities

            return $stateParameters;
        });

        $crud->callbackAfterUpdate(function ($stateParameters) {
            $id = $stateParameters->primaryKeyValue;
            $user = User::find($id);

            UserActivityRepository::insertLog('User', "{$user->name} Memperbarui User"); //insert log user_activities

            return $stateParameters;
        });


        $output = $crud->render();

        return $this->_show_output($output, 'user::index');
    }

    public function roles($id)
    {


        $crud = $this->_getGroceryCrudEnterprise();

        $crud->setTable('model_has_roles');
        $crud->setSubject('User Roles');

        $crud->setRelation('model_id', 'users', 'name');
        $crud->setRelation('role_id', 'roles', 'name');

        $crud->where(['model_id' => $id, 'model_type' => 'App\Models\User']);

        $crud->columns(['role_id']);
        $crud->fields(['role_id']);

        $crud->callbackBeforeInsert(function($stateParameters) use($id) {
            $roles = ModelHasRole::where('role_id', $stateParameters->data['role_id'])
                                    ->where('model_type', 'App\Models\User')
                                    ->where('model_id', $id)
                                    ->first();
            if($roles) {
                $errorMessage = new \GroceryCrud\Core\Error\ErrorMessage();
                return $errorMessage->setMessage("Role tersebut sudah ditambahkan!");
            }

            $stateParameters->data['model_type'] = 'App\Models\User';
            $stateParameters->data['model_id'] = $id;

            return $stateParameters;
        });

        $crud->unsetEdit();

        $output = $crud->render();

        $data = [
            'user' => User::find($id)
        ];

        return $this->_show_output($output, 'user::roles', $data);
    }
}
