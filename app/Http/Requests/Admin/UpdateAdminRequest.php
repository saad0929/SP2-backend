<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //$user = $this->user('api');

//        return $user != null && $this->has('role') && $user->can('crud:' . $this->role);
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ];
    }
}
