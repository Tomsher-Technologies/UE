<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use function Ramsey\Uuid\v1;

use Bouncer;
use Illuminate\Support\Facades\Hash;

class BouncerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // php artisan db:seed --class=BouncerSeeder
    public function run()
    {


        // $admin = Bouncer::role()->firstOrCreate([
        //     'name' => 'enduser',
        //     'title' => 'End User',
        // ]);
        // $admin = Bouncer::role()->firstOrCreate([
        //     'name' => 'ueuser',
        //     'title' => 'UE User',
        // ]);
        // $admin = Bouncer::role()->firstOrCreate([
        //     'name' => 'reseller',
        //     'title' => 'Reseller',
        // ]);
        // $admin = Bouncer::role()->firstOrCreate([
        //     'name' => 'reselleruser',
        //     'title' => 'Reseller Subagent',
        // ]);


        // Bouncer::allow('admin')->everything();

        // $admin  = User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@eu.com',
        //     'password' => 'password',
        //     'status' => 1,
        //     'parent_id' => 0
        // ]);
        // Bouncer::assign('admin')->to($admin);


        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'list-ueuser',
        //     'title' => 'List ueuser',
        //     'group' => "Ueuser"
        // ]);
        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'create-ueuser',
        //     'title' => 'Create ueuser',
        //     'group' => "Ueuser"
        // ]);
        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'view-ueuser',
        //     'title' => 'View ueuser',
        //     'group' => "Ueuser"
        // ]);
        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'edit-ueuser',
        //     'title' => 'Edit ueuser',
        //     'group' => "Ueuser"
        // ]);
        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'delete-ueuser',
        //     'title' => 'Delete ueuser',
        //     'group' => "Ueuser"
        // ]);

        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'list-customer',
        //     'title' => 'List customer',
        //     'group' => "Customers"
        // ]);
        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'create-customer',
        //     'title' => 'Create customer',
        //     'group' => "Customers"
        // ]);
        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'view-customer',
        //     'title' => 'View customer',
        //     'group' => "Customers"
        // ]);
        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'edit-customer',
        //     'title' => 'Edit customer',
        //     'group' => "Customers"
        // ]);
        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'delete-customer',
        //     'title' => 'Delete customer',
        //     'group' => "Customers"
        // ]);

        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'manage-dynamic-content',
        //     'title' => 'Manage dynamic content',
        //     'group' => "Dynamic content"
        // ]);
        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'download-rate-sheet',
            'title' => 'Download Rate Sheet',
            'group' => "Customer"
        ]);

        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'list-special-rates',
        //     'title' => 'View special rates',
        //     'group' => "Special Rates"
        // ]);
        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'edit-special-rates',
        //     'title' => 'Edit special rates',
        //     'group' => "Special Rates"
        // ]);
        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'create-special-rates',
        //     'title' => 'Create special rates',
        //     'group' => "Special Rates"
        // ]);

        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'list-integrators',
        //     'title' => 'List integrators',
        //     'group' => "Integrators"
        // ]);
        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'create-integrators',
        //     'title' => 'Create integrators',
        //     'group' => "Integrators"
        // ]);
        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'view-integrators',
        //     'title' => 'View integrators',
        //     'group' => "Integrators"
        // ]);
        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'edit-integrators',
        //     'title' => 'Edit integrators',
        //     'group' => "Integrators"
        // ]);
        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'delete-integrators',
        //     'title' => 'Delete integrators',
        //     'group' => "Integrators"
        // ]);

        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'import-rates',
        //     'title' => 'Import Rates',
        //     'group' => "Rates"
        // ]);
        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'export-rates',
        //     'title' => 'Export Rates',
        //     'group' => "Rates"
        // ]);
        // $ban = Bouncer::ability()->firstOrCreate([
        //     'name' => 'import-zones',
        //     'title' => 'Import Zones',
        //     'group' => "Rates"
        // ]);


        // // Customer


    }
}
