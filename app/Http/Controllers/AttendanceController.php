<?php

namespace App\Http\Controllers;

use App\Models\ActiveAttendance;
use App\Models\Attendance;
use App\Models\AttendanceStatus;
use App\Models\Classroom;
use App\Models\ClassroomSubject;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects =  Subject::select('id')->where('user_id', auth()->user()->id)->get();
        $subjectIds = [];

        foreach ($subjects as $subject) {
            array_push($subjectIds, $subject->id);
        }
        
        $activeAttendances = DB::table('classroom_subject')
                    ->join('subjects', 'classroom_subject.subject_id', '=', 'subjects.id')
                    ->join('classrooms', 'classroom_subject.classroom_id', '=', 'classrooms.id')
                    ->join('active_attendances', 'classroom_subject.id', '=', 'active_attendances.classroom_subject_id')
                    ->whereIn('classroom_subject.subject_id', $subjectIds)
                    ->select('subjects.name as subject_name', 'classrooms.name as classroom_name', 'active_attendances.*')
                    ->get();
        
        $filtered = $activeAttendances->filter(function ($item) {
            return strtotime($item->expired) > strtotime(Carbon::now(New DateTimeZone('Asia/Jakarta'))->format('Y-m-d H:i:s'));
        });

        return view('dashboard.attendance.index', [
            'subjects' => Subject::where('user_id', auth()->user()->id)->get(),
            'activeAttendances' => $filtered
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('dashboard.attendance.create', [
            'subject' => Subject::with('classrooms')->where('subject_code', $request->subject)->get()->first()
        ]);

        // return Subject::with('classrooms')->where('subject_code', $request->subject)->get()->first();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required',
            'classroom_id' => Rule::prohibitedIf($request->classroom_id == 0),
            'meeting' => 'required|numeric|min:1|max:14',
            'subject_matter' => 'required|max:100',
            'expired' => 'required|numeric'
        ]);

        $activeAttendance = new ActiveAttendance;
        $activeAttendance->subject_matter = $request->subject_matter;
        $activeAttendance->meeting = $request->meeting;
        $activeAttendance->expired = Carbon::create(now(New DateTimeZone('Asia/Jakarta')))->addMinute($request->expired)->format('Y-m-d H:i:s');

        $classroomSubject = ClassroomSubject::with('activeAttendances')->where('subject_id', $request->subject_id)
                            ->where('classroom_id', $request->classroom_id)
                            ->latest()->first();
        

        $classroomSubject->activeAttendances()->save($activeAttendance);

        $classroom = Classroom::with('users')->where('id', $request->classroom_id)->first();

        $users = [];

        for ($i=0; $i < $classroom->users->count(); $i++) { 
            $users[$i] = [
                'active_attendance_id' => $activeAttendance->id,
                'user_id' => $classroom->users[$i]->id,
                'attendance_status_id' => 2,
                'signature' => null
            ];
        }

        Attendance::upsert($users, ['active_attendance_id', 'user_id', 'attendance_status_id', 'signature']);

        return redirect('/dashboard/attendance')->with('success', 'Absensi berhasil dibuat');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActiveAttendance  $activeAttendance
     * @return \Illuminate\Http\Response
     */
    public function show(ActiveAttendance $attendance)
    {
        if ($attendance->classroomSubject->subject->user_id != auth()->user()->id) {
            return redirect('/dashboard');
        }

        $now = strtotime(Carbon::now(New DateTimeZone('Asia/Jakarta'))->format('Y-m-d H:i:s'));
        $expired = strtotime($attendance->expired);

        if ($now > $expired) {
            abort(401);
        }

        return view('dashboard.attendance.detail', [
            'attendance' => $attendance
        ]);

        // return $attendance;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActiveAttendance  $activeAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        if ($attendance->activeAttendance->classroomSubject->subject->user_id != auth()->user()->id) {
            return redirect('/dashboard/attendance');
        }

        return view('dashboard.attendance.edit', [
            'attendance' => $attendance,
            'attendanceStatuses' => AttendanceStatus::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ActiveAttendance  $activeAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        $attendance->attendance_status_id = $request->attendance_status_id;
        $attendance->save();

        return redirect('/dashboard/attendance/'. $attendance->activeAttendance->id)->with('success', 'Data absensi ' . $attendance->user->name . ' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActiveAttendance  $activeAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActiveAttendance $attendance)
    {
        ActiveAttendance::destroy($attendance->id);

        return redirect('dashboard/attendance')->with('success', 'Absensi Berhasil di hapus');
    }

    public function checkMeeting(Request $request)
    {
        $classroomSubject = ClassroomSubject::with('activeAttendances')->where('subject_id', $request->subject_id)
                            ->where('classroom_id', $request->classroom_id)
                            ->latest()->first();
        
        $activeAttendances = $classroomSubject->activeAttendances->count();

        return response()->json(['meeting' => $activeAttendances + 1]);

    }

    public function createAttendance(Request $request, ActiveAttendance $attendance)
    {
        // return $attendance->classroomSubject;
        if ($attendance->classroomSubject->classroom_id != auth()->user()->classroom_id) {
            return redirect('/dashboard');
        }

        $now = strtotime(Carbon::now(New DateTimeZone('Asia/Jakarta'))->format('Y-m-d H:i:s'));
        $expired = strtotime($attendance->expired);

        if ($now > $expired) {
            abort(401);
        }

        return view('dashboard.attendance.createAttendance', [
            'attendance' => $attendance,
            'subject' => Subject::find($attendance->classroomSubject->subject_id),
            'classroom' => Classroom::find($attendance->classroomSubject->classroom_id)
        ]);

        // return $attendance;
    }

    public function storeAttendance(Request $request)
    {
        $request->validate([
            'signature' => 'required'
        ]);

        $checkStatus = Attendance::where('user_id', $request->user_id)
                    ->where('active_attendance_id', $request->active_attendance_id)
                    ->get()->first();
        
        if ($checkStatus->attendance_status_id != 2) {
            return redirect('dashboard')->with('error', 'Gagal mengisi absensi, anda sudah mengisi absensi ini sebelumnya');
        }

        $signature = explode(',', $request->signature);
        $newFile = 'signature/' . mt_rand() . '.png';

        Storage::disk('public')->put($newFile, base64_decode($signature[1]));

        Attendance::where('user_id', $request->user_id)
                    ->where('active_attendance_id', $request->active_attendance_id)
                    ->update(['attendance_status_id' => 1, 'signature' => $newFile]);

        return redirect('dashboard')->with('success', 'Data absensi anda sudah masuk');
    }

    public function recap()
    {
        return view('dashboard.attendance.recap', [
            'subjects' => Subject::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function showRecap(Request $request)
    {
        $checkAuthrization = Subject::find($request->subject);
        if ($checkAuthrization->user_id != auth()->user()->id) {
            return redirect('/dashboard/attendance/recap');
        }

        $classroomSubjects = ClassroomSubject::with('activeAttendances', 'subject')->where('subject_id', $request->subject)->get();

        return view('dashboard.attendance.showRecap', [
            'classroomSubjects' => $classroomSubjects
        ]);
    }

    public function detailRecap(Request $request)
    {
        $activeAttendances = ActiveAttendance::where('classroom_subject_id', $request->classroomsubject)->get();
        $classroomSubject = ClassroomSubject::with('classroom', 'subject')->where('id', $request->classroomsubject)->get()->first();
        if ($classroomSubject->subject->user_id != auth()->user()->id) {
            return redirect('/dashboard/attendance/recap');
        }
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


        return view('dashboard.attendance.detailRecap', [
            'activeAttendances' => $activeAttendances,
            'classroomSubject' => $classroomSubject,
            'percentages' => $percentages
        ]);
    }

    public function detailedRecap(ActiveAttendance $attendance)
    {
        if ($attendance->classroomSubject->subject->user_id != auth()->user()->id) {
            return redirect('/dashboard/attendance/recap');
        }

        return view('dashboard.attendance.detailedRecap', [
            'attendance' => $attendance
        ]);
    }
}
