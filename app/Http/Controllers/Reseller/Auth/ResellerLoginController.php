<?php

namespace App\Http\Controllers\Reseller\Auth;

use App\Http\Controllers\Common\MailController;
use App\Http\Controllers\Controller;
use App\Mail\Admin\NewCustomerMail;
use App\Models\Common\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Bouncer;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ResellerLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function loginView()
    {
        return view('reseller.auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => "required|email",
            'password' => "required"
        ], [
            'email.required' => "Please enter your email.",
            'email.email' => "Please enter a valid email",
            'password.required' => "Please enter your password",
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1
        ];

        if (Auth::attempt($credentials, $request->remember_me)) {
            $request->session()->regenerate();
            if (Auth::user()->isAn('reseller')) {
                return redirect()->intended(route('reseller.dashboard'));
            } else {
                Session::flush();
                Auth::logout();
                return redirect()->route('reseller.login');
            }
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function registerView()
    {
        return view('reseller.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => "required",
            'phone' => "required",
            'email' => "required|email|unique:users",
            'password' => ['required', 'confirmed'],
            'address' => ['required'],
            'logoimage' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ], [
            'address.required' => "Please enter your address.",
            'email.required' => "Please enter your email.",
            'email.email' => "Please enter a valid email",
            'password.required' => "Please enter your password",
            'logoimage.image' => "The logo must be an image",
            'logoimage.mimes' => "The logo must be an image",
            'logoimage.max' => "The logo must not be greater than 2MB.",
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'status' => 3,
            'grade_id' => 1,
            'parent_id' => 0
        ]);

        $logo_name = "";

        if ($request->hasFile('logoimage')) {
            $uploadedFile = $request->file('logoimage');
            $filename = time() . $uploadedFile->getClientOriginalName();
            $logo_name = Storage::disk('public')->putFileAs(
                'customerphotos',
                $uploadedFile, 
                $filename
            );
        }

        Bouncer::assign('reseller')->to($user);

        $user->customerDetails()->create([
            'phone' => $request->phone,
            'address' => $request->address,
            'image' => $logo_name,
            'rate_sheet_status' =>false
        ]);

        $mailController = new MailController();
        $mailController->newCustomerRegister($user);

        // $admin_email = Cache::rememberForever('notification_email', function () {
        //     return Settings::where('group', 'notification_email')->get();
        // });

        // $admin_email = $admin_email->where('name', 'new_user_reg')->first()->value;

        // foreach (explode(',', $admin_email) as $email) {
        //     Mail::to($email)->queue(new NewCustomerMail($user));
        // }

        return back()->with([
            'status' => "Your account has been created and sent for approval, once the admin approves your account, you will be able to login."
        ]);
    }
}
