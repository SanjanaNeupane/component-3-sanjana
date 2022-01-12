<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function createUser(Request $request) {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required','confirmed'],
            'name' => ['required']
        ]);
        User::create([
            'name' =>$request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    }
}
