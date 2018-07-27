<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_user = env("ADMIN_USER");
        $admin_pass = env("ADMIN_PASS");

        DB::table("users")->insert([
           "id"             => 1,
           "name"           => $admin_user,
            "password"      => Make::hash($admin_pass),
            "created_at"    => \Carbon\Carbon::now()->format("Y-m-d H:i:s"),
        ]);

    }
}
