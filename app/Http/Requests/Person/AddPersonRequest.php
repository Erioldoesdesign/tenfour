<?php

namespace TenFour\Http\Requests\Person;

use TenFour\Traits\UserAccess;

class AddPersonRequest extends UpdatePersonRequest
{
    use UserAccess;

    public function authorize()
    {
        // An admin, org owner and org admin can add members
        if ($this->user()->isAdmin($this->route('organization'))) {
            return true;
        }

        return false;
    }

    public function rules()
    {
        $rules = parent::rules() + [
            'name' => 'required',
            'password' => 'required|min:8',
        ];

        return $rules;
    }

}
