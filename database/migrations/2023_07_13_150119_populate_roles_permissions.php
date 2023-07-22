<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $roles = [
            'Admin',
            'Doctor',
            'Manager'
        ];

        foreach($roles as $role) {
            Role::create(['name' => $role]);
        }

        $permissions = [
            'list users',
            'create user',
            'edit user',
            'delete user',
            'create role',
            'edit role',
            'delete role',
            'create permission',
            'edit permission',
            'delete permission'
        ];

        foreach($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
