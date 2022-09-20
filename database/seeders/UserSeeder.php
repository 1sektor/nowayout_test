<?php

namespace Database\Seeders;

use App\Enums\Role\PermissionEnum;
use App\Enums\Role\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => RoleEnum::ADMIN]);
        $defaultRole = Role::create(['name' => RoleEnum::MEMBER]);
        $permission = Permission::create(['name' => PermissionEnum::BLOG_EDIT]);
        $permission->assignRole($adminRole);

        $adminData = [
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
        ];

        /** @var User $admin */
        $admin = User::create($adminData);
        $admin->assignRole($adminRole, $defaultRole);

        $userData = [
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => Hash::make('12345678'),
        ];

        /** @var User $admin */
        $user = User::create($userData);
        $user->assignRole($defaultRole);
    }
}
