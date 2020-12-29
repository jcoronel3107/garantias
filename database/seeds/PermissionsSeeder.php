<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // create permissions
        Permission::create(['name' => 'edit polizas']);
        Permission::create(['name' => 'delete polizas']);
        Permission::create(['name' => 'create polizas']);
        Permission::create(['name' => 'consult polizas']);
        Permission::create(['name' => 'edit contratos']);
        Permission::create(['name' => 'delete contratos']);
        Permission::create(['name' => 'create contratos']);
        Permission::create(['name' => 'consult contratos']);
        Permission::create(['name' => 'edit afianzados']);
        Permission::create(['name' => 'delete afianzados']);
        Permission::create(['name' => 'create afianzados']);
        Permission::create(['name' => 'consult afianzados']);
        Permission::create(['name' => 'edit aseguradora']);
        Permission::create(['name' => 'delete aseguradora']);
        Permission::create(['name' => 'create aseguradora']);
        Permission::create(['name' => 'consult aseguradora']);
        Permission::create(['name' => 'view estadistica']);
        Permission::create(['name' => 'send notification']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'creador']);
        $role1->givePermissionTo('edit polizas');
        $role1->givePermissionTo('create polizas');
        $role1->givePermissionTo('consult polizas');
        $role1->givePermissionTo('edit aseguradora');
        $role1->givePermissionTo('create aseguradora');
        $role1->givePermissionTo('consult aseguradora');
        $role1->givePermissionTo('edit contratos');
        $role1->givePermissionTo('create contratos');
        $role1->givePermissionTo('consult contratos');
        $role1->givePermissionTo('edit afianzados');
        $role1->givePermissionTo('create afianzados');
        $role1->givePermissionTo('consult afianzados');
        $role1->givePermissionTo('view estadistica');
        $role1->givePermissionTo('send notification');

        $role2 = Role::create(['name' => 'consultor']);
        $role2->givePermissionTo('view estadistica');


        $role3 = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider
        

        // create demo users
        $user = Factory(App\User::class)->create([
            'name' => 'Juan Fernando Coronel',
            'email' => 'jcoronel@bomberos.gob.ec',
            'password' => Hash::make('K@rin@2018')
        ]);
        $user->assignRole($role3);

        $user = Factory(App\User::class)->create([
            'name' => 'Maria Agusta Perez',
            'email' => 'mperez@bomberos.gob.ec',
            'password' => Hash::make('secret')
        ]);
        $user->assignRole($role1);

        $user = Factory(App\User::class)->create([
            'name' => 'Mayra Cedillo',
            'email' => 'mcedillo@bomberos.gob.ec',
            'password' => Hash::make('secret')
        ]);
        $user->assignRole($role2);
    }
}