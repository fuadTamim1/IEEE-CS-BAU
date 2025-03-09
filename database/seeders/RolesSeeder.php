<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        try{

            Role::create(['name' => 'super-admin']);
            Role::create(['name' => 'admin']);
            Role::create(['name' => 'editor']);
            Role::create(['name' => 'writer']);
            Role::create(['name' => 'user']);
        }catch(Exception $e){
            throw $e;
        }
    }
}
