<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveAttendance extends Model
{
    use HasFactory;

    protected $with = ['classroomSubject', 'attendances'];

    public function classroomSubject()
    {
        return $this->belongsTo(ClassroomSubject::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'active_attendance_id');
    }
}
