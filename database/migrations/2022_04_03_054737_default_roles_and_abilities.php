<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Backpack\PermissionManager\app\Models\Role;
use Backpack\PermissionManager\app\Models\Permission;

class DefaultRolesAndAbilities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        \Illuminate\Support\Facades\DB::table('roles')->truncate();
        \Illuminate\Support\Facades\DB::table('permissions')->truncate();

        Role::create(['name' => 'superadmin']);
        Role::create(['name' => 'manager']);
        Role::create(['name' => 'english teacher']);
        Role::create(['name' => 'russian teacher']);
        Role::create(['name' => 'writer']);
        Role::create(['name' => 'tasker']);

        Permission::create(['name' => 'write']);
        Permission::create(['name' => 'update']);
        Permission::create(['name' => 'view']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'all']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
