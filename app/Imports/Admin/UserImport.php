<?php

namespace App\Imports\Admin;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Bouncer;

class UserImport implements ToCollection
{

    public $errors;

    public function __construct()
    {
        $this->errors = [];
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $rows->shift();

        foreach ($rows as $row) {

            $validator = Validator::make([
                'name' => $row[0],
                'email' => $row[1],
            ], [
                'name' => 'required',
                'email' => 'required|email',
            ]);

            if (!$validator->fails()) {
                
                $user = User::create([
                    'name' => $row[0],
                    'email' => $row[1],
                    'status' => 1,
                    'password' => Hash::make($row[1]),
                    'parent_id' => 0,
                    'grade_id' => 1,
                    'verified' => 1,
                ]);

                Bouncer::assign('reseller')->to($user);

                $user->customerDetails()->create([
                    'phone' => $row[2],
                    'address' => $row[3]
                ]);

            }
        }
    }
}
