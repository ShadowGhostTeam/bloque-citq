<?php

use Illuminate\Database\Seeder;
use App\User;
use Bican\Roles\Models\Role;

class rolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol= Role::create([
            'name' => 'Administrador',
            'slug' => 'Administrador',
            'description' => 'Rol que tiene todos los permisos']);

        $rol2= Role::create([
            'name' => 'Técnico',
            'slug' => 'Tecnico',
            'description' => 'Todos los permisos excepto crear usuarios']);

        $rol3= Role::create([
            'name' => 'Becario',
            'slug' => 'Becario',
            'description' => 'Todos los permisos excepto reportes y crear usuarios']);

        $user1 = User::find(1);
        $user2 = User::find(2);
        $user3 = User::find(3);
        $user4 = User::find(4);
        $user5 = User::find(5);

        $user1->attachRole($rol->id);
        $user2->attachRole($rol->id);
        $user3->attachRole($rol2->id);
        $user4->attachRole($rol2->id);
        $user5->attachRole($rol2->id);
    }
}
