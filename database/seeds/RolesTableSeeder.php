<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table("roles")->insert([
            "id"                => 1,
            "name"              => "kiuru-ra-admin",
            "guard_name"        => "web",

        ]);
        DB::table("roles")->insert([
            "id"                => 2,
            "name"              => "kiuru-ra-user",
            "guard_name"        => "web",
        ]);

        DB::table("model_has_roles")->insert([
            "role_id"              => 1,
            "model_type"           => "App\User",
            "model_id"             => 1,
        ]);

        DB::table("model_has_roles")->insert([
            "role_id"              => 2,
            "model_type"           => "App\User",
            "model_id"             => 2,
        ]);

        DB::table("role_has_permissions")->insert([
            "permission_id"             => 1,
            "role_id"                   => 1,
        ]);

        DB::table("role_has_permissions")->insert([
            "permission_id"             => 2,
            "role_id"                   => 2,
        ]);
        DB::table("role_has_permissions")->insert([
            "permission_id"             => 3,
            "role_id"                   => 2,
        ]);
        DB::table("role_has_permissions")->insert([
            "permission_id"             => 4,
            "role_id"                   => 1,
        ]);
        DB::table("role_has_permissions")->insert([
            "permission_id"             => 4,
            "role_id"                   => 2,
        ]);
        DB::table("role_has_permissions")->insert([
            "permission_id"             => 5,
            "role_id"                   => 1,
        ]);
        DB::table("role_has_permissions")->insert([
            "permission_id"             => 5,
            "role_id"                   => 2,
        ]);
        DB::table("role_has_permissions")->insert([
            "permission_id"             => 6,
            "role_id"                   => 1,
        ]);
    }

}
