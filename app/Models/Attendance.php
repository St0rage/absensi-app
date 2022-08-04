<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Attendance extends Model
{
    protected $with = ['user', 'attendanceStatus'];

    public function attendanceStatus()
    {
        return $this->belongsTo(AttendanceStatus::class);
    }

    public function activeAttendance()
    {
        return $this->belongsTo(ActiveAttendance::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
