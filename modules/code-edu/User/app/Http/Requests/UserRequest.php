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
            'email' => "required|max:255|unique:users,email,$id",
            'roles' => "required|array",
            'roles.*' => 'exists:roles,id',
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

    public function messages()
    {
        $result = [];
        $roles = $this->get('roles', []);
        $count = count($roles);
        if(is_array($roles) &&  $count > 0) {
            foreach (range(0, $count-1) as $value) {
                $field = \Lang::get('validation.attributes.roles_*', [
                    'num' => $value +1
                ]);
                $message = \Lang::get('validation.exists', [
                    'attribute' => $field
                ]);
                $result["roles.$value.exists"] = $message;
            }
        }
        return $result;
    }
}
