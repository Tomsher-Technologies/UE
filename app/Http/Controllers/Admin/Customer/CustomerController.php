<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Imports\Admin\CustomerRates;
use App\Imports\Admin\ProfitMarginImport;
use App\Imports\Admin\UserImport;
use App\Models\Customer\Grade;
use App\Models\Integrators\Integrator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

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

    public function importProfitMarginView(User $user)
    {
        $integrators = Cache::rememberForever('integrators', function () {
            return Integrator::all();
        });

        return view('admin.customer.profit-margin-import')->with([
            'user' => $user,
            'integrators' => $integrators
        ]);
    }
    public function importProfitMargin(User $user, Request $request)
    {

        $headings = (new HeadingRowImport())->toArray(request()->file('importfile'));

        $import = new ProfitMarginImport($user, $request->integrator, $request->type, $headings[0]);
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

    public function newRateView(User $user)
    {
        $integrators = Cache::rememberForever('integrators', function () {
            return Integrator::all();
        });

        return view('admin.customer.user-rate-import')->with([
            'integrators' => $integrators,
            'user' => $user
        ]);
    }

    public function newRateImport(User $user, Request $request)
    {
        $request->validate([
            'integrator' => 'required',
            'type' => 'required',
            'importfile' => 'required|file|max:10000|mimes:xlsx,csv,txt',
        ], [
            'integrator:required' => 'Please choose an integrator',
            'type:required' => 'Please choose a type',
            'importfile:required' => 'Please select a file',
        ]);

        $headings = (new HeadingRowImport())->toArray(request()->file('importfile'));

        // dd($headings );

        $import = new CustomerRates($user, $request->integrator, $request->type, $headings[0]);
        Excel::import($import, request()->file('importfile'));

        return back()->with([
            'status' => "Import successful"
        ]);

        // $import = new UserImport();
        // Excel::import($import, request()->file('importfile'));
        // if ($import->errors) {
        //     return back()->with([
        //         'import_errors' => $import->errors
        //     ]);
        // } else {
        //     return back()->with([
        //         'status' => "Import successful"
        //     ]);
        // }
    }
}
