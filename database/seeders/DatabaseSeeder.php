<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{

    /**
     * List of applications to add.
     */
    private $permissions = [
        'all-products', 
        'search-products', 
        'show-products', 
        'edit-products', 
        'delete-products', 
        'add-products', 
        'all-admins', 
        'add-admins', 
        'edit-admins', 
        'delete-admins', 
        'add-category', 
        'edit-category', 
        'delete-category', 
        'role-list', 
        'role-create', 
        'role-edit', 
        'role-delete', 
        'role-show',
        'manage-users',
        'changeUser-status',
        'delete-user',
        'show-order',
        'delivered',
        'orders'
    ];


    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create admin User and assign the role to him.
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'roles_name' => ["superAdmin"],
            'type' => 'admin',
            'status' => 'active'
        ]);

        $role = Role::create(['name' => 'superAdmin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}