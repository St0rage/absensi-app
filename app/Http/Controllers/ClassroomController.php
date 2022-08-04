<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Validation\Rule;


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
            'classrooms' => Classroom::with(['users', 'subjects'])->get()
        ]);

        // return Classroom::with(['users', 'subjects'])->get();
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

        return redirect('/dashboard/classroom')->with('success', 'Kelas ' . $request->name . ' Berhasil ditambahkan');
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
            'classroom' => $classroom->with(['users', 'subjects'])->get()->where('id', $classroom->id)->first()
        ]);

        // return $classroom->with(['users', 'subjects'])->get()->where('id', $classroom->id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        return view('dashboard.kelas.edit', [
            'classroom' => $classroom
        ]);
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
        $validatedData = $request->validate([
            'name' => 'required|max:30|unique:classrooms'
        ]);

        $validatedData['slug'] = SlugService::createSlug(Classroom::class, 'slug', $request->name);

        Classroom::where('id', $classroom->id)
            ->update($validatedData);

        return redirect('/dashboard/classroom')->with('success', 'Kelas ' . $request->name . ' Berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        if ($classroom->users->count() >= 1 || $classroom->subjects->count() >= 1) {
            return redirect('/dashboard/classroom')->with('error', 'Kosongkan Peserta dan atau Mata Kuliah dari Kelas ' . $classroom->name . ' Terlebih Dahulu'); 
        }

        Classroom::destroy($classroom->id);
        return redirect('dashboard/classroom')->with('success', 'Kelas ' . $classroom->name . ' Berhasil di edit');

    }

    public function showParticipant(Classroom $classroom)
    {
        return view('dashboard.kelas.participant', [
            'classroom' => $classroom,
            'users' => User::where('role_id', 2)
                ->where('classroom_id', 0)
                ->orWhere('classroom_id', $classroom->id)
                ->get()
        ]);
    }

    public function showSubjects(Classroom $classroom)
    {
        $exceptions = [];

        foreach ($classroom->subjects as $subjectsException) {
            array_push($exceptions, $subjectsException->id);
        }

        return view('dashboard.kelas.subject', [
            'classroom' => $classroom,
            'subjects' => Subject::all()->except($exceptions)
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

    public function addSubject(Request $request)
    {
        $validatedData = $request->validate([
            'subject_id' => Rule::prohibitedIf($request->subject_id == 0),
            'classroom_id' => 'required'
        ]);

        $classroom = Classroom::find($validatedData['classroom_id']);

        $classroom->subjects()->attach($validatedData['subject_id']);

        return redirect('/dashboard/classroom/subject/'.$classroom->slug)->with('success', 'Mata Kuliah berhasil ditambahkan');
    }

    public function destroySubject(Classroom $classroom, Request $request)
    {
        // return $classroom;

        $classroom->subjects()->detach($request->subject_id);

        return redirect('/dashboard/classroom/subject/'.$classroom->slug)->with('success', 'Mata Kuliah berhasil dihapus');
    }
}
