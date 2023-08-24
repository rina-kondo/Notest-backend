<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteGroupPostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => 'required|integer',
        ];
    }

    public function messages(){
        return [
            'user_id.required' => 'ユーザー情報は必須です',
        ];
    }
}
