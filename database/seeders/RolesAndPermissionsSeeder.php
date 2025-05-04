<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::findOrCreate('edit articles');
        Permission::findOrCreate('delete articles');
        Permission::findOrCreate('publish articles');
        Permission::findOrCreate('unpublish articles');

        // Create roles and assign existing permissions
        $roleAdmin = Role::findOrCreate('admin');
        $roleAdmin->givePermissionTo(['edit articles', 'delete articles', 'publish articles']);

        $roleEditor = Role::findOrCreate('editor');
        $roleEditor->givePermissionTo(['edit articles', 'publish articles']);
    }
}
