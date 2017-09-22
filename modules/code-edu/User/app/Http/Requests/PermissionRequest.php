<?php

namespace CodeEdu\User\Http\Requests;

use CodeEdu\User\Repositories\Contracts\RoleRepository;
use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'permissions'     => "array",
            'permissions.*'   => 'exists:permissions,id'
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
