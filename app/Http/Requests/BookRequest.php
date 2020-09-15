<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
        return [
            'pcategoryId' => 'bail|required',
            'pname' => 'required',
            'pauthor' => 'required',
            'ppublishedDate' => 'required|numeric'
        ];
    }

    public function messages() {
        return [
            'pname.required' => 'The name field is required',
            'pauthor.required' => 'The author field is required',
            'ppublishedDate.required' => 'The published date field is required',
            'ppublishedDate.numeric' => 'The published date field is numeric',
            'pcategoryId.required' => 'Choose a category'
        ];
    }
}
