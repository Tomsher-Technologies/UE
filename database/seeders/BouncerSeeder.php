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
            'password' => Hash::make('password'),
            'status' => 1
        ]);

        Bouncer::assign('admin')->to($admin);
        
    }
}
