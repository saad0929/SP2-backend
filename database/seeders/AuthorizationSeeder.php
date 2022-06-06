<?php

namespace Database\Seeders;

use App\Handlers\UserTokenHandler;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthorizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminRole = Role::create(['name' => 'super_admin']);
        $adminRole = Role::create(['name' => 'admin']);
        $employeeRole = Role::create(['name' => 'employee']);
        $pupilRole = Role::create(['name' => 'general']);


        $adminCreatePermission = Permission::create(['name' => 'crud:admin']);
        $employeeCreatePermission = Permission::create(['name' => 'crud:employee']);
        $pupilCreatePermission = Permission::create(['name' => 'crud:pupil']);
        $bookCreatePermission = Permission::create(['name' => 'crud:book']);
        $publicPermission = Permission::create(['name' => 'crud:public']);

        $adminCreatePermission->syncRoles([$superAdminRole]);
        $employeeCreatePermission->syncRoles([$superAdminRole, $adminRole]);
        $pupilCreatePermission->syncRoles([$superAdminRole, $adminRole, $pupilRole]);
        $bookCreatePermission->syncRoles([$superAdminRole, $adminRole]);
        $publicPermission->syncRoles([$superAdminRole, $adminRole, $employeeRole, $pupilRole]);



        $userTokenHandler = new UserTokenHandler();
        $user = $userTokenHandler->createUser('xenon',  'xenon123', 'admin@lms.com', '00000000000','DU Campus Area');
        $superadmin = new Admin();
        $superadmin->user_id = $user->id;
        $superadmin->save();
        $user->assignRole('super_admin');
    }
}
