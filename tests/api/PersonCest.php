<?php

class PersonCest
{
    protected $endpoint = '/api/v1/organizations';

    /*
     * Add member to an organization as org admin
     *
     */
    public function addMemberAsOrgAdmin(ApiTester $I)
    {
        $id = 2;
        $I->wantTo('Add member as an org admin');
        $I->amAuthenticatedAsOrgAdmin();
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST($this->endpoint."/$id/people", [
            'name' => 'Mary Mata',
            'role'  => 'member',
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'name' => 'Mary Mata',
            'role' => 'member',
        ]);
    }

    /*
     * Add member contact email to an organization as org admin
     *
     */
    public function addMemberContactEmailAsOrgAdmin(ApiTester $I)
    {
        $id = 2;
        $user_id = 1;
        $I->wantTo('Add member contact email as an org admin');
        $I->amAuthenticatedAsOrgAdmin();
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST($this->endpoint."/$id/people/$user_id/contacts", [
            'contact' => 'mary@example.com',
            'type'    => 'email',
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'contact' => [
                'contact' => 'mary@example.com',
                'type'    => 'email',
            ]
        ]);
    }

    /*
     * Add member contact phone to an organization as org admin
     *
     */
    public function addMemberContactPhoneAsOrgAdmin(ApiTester $I)
    {
        $id = 2;
        $user_id = 1;
        $I->wantTo('Add member contact phone as an org admin');
        $I->amAuthenticatedAsOrgAdmin();
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST($this->endpoint."/$id/people/$user_id/contacts", [
            'contact' => '077242424',
            'type'    => 'phone',
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'contact' => [
                'contact' => '077242424',
                'type'    => 'phone',
            ]
        ]);
    }

    /*
     * Ensure that default role for new member is 'member' if unspecified
     *
     */
    public function addMemberWithUnspecifiedRole(ApiTester $I)
    {
        $id = 2;
        $I->wantTo('Add member with unspecified role');
        $I->amAuthenticatedAsOrgAdmin();
        $I->haveHttpHeader('Content-Type', 'application/json');

        $I->sendPOST($this->endpoint."/$id/people", [
            'name' => 'Mary Mata',
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'name' => 'Mary Mata',
            'role' => 'member',
        ]);
    }

    /*
     * Update Member
     *
     */
    public function updateOrganizationMemberAsOrgOwner(ApiTester $I)
    {
        $id = 2;
        $user_id = 3;
        $I->wantTo('Update organization member as the admin');
        $I->amAuthenticatedAsOrgOwner();
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT($this->endpoint."/$id/people/$user_id", [
            'name' => 'Updated org member',
            'role' => 'admin'
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'person' => [
                'id'   => 3,
                'name' => 'Updated org member',
                'role' => 'admin'
            ]
        ]);
    }

    /*
     * Update Member
     *
     */
    public function updateOrganizationMemberAsMember(ApiTester $I)
    {
        $org_id = 2;
        $user_id = 1;
        $I->wantTo('Update an organization member as the member');
        $I->amAuthenticatedAsUser();
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT($this->endpoint."/$org_id/people/$user_id", [
            'name' => 'Updated org member'
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'person' => [
                'id'   => $user_id,
                'name' => 'Updated org member'
            ]
        ]);
    }

    /*
     * Update member contact
     *
     */
    public function updateMemberContactAsOrgAdmin(ApiTester $I)
    {
        $id = 2;
        $user_id = 1;
        $contact_id = 4;
        $I->wantTo('Update member contact as an org admin');
        $I->amAuthenticatedAsOrgAdmin();
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT($this->endpoint."/$id/people/$user_id/contacts/$contact_id", [
            'contact' => '087242424',
            'type'    => 'phone',
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'contact' => [
                'contact' => '087242424',
                'type'    => 'phone',
            ]
        ]);
    }

    /*
     * Transfer org ownership as org owner
     *
     */
    public function transferOrgOwnershipAsOrgOwner(ApiTester $I)
    {
        $id = 2;
        $user_id = 3;
        $I->wantTo('Transfer org ownership');
        $I->amAuthenticatedAsOrgOwner();
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT($this->endpoint."/$id/people/$user_id", [
            'role' => 'owner'
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'person' => [
                'id'   => 3,
                'role' => 'owner'
            ]
        ]);
    }

