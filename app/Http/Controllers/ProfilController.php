<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.profile.index', [
            'user' => User::where('id', auth()->user()->id)->with(['role', 'classroom'])->get()->first()
        ]);

        // $user = User::where('id', auth()->user()->id)->with(['role', 'classroom'])->get()->first();

        // return $user->subjects;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $profile)
    {
        if (auth()->user()->id !== $profile->id) {
            return redirect('/dashboard/profile');
        }

        return view('dashboard.profile.edit', [
            'profile' => $profile
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $profile)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);

        $password = Hash::make($request->password);

        User::where('id', $profile->id)
            ->update(['password' => $password]);

        return redirect('/dashboard/profile')->with('success', 'Password berhasil diubah');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
