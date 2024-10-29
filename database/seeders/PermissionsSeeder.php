<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {

        $ownPermissions = [
            'view-own',
            'create',
            'update-own',
            'delete-own',
            'restore-own'
        ];

        $anyPermissions = [
            'view-any',
            'update-any',
            'delete-any',
            'restore-any'
        ];

        $permissions = [
            ...$ownPermissions,
            ...$anyPermissions
        ];

        $models = ['recordType', 'record', 'status', 'user', 'task'];

        $userRole = Role::findByName('User', 'api');

        foreach($models as $model)
            foreach($permissions as $permission) {

                $permissionName = "$permission-$model";
                $permissionInstance = Permission::create(['guard_name' => 'api', 'name' => $permissionName]);
                $onlyOwnPermission = in_array($permission, $ownPermissions);

                // Only adding permissions for 'own' permissions
                if (!$onlyOwnPermission)
                    continue
                ;

                // Only adding permissions for user model
                if ($model === 'user') {

                    $onlyModelUserPermission = !in_array($permission, ['create', 'delete-own', 'restore-own']);

                    if (!$onlyModelUserPermission)
                        continue
                    ;

                    $userRole->givePermissionTo($permissionInstance);

                    continue;

                }

                $onlyUserModels = in_array($model, ['task']);

                // Only adding permissions to allowed models
                if (!$onlyUserModels)
                    continue
                ;

                $userRole->givePermissionTo($permissionInstance);

            }
        ;

        Role::findByName('Administrator', 'api')
            ->givePermissionTo(Permission::all())
        ;

    }

}
