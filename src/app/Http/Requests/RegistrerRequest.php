<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * 
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required','string' , 'email:rfc', 'max:255', 'unique:users'],
            'password' => ['required','string', 'regex:/\A([a-zA-Z0-9]{8,})+\z/u']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'ユーザーネームは必須です。',
            'name.string' => 'ユーザーネームは文字列で入力してください。',
            'name.max' => 'ユーザーネームは255文字以内で入力してください。',
            'email.unique' => 'そのメールアドレスは既に登録されています。',
            'email.string' => 'メールアドレスは文字列で入力してください。',
            'email.max' => 'メールアドレスは255文字以内で入力してください。',
            'email.email' => 'メールアドレスの形式が正しくありません。',
            'password.required' => 'パスワードは必須です。',
            'password.string' => 'パスワードは文字列で入力してください。',
            'password.regex' => 'パスワードは半角英数字8文字以上で入力してください。',
        ];
    }
}