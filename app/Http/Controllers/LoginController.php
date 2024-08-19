<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use JetBrains\PhpStorm\NoReturn;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $valid = validator::validate($request->all(), [
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if (Auth::attempt($valid)){
            $token = $request->user()->createToken('login');
            return ['token' => $token->plainTextToken];
        }
    }

    public function register(Request $request)
    {
        validator::validate($request->all(), [
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required'
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);
    }
}
