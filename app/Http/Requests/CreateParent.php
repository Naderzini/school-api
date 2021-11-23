<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateParent extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cin' => 'required',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:225',
            'email' => 'required',
            'password' => 'required|min:6',
            // 'adress' => 'required',
            // 'phone' => 'required|min:8|max:8',
            // 'occupation' => 'required',
            // 'genre' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'email.unique' =>'cette email exiset déja',
            'cin.unique' =>'ce cin exiset déja'];
    }
}
