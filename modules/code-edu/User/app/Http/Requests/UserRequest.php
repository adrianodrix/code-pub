<?php

namespace CodeEdu\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userid = $this->route('user');
        $id = $userid ? $userid : "NULL";
        return [
            'name' => "required|max:255,$id",
            'email' => "required|max:255|unique:users,email,$id"
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
