<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Imports\Admin\ProfitMarginImport;
use App\Imports\Admin\UserImport;
use App\Models\Customer\Grade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.customer.show')->with([
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.customer.edit')->with([
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function profitMargin(User $user)
    {
        return view('admin.customer.profit-margin')->with([
            'user' => $user,
            'type' => "user"
        ]);
    }
    public function gradeProfitMargin(Grade $grade)
    {
        return view('admin.customer.profit-margin')->with([
            'user' => $grade,
            'type' => "grade"
        ]);
    }

    public function importProfitMarginView()
    {
        return view('admin.customer.profit-margin-import');
    }
    public function importProfitMargin(Request $request)
    {
        $import = new ProfitMarginImport();
        Excel::import($import, request()->file('importfile'));

        if ($import->errors) {
            return back()->with([
                'import_errors' => $import->errors
            ]);
        } else {
            return back()->with([
                'status' => "Import successful"
            ]);
        }
    }


    public function importUserView()
    {
        return view('admin.customer.user-import');
    }

    public function importUser(Request $request)
    {
        $import = new UserImport();
        Excel::import($import, request()->file('importfile'));
        if ($import->errors) {
            return back()->with([
                'import_errors' => $import->errors
            ]);
        } else {
            return back()->with([
                'status' => "Import successful"
            ]);
        }
    }
}
