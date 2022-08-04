<?php

namespace App\Http\Controllers;

use App\Models\ActiveAttendance;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role_id == 2) {

            $activeAttendances = DB::table('classroom_subject')
                    ->join('subjects', 'classroom_subject.subject_id', '=', 'subjects.id')
                    ->join('classrooms', 'classroom_subject.classroom_id', '=', 'classrooms.id')
                    ->join('active_attendances', 'classroom_subject.id', '=', 'active_attendances.classroom_subject_id')
                    ->join('users', 'subjects.user_id', '=', 'users.id')
                    ->where('classroom_subject.classroom_id', auth()->user()->classroom_id)
                    ->select('subjects.name as subject_name', 'classrooms.name as classroom_name', 'active_attendances.*', 'users.name')
                    ->get();

            $filtered = $activeAttendances->filter(function ($item) {
                return strtotime($item->expired) > strtotime(Carbon::now(New DateTimeZone('Asia/Jakarta'))->format('Y-m-d H:m:s'));
            });

            return view('dashboard.student', [
                'activeAttendances' => $filtered
            ]);
        }

        return view('dashboard.index');
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
    public function show(ActiveAttendance $activeAttendance)
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
}
