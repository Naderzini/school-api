<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdmin extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required',
            'email' => 'required|unique:admins',
            'password' => 'required|min:6',
            'phone' => 'required|min:8',

        ];
    }
    public function messages()
    {
        return [
            'email.unique' =>'cette email exiset déja'];
    }

}
