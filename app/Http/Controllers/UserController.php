<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function fetchAll() {
        return DB::table('users')->where('role','<>', '2')->get();
    }
    public function fetchAllUsers() {
        return User::all();
    }
    public function deactiveUser($id) {
        $product = User::find($id);
        if($product->role == 1) $product->update(['role' => 0]);
        else $product->update(['role' => 1]);


        return DB::table('users')->where('role','<>', '2')->get();
    }

    public function updateUser($id, Request $request) {
        $product = User::find($id);
        $request->validate([
            'name' => 'required|max:255',
            'password' => 'required|confirmed'
        ]);
        $product->update([
            'name' =>$request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return $product;
    }
}
