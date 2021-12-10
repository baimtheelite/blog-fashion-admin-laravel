<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->input('id');
        $data = [];

        switch($this->method()) {
            case 'PUT':
                $data = [
                    'name' => ['required'],
                    'email' => ['required', 'email', 'unique:users,email,'. $id],
                    'avatar' => ['file', 'image', 'max:2048']
                ];
                break;
            default:
                $data = [];
                break;
        }

        return $data;
    }
}
