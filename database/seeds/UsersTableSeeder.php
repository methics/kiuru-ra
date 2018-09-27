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
        $admin_user ="admin";
        $admin_email = "admin@admin.com";
        $admin_pass = "supersecretpassword";


        //create admin user with credentials
        DB::table("users")->insert([
            "id"             => 1,
            "name"           => $admin_user,
            "email"          => $admin_email,
            "password"       => bcrypt($admin_pass),
            "created_at"     => \Carbon\Carbon::now()->format("Y-m-d H:i:s"),
        ]);

        //create example user, with no admin rights
        DB::table("users")->insert([
            "id"             => 1,
            "name"           => "user",
            "email"          => "user@user.com",
            "password"       => bcrypt("example"),
            "created_at"     => \Carbon\Carbon::now()->format("Y-m-d H:i:s"),
        ]);




    }

    public function down(){
        Schema::drop("users");
    }




}
