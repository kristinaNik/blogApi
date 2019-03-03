<?php

use Illuminate\Database\Seeder;

class LaracastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new \App\Role();
        $role->create(['name' => 'admin',  'label' => 'Basic User']);
        $role->create(['name' => 'editor', 'label' => 'Editor']);
        $role->create(['name' => 'admin', 'label' => 'Administrator']);
        $role->create(['name' => 'webdev', 'label' => 'Web Developer']);

        $permission = new \App\Permission();

        $permission->create(['name' => 'view-user', 'label' => 'View All Users']);
        $permission->create(['name' => 'create-user', 'label' => 'Create Users']);
        $permission->create(['name' => 'update-user', 'label' => 'Update Users']);
        $permission->create(['name' => 'delete-user', 'label' => 'Delete Users']);

    }
}
