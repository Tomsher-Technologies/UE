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
                'name' => $row[2],
                'email' => $row[3],
            ], [
                'name' => 'required',
                'email' => 'required|email',
            ]);

            $user = User::where('email', $row[3])->exists();

            if (!$validator->fails() && !$user) {

                $user = User::create([
                    'name' => $row[2],
                    'email' => $row[3],
                    'status' => 1,
                    'password' => $row[3],
                    'parent_id' => 0,
                    'grade_id' => 1,
                    'verified' => 1,
                ]);

                Bouncer::assign('reseller')->to($user);

                $user->customerDetails()->create([
                    'account_number' => $row[0],
                    'company_name' => $row[1],
                    'address' => $row[5],
                    'address_2' => $row[6],
                    'city' => $row[7],
                    'country' => $row[8],
                    'vat_number' => $row[9],
                    'phone' => $row[4],
                ]);
            }
        }
    }
}
