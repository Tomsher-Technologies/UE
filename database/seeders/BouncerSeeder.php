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

    
        $admin = Bouncer::role()->firstOrCreate([
            'name' => 'admin',
            'title' => 'UE Admin',
        ]);
        $admin = Bouncer::role()->firstOrCreate([
            'name' => 'ueuser',
            'title' => 'UE User',
        ]);
        $admin = Bouncer::role()->firstOrCreate([
            'name' => 'reseller',
            'title' => 'Reseller',
        ]);
        $admin = Bouncer::role()->firstOrCreate([
            'name' => 'reselleruser',
            'title' => 'Reseller Subagent',
        ]);

        
        Bouncer::allow('admin')->everything();

        $admin  = User::create([
            'name' => 'Admin',
            'email' => 'admin@eu.com',
            'password' => 'password',
            'status' => 1,
            'parent_id' => 0
        ]);
        Bouncer::assign('admin')->to($admin);


        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'list-customer',
            'title' => 'List customer',
        ]);
        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'create-customer',
            'title' => 'Create customer',
        ]);
        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'view-customer',
            'title' => 'View customer',
        ]);
        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'edit-customer',
            'title' => 'Edit customer',
        ]);
        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'delete-customer',
            'title' => 'Delete customer',
        ]);


        // // Customer


    }
}
