<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['user'];

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class)->using(ClassroomSubject::class)->withPivot('id');
    }

    public function classroomSubjects()
    {
        return $this->hasMany(ClassroomSubject::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'subject_code';
    }
}
