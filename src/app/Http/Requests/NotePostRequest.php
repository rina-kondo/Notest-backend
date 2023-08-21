<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'body' => 'required|string|max:1000'
        ];
    }

    public function messages(){
        return [
            'body.required' => 'メモ本文は必須です',
            'body.string' => 'メモ本文は文字列である必要があります',
            'body.max' => 'メモ本文は16384文字以内である必要があります'
        ];
    }
}
