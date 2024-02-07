<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $user = User::updateOrCreate(
      [
        'email' => 'admin@test.com',
      ],
      ['name' => 'Admin', 'password' => 'password']
    );
    $role = Role::updateOrCreate(['name' => 'Admin'], []);
    $permissions = Permission::pluck('id', 'id')->all();
    $user->assignRole([$role->id]);
    $role->syncPermissions($permissions);

    $user = User::updateOrCreate(
      [
        'email' => 'user@test.com',
      ],
      ['name' => 'User', 'password' => 'password']
    );
    $role = Role::updateOrCreate(['name' => 'User'], []);
    $user->assignRole([$role->id]);
    $user->syncPermissions([]);
  }
}
