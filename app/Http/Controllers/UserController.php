<?php

namespace App\Http\Controllers;

use App\Mail\SendAccount;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.user.index', [
            'users' => User::orderBy('role_id', 'asc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.user.create', [
            'roles' => Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'role_id' => 'required',
            // 'nim' => 'required_if:role_id,2'
        ];

        if($request->input('role_id') == 2) {
            $rules['nim'] = 'required_if:role_id,2|min:8';
        }

        $validatedData = $request->validate($rules);

        $password = mt_rand(10000,50000);

        $validatedData['password'] = Hash::make($password);

        User::create($validatedData);

        Mail::to($validatedData['email'])->send(new SendAccount([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'nim' => $validatedData['nim'] ?? '',
            'password' => $password
        ]));

        return redirect('/dashboard/user')->with('success', 'User baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
