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


        DB::table("users")->insert([
            "id"             => 1,
            "name"           => $admin_user,
            "email"          => $admin_email,
            "password"       => bcrypt($admin_pass),
            "created_at"     => \Carbon\Carbon::now()->format("Y-m-d H:i:s"),
        ]);


    }

    public function down(){
        Schema::drop("users");
    }




}
