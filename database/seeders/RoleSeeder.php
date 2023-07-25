<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'user']);
        $role3 = Role::create(['name' => 'officer']);
        $role4 = Role::create(['name' => 'employee']);
        
        Permission::create(['name' => 'view company wallet', 'description' => 'View company wallet'])->syncRoles([$role1,$role4]);
        Permission::create(['name' => 'view clientele', 'description' => 'View clientele'])->syncRoles([$role1,$role4]);
        Permission::create(['name' => 'view employees', 'description' => 'View Employees'])->syncRoles([$role1]);
        Permission::create(['name' => 'view reports', 'description' => 'View Reports'])->syncRoles([$role1,$role4]);
        Permission::create(['name' => 'view accounting', 'description' => 'View Accounting'])->syncRoles([$role1,$role4]);
        Permission::create(['name' => 'view loan relatives', 'description' => 'view loan Guarantors, Missed Repayments and Past Maturity Date'])->syncRoles([$role1,$role4]);

        // Dashboard Page
        Permission::create(['name' => 'view dashboard', 'description' => 'See the dashboard'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'view company financial statistics', 'description' => 'View company financial statistics'])->syncRoles([$role1,$role4]);
        Permission::create(['name' => 'help-desk and support', 'description' => 'Help-desk and support'])->syncRoles([$role1,$role4]);
        Permission::create(['name' => 'view kyc', 'description' => 'view financial overview'])->syncRoles([$role2,$role4]);
        Permission::create(['name' => 'company overview dashboard', 'description' => 'View company overview dashboard'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'view all loan requests', 'description' => 'View all loan requests'])->syncRoles([$role1]);

        // User Page
        Permission::create(['name' => 'see the list of users', 'description'=> 'Sees all the list of users registered in the system'])->syncRoles([$role1]);
        Permission::create(['name' => 'create a user', 'description'=> 'Creates a new user'])->syncRoles([$role1]);
        Permission::create(['name' => 'edit a user', 'description'=> 'Updates a user'])->syncRoles([$role1]);
        // Roles Page
        Permission::create(['name' => 'view user roles', 'description' => 'View user roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'add user roles', 'description' => 'Add new roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'edit user roles', 'description' => 'Edit user roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'delete user roles', 'description' => 'Deletes user roles'])->syncRoles([$role1]);

        // Setting Page
        Permission::create(['name' => 'view system settings', 'description' => 'View system settings'])->syncRoles([$role1]);
        Permission::create(['name' => 'change system settings', 'description' => 'Change or update system settings'])->syncRoles([$role1]);

        // Loans Page
        Permission::create(['name' => 'view loans', 'description' => 'View loan management'])->syncRoles([$role1,$role2,$role4]);
        Permission::create(['name' => 'view loan rates', 'description' => 'View loan management'])->syncRoles([$role1, $role4]);
        Permission::create(['name' => 'view loan calculator', 'description' => 'View loan management'])->syncRoles([$role1,$role2, $role4]);
        Permission::create(['name' => 'view loan history', 'description' => 'View loan management'])->syncRoles([$role1]);
        Permission::create(['name' => 'view loan requests', 'description' => 'View loan requests'])->syncRoles([$role1,$role2,$role4]);
        Permission::create(['name' => 'make payments', 'description' => 'Make payments to repay loans'])->syncRoles([$role2,$role4]);
        Permission::create(['name' => 'withdraw funds', 'description' => 'Withdraw loan funds'])->syncRoles([$role2]);
        Permission::create(['name' => 'accept and reject loan requests', 'description' => 'Accept and reject loan requests'])->syncRoles([$role1,$role4]);
        
        // Payments
        Permission::create(['name' => 'transfer funds to customers', 'description' => 'Transfer funds to customers'])->syncRoles([$role1,$role4]);
        Permission::create(['name' => 'send payment remainders to customers', 'description' => 'Send payment remainders to customers'])->syncRoles([$role1,$role4]);

    }
}
