<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTeacher extends FormRequest
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
            'last_name' => 'required|max:225',
            'email' => 'required|unique:teachers',
            'genre' => 'required',
            'subject' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'email.unique' =>'cette email exiset déja'];
    }
}
