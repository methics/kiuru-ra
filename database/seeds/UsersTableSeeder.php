<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Schema\Blueprint;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        DB::table("users")->truncate();

        $admin_user = env("ADMIN_USER");
        $admin_email = env("ADMIN_EMAIL");
        $admin_pass = env("ADMIN_PASS");


        //create admin user with credentials from .env-file
        DB::table("users")->insert([
            "id"             => 1,
            "name"           => $admin_user,
            "email"          => $admin_email,
            "password"       => bcrypt($admin_pass),
            "created_at"     => \Carbon\Carbon::now()->format("Y-m-d H:i:s"),
        ]);

        //create example user, with no admin rights
        DB::table("users")->insert([
            "id"             => 2,
            "name"           => "user",
            "email"          => "user@user.com",
            "password"       => bcrypt($admin_pass),
            "created_at"     => \Carbon\Carbon::now()->format("Y-m-d H:i:s"),
        ]);
        //create a user for Mobile ID authentication users.
        DB::table("users")->insert([
            "id"             => 3,
            "name"           => "mobileiduser",
            "email"          => "mobileiduser@mobileiduser.com",
            "password"       => "LOGINNOTALLOWED", //customize this
            "created_at"     => \Carbon\Carbon::now()->format("Y-m-d H:i:s"),
        ]);

        //create a admin user for Mobile ID authentication users.
        DB::table("users")->insert([
            "id"             => 4,
            "name"           => "mobileidadmin",
            "email"          => "mobileidadmin@admin.com",
            "password"       => "LOGINNOTALLOWED", //customize this
            "created_at"     => \Carbon\Carbon::now()->format("Y-m-d H:i:s"),
        ]);



    }

    public function down(){
        Schema::drop("users");
    }




}
