<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tables = [
            "model_has_permissions",
            "permissions",
            "roles",
            "role_has_permissions",
            'model_has_roles'
        ];
        Schema::disableForeignKeyConstraints();
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        Schema::enableForeignKeyConstraints();
        $permissions = [
            'ancestor-list',
            'ancestor-create',
            'ancestor-edit',
            'ancestor-delete',
            'mode-of-arrival-list',
            'mode-of-arrival-create',
            'mode-of-arrival-edit',
            'mode-of-arrival-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'states-list',
            'states-create',
            'states-edit',
            'states-delete',
            'ports-list',
            'ports-create',
            'ports-edit',
            'ports-delete',
            'counties-list',
            'counties-create',
            'counties-edit',
            'counties-delete',
            'occupations-list',
            'occupations-create',
            'occupations-edit',
            'occupations-delete',
            'rigs-list',
            'rigs-create',
            'rigs-edit',
            'rigs-delete',
            'ships-list',
            'ships-create',
            'ships-edit',
            'ships-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'source-of-arrival-list',
            'source-of-arrival-create',
            'source-of-arrival-edit',
            'source-of-arrival-delete',
            'cities-list',
            'cities-create',
            'cities-edit',
            'cities-delete',
            'countries-list',
            'countries-create',
            'countries-edit',
            'countries-delete',
            'membership-list',
            'payment-list',
            'subscription-plans-list',
            'subscription-plans-create',
            'subscription-plans-edit',
            'subscription-plans-delete',
        ];
        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission], []);
        }
        // clear permission cache
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
