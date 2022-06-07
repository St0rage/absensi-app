<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.kelas.index', [
            'classrooms' => Classroom::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:30'
        ]);

        Classroom::create($validatedData);

        return redirect('/dashboard/kelas')->with('success', 'Kelas ' . $request->name . ' Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        return view('dashboard.kelas.detail', [
            'classroom' => $classroom,
            'users' => $classroom->users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        return $classroom;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        //
    }

    public function showParticipant(Classroom $classroom)
    {
        return view('dashboard.kelas.participant', [
            'classroom' => $classroom,
            'users' => User::where('role_id', 2)->get()
        ]);
    }

    public function addParticipant(Request $request)
    {
        // return $request;

        if ($request->has('userId')) {
            User::whereIn('id', $request->userId)->update(['classroom_id' => $request->classroom_id]);
        }

        if ($request->has('userIdDel')) {
            User::whereIn('id', $request->userIdDel)->update(['classroom_id' => 0]);
        }

        return redirect('/dashboard/classroom/'.$request->classroom_slug)->with('success', 'Peserta berhasil diupdate');
    }
}
