<?php

namespace RollCall\Http\Requests\Organization;


class UpdateMemberRequest extends AddMemberRequest
{
    public function rules()
    {
        return [
            'role' => 'in:member,admin,owner',
        ];

    }
}