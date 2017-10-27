<?php

namespace RollCall\Http\Requests\Group;

use Dingo\Api\Http\FormRequest;
use RollCall\Traits\UserAccess;

class GetGroupRequest extends FormRequest
{
    use UserAccess;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // An org owner/ admin can view a list of groups in an organization
        if ($this->user()->isAdmin($this->route('organization'))) {
            return true;
        }

        return false;
    }

    public function rules()
    {
        return [
            //
        ];
    }

}