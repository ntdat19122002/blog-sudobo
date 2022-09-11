<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|min:2|max:32',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:32|confirmed',
            'role' => 'required|max:3',
            'phone' => 'required|min:10|max:11',
            'address' => 'required|max:150'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Trường này không được để trống!',
            'name.min' => 'Trường này có ít nhất 2 ký tự!',
            'name.max' => 'Trường này nhiều nhất 32 ký tự!',
            'email.required' => 'Trường này không được để trống!',
            'email.email' => 'Email không hợp lệ!',
            'email.unique' => 'Email đã tồn tại!',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp!'

        ];
    }
}
