<?php

namespace App\Http\Controllers;

use App\Mail\AdminEmailResetPassword;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;



class AdminController extends Controller
{
    public function login()
    {
        return view('admin.admin_login');
    }
    public function loginSubmit(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Admin connecté avec succès');
        }
        return redirect()->route('login_form')->with('error', 'Invalid Credentials');
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login_form')->with('error', 'Vous êtes déconnecté avec succès');
    }

    public function forget_password()
    {
        return view("admin.forget_password");
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'Admin not found']);
        }

        $token = Str::random(60);

        $admin->forceFill([
            'remember_token' => $token,
        ])->save();

        // Send the password reset email
        Mail::to($admin->email)->send(new AdminEmailResetPassword($token));

        return back()->with('status', 'Le lien de réinitialisation du mot de passe a été envoyé à votre adresse e-mail');
    }
    public function reset_password_form($token)
    {

        $admin = Admin::where('remember_token', $token)->firstOrFail();
        $email = $admin->email;
        if (!$admin) {
            return redirect()->route('login_form')->with('error', 'Invalid Token or Email');
        }
        return view('admin.reset_password_form', compact('token', 'email'));
    }
    public function reset_password_submit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'], // Ensure password confirmation
            'token' => ['required'], // Ensure token is present
        ]);

        // Find the admin by email
        $admin = Admin::where('email', $request->email)->first();

        // Check if admin exists and token matches
        if ($admin && $admin->remember_token === $request->token) {
            // Set the new password hash
            $admin->password = Hash::make($request->password);
            $admin->setRememberToken(Str::random(60)); // Regenerate remember token

            // Save the updated admin
            $admin->save();

            // Dispatch the PasswordReset event
            event(new PasswordReset($admin));

            // Redirect to the login form with success message
            return redirect()->route('login_form')->with('status', __('Le mot de passe a été réinitialisé avec succès'));
        }

        // Redirect back with error message if admin not found or token mismatch
        return back()->withErrors(['email' => __('Adresse e-mail ou jeton invalide')]);
    }
}
