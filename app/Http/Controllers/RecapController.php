<?php

namespace App\Http\Controllers;

use App\Models\ActiveAttendance;
use App\Models\Classroom;
use App\Models\ClassroomSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.recap.index', [
            'subjects' => Subject::all()
        ]);
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
     * @param  \App\Models\ActiveAttendance  $activeAttendance
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActiveAttendance  $activeAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit(ActiveAttendance $activeAttendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ActiveAttendance  $activeAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActiveAttendance $activeAttendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActiveAttendance  $activeAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActiveAttendance $activeAttendance)
    {
        //
    }

    public function showRecap(Request $request)
    {
        return view('dashboard.recap.show', [
            'classroomSubjects' => ClassroomSubject::with('activeAttendances', 'subject')->where('subject_id', $request->subject)->get()
        ]);
    }

    public function detailRecap(Request $request)
    {
        $activeAttendances = ActiveAttendance::where('classroom_subject_id', $request->classroomsubject)->get();
        $classroomSubject = ClassroomSubject::with('classroom', 'subject')->where('id', $request->classroomsubject)->get()->first();
        $activeAttendanceId = [];
        
        foreach ($activeAttendances as $activeAttendance) {
            array_push($activeAttendanceId, $activeAttendance->id);
        }

        $percentages = DB::table('attendances')
                    ->join('users', 'attendances.user_id', '=', 'users.id')
                    ->select(DB::raw('ifnull(count(attendances.active_attendance_id), 0) as attendance_total, users.name as student_name'))
                    ->where('attendances.attendance_status_id', 1)
                    ->whereIn('attendances.active_attendance_id', $activeAttendanceId)
                    ->groupBy('users.name')
                    ->get();
        
        foreach ($percentages as $percentage) {
            $percentage->attendance_total = round(($percentage->attendance_total / 14) * 100)   ;
        }


        return view('dashboard.recap.detail', [
            'activeAttendances' => $activeAttendances,
            'classroomSubject' => $classroomSubject,
            'percentages' => $percentages
        ]);
    }

    public function detailedRecap(ActiveAttendance $attendance)
    {
        return view('dashboard.recap.detailed', [
            'attendance' => $attendance
        ]);
    }
}
