<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubject extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|unique:subjects',
            'subject_name' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'code.unique' =>'ce code exiset déja'];
    }
}
