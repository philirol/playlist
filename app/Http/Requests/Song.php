<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Song extends FormRequest
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
            'title' => ['required', 'string', 'max:100'],
            'url' => ['nullable', 'string'],
            'file' => 'sometimes|max:5000|file|mimes:jpeg,bmp,png,doc,docx,txt,xls,xlsx',
            'order' => ['nullable', 'integer'],
            'comments' => ['nullable', 'string'],
            'user_id' => ['exists:users,id'],
            'band_id' => ['exists:bands,id'],
        ];
    }
}