    /*
     * Delete member contact
     *
     */
    public function deleteMemberContactAsOrgAdmin(ApiTester $I)
    {
        $id = 2;
        $user_id = 1;
        $contact_id = 4;
        $I->wantTo('Delete member contact org admin');
        $I->amAuthenticatedAsOrgAdmin();
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendDelete($this->endpoint."/$id/people/$user_id/contacts/$contact_id");
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'contact' => [
                'contact' => '0792999999',
                'type'    => 'phone',
            ]
        ]);
    }

    /*
     * Get organization member
     *
     */
    public function getMemberAsOrgAdmin(ApiTester $I)
    {
        $id = 2;
        $user_id = 1;
        $I->wantTo('Get member as an org admin');
        $I->amAuthenticatedAsOrgAdmin();
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET($this->endpoint."/$id/people/$user_id");
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'person' => [
                'name' => 'Test user',
                'contacts' => [
                    [
                        'contact' => '0721674180',
                        'type'    => 'phone',
                        'replies' => [
                            [
                                'message' => 'I am OK'
                            ]
                        ]
                    ],
                    [
                        'contact' => 'test@ushahidi.com',
                        'type'    => 'email',
                    ]
                ],
                'rollcalls' => [
                    [
                        'message' => 'Another test roll call'
                    ]
                ],
                'role' => 'member'
            ]
        ]);
    }

    /*
     * Get organization member
     *
     */
    public function getMemberAsMember(ApiTester $I)
    {
        $org_id = 2;
        $user_id = 1;
        $I->wantTo('Get member as a member');
        $I->amAuthenticatedAsUser();
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET($this->endpoint."/$org_id/people/$user_id");
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'person' => [
                'id'    => $user_id,
                'name'  => 'Test user',
                'role'  => 'member'
            ]
        ]);
    }

    /*
     * Delete member from an organization as org admin
     *
     */
    public function deleteMemberAsOrgAdmin(ApiTester $I)
    {
        $id = 2;
        $user_id = 3;
        $I->wantTo('Delete member as an org admin');
        $I->amAuthenticatedAsOrgAdmin();
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendDelete($this->endpoint."/$id/people/$user_id");
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'person' => [
                'id'   => 3,
                'name' => 'Org member'
            ]
        ]);
    }

    /*
     * Delete owner from an organization as org admin
     *
     */
    public function deleteOwnerAsOrgAdmin(ApiTester $I)
    {
        $id = 2;
        $user_id = 4;
        $I->wantTo('Delete owner as an org admin');
        $I->amAuthenticatedAsOrgAdmin();
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendDelete($this->endpoint."/$id/people/$user_id");
        $I->seeResponseCodeIs(403);
    }

    /*
     * Add admin to an organization as org admin
     *
     */
    public function addAdminAsOrgAdmin(ApiTester $I)
    {
        $id = 2;
        $I->wantTo('Add people as an org admin');
        $I->amAuthenticatedAsOrgAdmin();
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST($this->endpoint."/$id/people", [
            'id'   => 6,
            'role' => 'admin',
        ]);
        $I->seeResponseCodeIs(403);
    }

    /*
     * List people in an organization
     *
     */
    public function listMembersAsOrgAdmin(ApiTester $I)
    {
        $id = 2;
        $I->wantTo('List people of an organization as org Admin');
        $I->amAuthenticatedAsOrgAdmin();
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET($this->endpoint."/$id/people");
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'people' => [
                [
                    'id' => 4,
                    'role' => 'owner',
                    'name' => 'Org owner',
                    'initials' => 'OO'
                ],
                [
                    'id' => 5,
                    'role' => 'admin',
                    'name' => 'Org admin',
                    'initials' => 'OA'
                ],
                [
                    'id' => 1,
                    'role' => 'member',
                    'name' => 'Test user',
                    'initials' => 'TU'
                ],
                [
                    'id' => 3,
                    'role' => 'member',
                    'name' => 'Org member',
                    'initials' => 'OM'
                ]
            ]
        ]);
    }

    /**
     * Send an invite
     */
    public function sendInvite(ApiTester $I)
    {
        $org_id = 2;
        $user_id = 6;
        $I->wantTo('Send an invite to join an organization');
        $I->amAuthenticatedAsOrgAdmin();
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET($this->endpoint . "/$org_id/people/$user_id/invite");
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'user' => [
                'id' => $user_id,
                'invite_sent' => true
            ]
        ]);
    }

    /**
     * Accept an invite
     */
    public function acceptInvite(ApiTester $I)
    {
        $org_id = 2;
        $user_id = 6;
        $I->wantTo('Accept an invite to join an organization');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST("invite/$org_id/accept/$user_id", [
            'invite_token' => 'asupersecrettoken',
            'password' => 'abcd1234',
            'password_confirm' => 'abcd1234'
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'user' => [
                'name' => 'Org member 2',
                'description' => 'Org Member 2',
                'role' => 'member',
                'person_type' => 'user'
            ]
        ]);
    }

    /**
     * Unsubscribe from rollcall emails
     */
    public function unsubscribe(ApiTester $I)
    {
        $I->wantTo('Unsubscribe from emails');
        $I->seeInDatabase('contacts', array('contact' => 'test@ushahidi.com', 'can_receive' => 1));
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST("unsubscribe", [
            'token' => 'testunsubscribetoken',
            'email' => 'test@ushahidi.com',
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeInDatabase('contacts', array('contact' => 'test@ushahidi.com', 'can_receive' => 0));
    }

}
