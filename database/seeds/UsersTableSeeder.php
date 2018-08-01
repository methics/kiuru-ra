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
        $admin_pass = env("ADMIN_PASS");


        DB::table("users")->insert([
            "id"             => 1,
            "name"           => $admin_user,
            "email"          => "admin@admin.com",
            "password"       => bcrypt($admin_pass),
            "created_at"     => \Carbon\Carbon::now()->format("Y-m-d H:i:s"),
        ]);


    }

    public function down(){
        Schema::drop("users");
    }




}
