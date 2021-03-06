<?php

use Illuminate\Support\Facades\Storage;

class ContactFilesCest
{
    protected $endpoint = '/api/v1/organizations';

    /*
     * Test file upload as an org admin
     *
     */

    public function testFileUploadAsOrgAdmin(ApiTester $I)
    {
        $id = 2;
        $file = codecept_data_dir('sample.csv');
        $I->wantTo('test file upload as an org admin');
        $I->amAuthenticatedAsOrgAdmin();
        $I->sendPOST($this->endpoint."/$id/files", [], ['file' => $file]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            'organization' => [
                'id'   => 2,
            ],
            'columns' => [
                'Name', 'Description', 'Phone', 'Email', 'Address', 'Twitter', 'Role'
            ],
        ]);
    }

    /*
     * Update CSV columns and map
     *
     */
    public function updateCSVColumnsAndMapAsOrgAdmin(ApiTester $I)
    {
        $org_id = 2;
        $id = 1;
        $I->wantTo('update CSV columns and map as an org admin');
        $I->amAuthenticatedAsOrgAdmin();
        $I->sendPUT($this->endpoint."/$org_id/files/$id", [
            'columns'  => ['name','description', 'phone', 'email', 'address', 'twitter', 'role'],
            'maps_to'  => ['name', null, 'phone', 'email', null, 'twitter', 'role']
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            'organization' => [
                'id'   => 2,
            ],
            'columns' => [
                'name', 'description', 'phone', 'email', 'address', 'twitter','role'
            ],
            'maps_to' => [
                '0' => 'name',
                '2' => 'phone',
                '3' => 'email',
                '5' => 'twitter',
                '6' => 'role'
             ]
        ]);
    }

    /*
     * Import contacts as an org admin
     *
     */
    public function importContactsAsOrgAdmin(ApiTester $I)
    {
        $header = "name, role, phone, email, address, twitter, role, groups\n";
        $contents = '"Mary", "designer", "254722111111", "mary@ushahidi.com", "MV Building, Waiyaki Way", "@md", "admin"'
                  ."\n"
                  . '"David", "software developer", "254722111222", "david@ushahidi.com", "P.O. Box 42, Nairobi", "@lk", "responder"';

        Storage::put('contacts/sample.csv', $header . $contents);

        $organization_id = 2;
        $file_id = 1;
        $I->wantTo('import contacts as an org admin');
        $I->amAuthenticatedAsOrgAdmin();
        $I->sendPOST($this->endpoint. "/$organization_id/files/$file_id/contacts");
        $I->seeInDatabase('users', ['name' => 'David']);
        $I->seeInDatabase('users', ['name' => 'Mary']);
        $I->seeInDatabase('contacts', ['contact' => 'david@ushahidi.com']);
        $I->seeInDatabase('contacts', ['contact' => '+254722111111']);
        $I->seeInDatabase('contacts', ['contact' => 'mary@ushahidi.com']);
        $I->seeInDatabase('contacts', ['contact' => '+254722111222']);
        $I->seeResponseCodeIs(200);
    }

    /*
     * Import invalid contacts
     *
     */
    public function importInvalidContacts(ApiTester $I)
    {
        $header = "name, role, phone, email, address, twitter\n";
        $contents = '"Mary", "designer", "254922222000", "mary@ushahidi.com", "MV Building, Waiyaki Way", "@md"'
                  ."\n"
                  . '"David", "software developer", "254923333300", "david@ushahidi.com", "P.O. Box 42, Nairobi", "@lk"';

        Storage::put('contacts/sample.csv', $header . $contents);

        $organization_id = 2;
        $file_id = 1;
        $I->wantTo('import contacts as an org admin');
        $I->amAuthenticatedAsOrgAdmin();
        $I->sendPOST($this->endpoint. "/$organization_id/files/$file_id/contacts");
        $I->dontSeeInDatabase('users', ['name' => 'David']);
        $I->dontSeeInDatabase('users', ['name' => 'Mary']);
        $I->dontSeeInDatabase('contacts', ['contact' => 'david@ushahidi.com']);
        $I->dontSeeInDatabase('contacts', ['contact' => '254922222000']);
        $I->dontSeeInDatabase('contacts', ['contact' => 'mary@ushahidi.com']);
        $I->dontSeeInDatabase('contacts', ['contact' => '254923333300']);
        $I->seeResponseCodeIs(422);
    }


    /*
     * Skip duplicates
     *
     */
    public function skipDuplicates(ApiTester $I)
    {
        $header = "name, role, phone, email, address, twitter\n";
        $contents = '"Mary Duplicate", "designer", "254722111111", "admin@ushahidi.com", "MV Building, Waiyaki Way", "@md"'
                  ."\n"
                  . '"David", "software developer", "254722111222", "david@ushahidi.com", "P.O. Box 42, Nairobi", "@lk"'
                  ."\n";

        Storage::put('contacts/sample.csv', $header . $contents);

        $organization_id = 2;
        $file_id = 1;
        $I->wantTo('skip duplicates');
        $I->amAuthenticatedAsOrgAdmin();
        $I->sendPOST($this->endpoint. "/$organization_id/files/$file_id/contacts");

        $I->seeInDatabase('users', ['name' => 'David']);
        $I->seeInDatabase('contacts', ['contact' => 'david@ushahidi.com']);
        $I->seeInDatabase('contacts', ['contact' => '+254722111222']);

        $I->dontSeeInDatabase('users', ['name' => 'Mary Duplicate']);
        $I->dontSeeInDatabase('contacts', ['contact' => '+254722111111']);

        $I->seeResponseCodeIs(200);
    }
}
