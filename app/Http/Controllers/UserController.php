<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereHas('role', function($query){
            $query->where('role_name', '!=', 'customer');
        })->orderBy('fullname')->get();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id'
        ],
        [
            'fullname.required' => 'The fullname is required',
            'username.required' => 'The username is required',
            'phone.required' => 'The phone number is required',
            'email.required' => 'The email address is required',
            'password.required' => 'The password is required',
            'role_id.required' => 'The role is required',
            'password.confirmed' => 'The fullname confirmation does not match',
        ]);

        //create a new user
        $validate['password'] = bcrypt($validate['password']);

        User::create($validate);

        return redirect()->route('users.index')->with('success', 'Karyawa : ' . $validate['fullname'] . ', created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
