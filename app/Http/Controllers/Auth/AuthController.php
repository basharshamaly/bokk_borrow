<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showlogin($guard)
    {
        return response()->view('cms.auth.login', compact('guard'));
    }



    public function login(Request $request)
    {

        $validator = Validator($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string|min:6'

        ]);

        $credentials = [
            'username' => $request->get('username'),
            'password' => $request->get('password'),
        ];
        if (!$validator->fails()) {
            if (Auth::guard($request->get('guard'))->attempt($credentials)) {
                return response()->json(['icon' => 'success', 'title' => 'Login is Successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'Login is Failed '], 400);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
        }
    }

    public function logout(Request $request)
    {

        $guard = auth('web')->check() ? 'web' : 'not found';

        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('show.login', $guard);
    }
}
