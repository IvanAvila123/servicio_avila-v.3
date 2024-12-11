<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::create(['name'=>'super-admin']);

        //crear permisos

        $permissions =
        [
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios',
            'crear roles',
            'editar roles',
            'eliminar roles',
            'crear permisos',
            'editar permisos',
            'eliminar permisos',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name'=>$permission]);
        }

        $superAdminRole->givePermissionTo(Permission::all());

        //crear usuario superadmin

        $superAdmin = User::create([
            'name'=>'super-admin',
            'email'=>'superadmin@gmail.com',
            'password' => bcrypt('adminservicioavila')
        ]);

        // Asignar rol de superadmin al usuario
        $superAdmin->assignRole($superAdminRole);
    }
}
