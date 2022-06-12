<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;



class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Blogger']);

        Permission::create(['name' => 'admin.home', 'descripcion' => 'Ver menu administrador'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.users.index', 'descripcion' => 'Ver lista de usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.update', 'descripcion' => 'Dar rol a usuarios'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.categories.index', 'descripcion' => 'Ver lista de categorias'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.categories.create', 'descripcion' => 'Crear categorias'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.update', 'descripcion' => 'Editar categorias'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.destroy', 'descripcion' => 'Borrar categorias'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.tags.index', 'descripcion' => 'Ver lista de etiquetas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.tags.create', 'descripcion' => 'Crear etiquetas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.update', 'descripcion' => 'Editar etiquetas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.destroy', 'descripcion' => 'Borrar etiquetas'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.posts.index', 'descripcion' => 'Ver lista de posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.create', 'descripcion' => 'Crear posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.update', 'descripcion' => 'Editar posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.destroy', 'descripcion' => 'Borrar posts'])->syncRoles([$role1, $role2]);
    }
}
