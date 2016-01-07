<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use RollCall\Seeders\OauthTableSeeder;
use RollCall\Seeders\UserTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

         $this->call(OauthTableSeeder::class);
         $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}