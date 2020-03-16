<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Songsub extends FormRequest
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
            /* 'title' => ['required', 'string', 'max:30'],
            'url' => ['url'],
            'file' => 'sometimes|max:500|file|mimes:jpeg,bmp,png,doc,docx,txt,xls,xlsx,mpeg',
            'comments' => ['nullable', 'string'], */
        ];
    }

    
}
