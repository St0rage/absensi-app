<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClassroomSubject extends Pivot
{
    protected $with = ['classroom'];

    public function activeAttendances()
    {
        return $this->hasMany(ActiveAttendance::class, 'classroom_subject_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
