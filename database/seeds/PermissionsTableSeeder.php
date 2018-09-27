<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("permissions")->insert([
            "id"             => 1,
            "name"           => "Administer roles & permissions",
            "guard_name"      => "web",
            "created_at"    => \Carbon\Carbon::now()->format("Y-m-d H:i:s"),
        ]);

        DB::table("permissions")->insert([
            "id"             => 2,
            "name"           => "CreateMobileUser",
            "guard_name"      => "web",
            "created_at"    => \Carbon\Carbon::now()->format("Y-m-d H:i:s"),
        ]);

        DB::table("permissions")->insert([
            "id"             => 3,
            "name"           => "lookup",
            "guard_name"      => "web",
            "created_at"    => \Carbon\Carbon::now()->format("Y-m-d H:i:s"),
        ]);
        DB::table("permissions")->insert([
            "id"         => 4,
            "name"       => "edituser",
            "guard_name" => "web",
            "created_at" => \Carbon\Carbon::now()->format("Y-m-d H:i:s"),
        ]);
        DB::table("permissions")->insert([
            "id"         => 5,
            "name"       => "deletemobileuser",
            "guard_name" => "web",
            "created_at" => \Carbon\Carbon::now()->format("Y-m-d H:i:s"),
        ]);
        DB::table("permissions")->insert([
            "id"         => 6,
            "name"       => "logs",
            "guard_name" => "web",
            "created_at" => \Carbon\Carbon::now()->format("Y-m-d H:i:s"),
        ]);

    }
}
