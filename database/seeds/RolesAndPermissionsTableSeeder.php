<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = [
            'superadmin' => [],
            'admin' => [
                'tickets.view',
                'ticket.detail',
                'ticket.validate',

                'users.view',
                'user.detail',
                'users.roles.view',

                'shops.view',
                'shop.detail',
                'shop.delete',

                'market_items.view',
                'market_item.detail',
                'market_item.delete',

                'merchandises.view',
                'merchandise.detail',
                'merchandise.create',
                'merchandise.edit',
                'merchandise.delete',

                'testimonies.view',
                'testimoni.detail',
                'testimoni.hide',
                'testimoni.show',
                'testimoni.delete',

                'galleries.view',
                'gallery.create',
                'gallery.detail',
                'gallery.edit',
                'gallery.delete',

                'facilities.view',
                'facility.detail',
                'facility.create',
                'facility.edit',
                'facility.delete',

                'about.edit',
                'contact.edit',
                'socialmedia.edit'
            ],
            'member' => [
                'ticket.detail',
                'ticket.order',
                'ticket.cancel',

                'shops.view',
                'shop.detail',

                'market_items.view',
                'market_item.detail',

                'merchandises.view',
                'merchandise.detail',

                'testimonies.view',
                'testimoni.detail',
                'testimoni.create',
                'testimoni.edit',

                'galleries.view',
                'gallery.detail',

                'facilities.view',
                'facility.detail',
            ],
            'shop_owner' => [
                'shop.create',
                'shop.edit',

                'market_item.create',
                'market_item.edit',
                'market_item.delete',
            ]
        ];

        $permissionsName = array_unique(Arr::flatten($rolesWithPermissions));
        sort($permissionsName);
        $permissions = array_map(function ($permissionName) {
            return [
                'name' => $permissionName,
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ];
        }, $permissionsName);

        Permission::insert($permissions);

        foreach ($rolesWithPermissions as $roleName => $permission) {
            Role::create(['name' => $roleName, 'guard_name' => 'web'])->givePermissionTo($permission);
        };
    }
}
