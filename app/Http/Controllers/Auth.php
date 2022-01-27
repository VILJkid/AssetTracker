<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\AssetTypeDB;
use App\Models\AssetDB;

class Auth extends Controller
{
    // Login page
    public function login()
    {
        return view("AssetTracker.Pages.login");
    }

    //Validation part for Login
    public function login_check(Request $req)
    {
        $validatedData = $req->validate([
            'email' => 'required|regex:/^[a-zA-Z][a-zA-Z0-9_]+[@][a-zA-Z]+[.][a-zA-Z]+$/',
            'password' => 'required|min:6|max:50',
        ], [
            'email.required' => 'Email is required',
            'email.regex' => 'Invalid email',
            'password.required' => 'Password is required',
            'password.min' => 'Min 5',
            'password.max' => 'Min 50',
        ]);
        if ($validatedData) {
            $email = $req->email;
            $pass = $req->password;

            $email_exists = Admin::where('email', $email)->first();
            if (empty($email_exists))
                return back()->with('error', "Email not registered");

            if (!Hash::check($pass, $email_exists->password))
                return back()->with('error', "Incorect passsword");

            $req->session()->put('sid', $email_exists->name);

            return redirect("/dashboard");
        }
    }

    //Logout
    public function logout()
    {
        session()->forget('sid');
        return redirect("/login");
    }


    // Dashboard
    public function dashboard()
    {
        return view("AssetTracker.Pages.dashboard");
    }


    //Fetching the asset stats to dashboard
    public function getstats(Request $req)
    {
        $data1 = AssetDB::get();
        $data2 = AssetTypeDB::get();

        return response()->json(["data1" => $data1, "data2" => $data2]);
    }
}
