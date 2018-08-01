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
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table("roles")->truncate();
        DB::table("model_has_roles")->truncate();
        DB::table("role_has_permissions")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");


        DB::table("roles")->insert([
            "id"                => 1,
            "name"              => "kiuru-ra-admin",
            "guard_name"        => "web",
            //"updated_at"        => \Carbon\Carbon::now()->format("Y-m-d H:i:s"),
        ]);

        DB::table("model_has_roles")->insert([
            "role_id"             => 1,
            "model_type"           => "App\User",
            "model_id"      => 1,
        ]);

        DB::table("role_has_permissions")->insert([
            "permission_id"             => 1,
            "role_id"                   => 1,

        ]);
    }

}
