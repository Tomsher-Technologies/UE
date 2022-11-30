<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Password;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function viewprofile()
    {
        if (Auth::user()->isAn('admin') ||  Auth::user()->isAn('ueuser')) {
            return view('admin.profile.profile');
        } else {
            $details = Auth::user()->customerDetails;
            return view('reseller.profile.profile')->with([
                'details' => $details
            ]);
        }
    }

    function updatePassword(Request $request)
    {
        $user = Auth()->user();
        $input = $request->all();

        $validator = Validator::make($input, [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', new Password, 'confirmed'],
        ]);

        $validator->after(function ($validator) use ($user, $input) {
            if (!isset($input['current_password']) || !Hash::check($input['current_password'], $user->password)) {
                $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $user->forceFill([
            'password' => $input['password'],
        ])->save();

        Auth::logoutOtherDevices($request->password);

        return back()->with('status', "Password Updated!");
    }

    function updateProfile(Request $request)
    {
        $user = Auth()->user();
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'logoimage' => 'file|mimes:png,jpg,jpeg,gif,webp|max:1024',
        ], [
            'name.require' => "Please enter a name",
            'name.max' => "Name cannot be larger than 255 characters",
            'name.min' => "Name cannot be less than 3 characters",
            'logoimage.file' => "Please select valid image",
            'logoimage.mimes' => "Please select valid .jpg, .jpeg, .png, .gif or .webp image",
            'logoimage.uploaded' => "Image size can't be bigger than 1MB",
            'logoimage.max' => "Image size can't be bigger than 1MB",
        ]);
        $user->forceFill([
            'name' => $request->name,
        ])->save();

        $customerDetails = Auth::user()->customerDetails;

        if ($request->hasFile('logoimage')) {
            if (Storage::exists($customerDetails->image)) {
                Storage::delete($customerDetails->image);
            }


            $uploadedFile = $request->file('logoimage');
            $filename = time() . $uploadedFile->getClientOriginalName();

            $file = Storage::disk('public')->putFileAs(
                'customerphotos',
                $uploadedFile,
                $filename
            );

            $customerDetails->image = $file;
            $customerDetails->save();
        }

        if ($request->details) {
            $customerDetails->update([
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        }

        return back()->with('status', "Profle Updated!");
    }

    function logoutEverywhere(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
        ], [
            'password.require' => "Please enter your password",
        ]);

        if (!isset($request->password) || !Hash::check($request->password, Auth()->user()->password)) {
            return back()->withErrors(['errors' => "The given password does not match the current password."]);
        }

        Auth::logoutOtherDevices($request->password);
        return back()->with('status', "You are now logged out everywhere else.");
    }
}
