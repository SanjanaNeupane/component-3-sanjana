<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->user()) {
            return response()->json(['error' => 'User does not exist'], 500);
        }

        return $request->user()->products;
    }

    public function fetchAll()
    {

        return response()->json(Product::all());
    }

    public function delete($id) {
        if(Product::find($id)) {
            $user = Auth::user();
            Product::find($id)->delete();
            if($user->role == 1) return response()->json($user->products, 200);//return editor products only
            else if($user->role == 2) return response()->json(Product::all(), 200);//return all for admin
        }

        throw ValidationException::withMessages([
            'error' =>["Something went wrong!"]
        ]);
    }

    public function edit($id) {
        return response()->json(Product::find($id), 200);
    }

    public function update($id, Request $request) {
        $product = Product::find($id);
        $product->update($request->validate([
            'firstName'=> ['min:2', 'required'],
            'title' => ['required'],
            'mainName' => ['required'],
            'price' => ['required'],
            'type' => ['required', 'min:2'],
            'length' => ['required']
        ]));

        return response()->json('The product successfully updated');
    }

    public function add(Request $request) {
        Product::create($request->validate([
            'firstName'=> ['min:2', 'required'],
            'title' => ['required'],
            'mainName' => ['required'],
            'price' => ['required'],
            'type' => ['required', 'min:2'],
            'user_id' => ['required'],
            'length' => ['required']
        ]));

        return response()->json('The book successfully added');
    }
}
