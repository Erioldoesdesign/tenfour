<?php

class GroupCest
{
    protected $endpoint = '/api/v1/organizations';

    /*
     * Create group as organization admin
     *
     */
    public function createGroup(ApiTester $I)
    {
        $id = 2;
        $I->wantTo('Create a group within an organization as an organization admin');
        $I->amAuthenticatedAsOrgAdmin();
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST($this->endpoint."/$id/groups", [
            'name'  => 'Test group',
            'description' => 'First Rollcall group',
            'members' => [
                [
                    'id' => 3
                ],
                [
                    'id' => 1
                ]
            ]
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'group' => [
                'name' => 'Test group',
                'description' => 'First Rollcall group',
                'members' => [
                    [
                        'id' => 3
                    ],
                    [
                        'id' => 1
                    ]
                ]
            ]
        ]);
    }

    /* 
     * Update group
     *
     */
    public function updateGroup(ApiTester $I)
    {
        $id = 1;
        $group_id = 1;
        $I->wantTo('Update group details as the admin');
        $I->amAuthenticatedAsAdmin();
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT($this->endpoint."/$id/groups/$group_id", [
            'name' => 'Test Group Update',
            'members' => [
                [
                    'id' => 2
                ]
            ]
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'group' => [
                'id' => 1,
                'name' => 'Test Group Update',
                'members' => [
                    [
                        'id' => 2
                    ]
                ]
            ]
        ]);
    }

    /*
     * List all groups in an organization
     *
     */
    public function listOrgGroupsAsOrgAdmin(ApiTester $I)
    {
        $id = 2;
        $I->wantTo('Get a list of groups for an organization as an organization admin');
        $I->amAuthenticatedAsOrgAdmin();
        $I->sendGET($this->endpoint."/$id/groups");
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'groups' => [
                [
                    'id' => 2,
                    'name' => 'Test Group 2',
                    'organization' => [
                        'id' => 2
                    ],
                    'members' => [
                        [
                            'id' => 2,
                            'name' => 'Admin user'
                        ]
                    ]

                ],
            ]
        ]);
    }
    /*
     * Delete group
     *
     */
    public function deleteGroupAsOrgAdmin(ApiTester $I)
    {
        $id = 2;
        $group_id = 2;
        $I->wantTo('Delete group as org admin');
        $I->amAuthenticatedAsOrgAdmin();
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendDelete($this->endpoint."/$id/groups/$group_id");
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'group' => [
                'name' => 'Test Group 2'
            ]
        ]);
    }
}