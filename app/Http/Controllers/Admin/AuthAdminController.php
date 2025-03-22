<?php

namespace App\Http\Controllers\Admin;

use App\Events\OnlineAdminEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    public function  login(LoginRequest $request)
    {
        $remember = $request->remember ? 1 : 0;
        $user = User::where('email', $request->email)->first();
        if ($user and $user->type == 'admin') {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
                // OnlineAdminEvent::dispatch($user);
                return redirect()->route('admin.home');
            } else {
                return back()->with('error', 'نأسف لكن كلمة المرور أو البريد الالكتروني غير صحيح');
            }
        }
        return back()->with('error', 'نأسف لكن كلمة المرور أو البريد الالكتروني غير صحيح');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}