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

            Role::findOrCreate('super-admin');
            Role::findOrCreate('admin');
            Role::findOrCreate('editor');
            Role::findOrCreate('writer');
            Role::findOrCreate('user');
        }catch(Exception $e){
            throw $e;
        }
    }
}
