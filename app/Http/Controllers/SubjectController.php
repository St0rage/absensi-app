<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.subject.index',[
            'subjects' => Subject::with('user')->get(),
        ]);

        // return Subject::with('user')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.subject.create', [
            'lectures' => User::where('role_id', 3)->get()
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
        $subject = new Subject;

        $validatedData = $request->validate([
            'subject_code' => 'required|max:6',
            'name' => 'required',
            'user_id' => 'required'
        ]);

        $subject->create($validatedData);

        return redirect('/dashboard/subject')->with('success', 'Mata Kuliah ' . $request->name . ' Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('dashboard.subject.edit', [
            'subject' => $subject,
            'users' => User::where('role_id', 3)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $rules = [
            'name' => 'required',
            'user_id' => 'required'
        ];

        if ($request->subject_code != $subject->subject_code) {
            $rules['subject_code'] = 'required|max:6|unique:subjects';
        }

        $validatedData = $request->validate($rules);

        Subject::where('id', $subject->id)
            ->update($validatedData);

        return redirect('/dashboard/subject')->with('success', 'Mata Kuliah ' . $request->name . ' Berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        return view('dashboard.subject.classrooms', [
            'subject' => $subject,
        ]);
    }
}
