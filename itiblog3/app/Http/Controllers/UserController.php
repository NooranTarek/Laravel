<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import User model

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users')); 
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user')); 
    }

    public function create()
    {
        return view('users.create'); 
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        // Add other fields as needed
        $user->save();
        return redirect()->route("users.show", $user->id); 
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user')); 
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('users.index'); 
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index'); 
    }
}