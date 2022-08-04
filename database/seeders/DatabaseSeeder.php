<?php

namespace Database\Seeders;

use App\Models\ActiveAttendance;
use App\Models\AttendanceStatus;
use App\Models\Classroom;
use App\Models\Role;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'Dian Nugraha Ramadhan',
            'role_id' => 1,
            'email' => 'diannugraha25@gmail.com',
            'password' => bcrypt('dian12345')
        ]);

        User::create([
            'name' => 'Dani Yudistira M',
            'nim' => '23194020',
            'role_id' => 2,
            'classroom_id' => 1,
            'email' => 'daniyudistira25@gmail.com',
            'password' => bcrypt('dani12345')
        ]);

        User::create([
            'name' => 'Veronica Christine',
            'nim' => '23194021',
            'role_id' => 2,
            'classroom_id' => 1,
            'email' => 'veronicachristine@gmail.com',
            'password' => bcrypt('vero12345')
        ]);

        User::create([
            'name' => 'Khoiri Amal',
            'nim' => '23194022',
            'role_id' => 2,
            'classroom_id' => 1,
            'email' => 'khoiriamal@gmail.com',
            'password' => bcrypt('khoiri12345')
        ]);

        User::create([
            'name' => 'Risman Kristiawan',
            'nim' => '23194023',
            'role_id' => 2,
            'classroom_id' => 1,
            'email' => 'rismankristiawan@gmail.com',
            'password' => bcrypt('risman12345')
        ]);

        User::create([
            'name' => 'Asep Hendrayana',
            'role_id' => 3,
            'email' => 'asephendrayana@gmail.com',
            'password' => bcrypt('asep12345')
        ]);

        User::create([
            'name' => 'Tedi Budiman',
            'role_id' => 3,
            'email' => 'tedibudiman@gmail.com',
            'password' => bcrypt('tedi12345')
        ]);

        User::create([
            'name' => 'Ramdhani Hidayat',
            'role_id' => 3,
            'email' => 'ramdhanihidayat@gmail.com',
            'password' => bcrypt('ramdhani12345')
        ]);

        User::create([
            'name' => 'Akmal Maulana',
            'nim' => '23194024',
            'role_id' => 2,
            'classroom_id' => 1,
            'email' => 'akmalmaulana@gmail.com',
            'password' => bcrypt('akmal12345')
        ]);

        Role::create([
            'name' => 'Administrator'
        ]);

        Role::create([
            'name' => 'Mahasiswa'
        ]);

        Role::create([
            'name' => 'Dosen'
        ]);

        AttendanceStatus::create([
            'name' => 'Hadir'
        ]);

        AttendanceStatus::create([
            'name' => 'Alpa'
        ]);

        AttendanceStatus::create([
            'name' => 'Sakit'
        ]);

        AttendanceStatus::create([
            'name' => 'Izin'
        ]);

        Classroom::create([
            'name' => 'TI Reguler Semester 6',
            'slug' => 'ti-reguler-semester-6',
        ]);

        Classroom::create([
            'name' => 'MI Reguler Semester 6',
            'slug' => 'mi-reguler-semester-6',
        ]);

        Subject::create([
            'subject_code' => 'MKB221',
            'name' => 'Jaringan Komputer 1',
            'user_Id' => 8
        ]);

        Subject::create([
            'subject_code' => 'MKK221',
            'name' => 'Bahasa Inggris',
            'user_id' => 7
        ]);

        Subject::create([
            'subject_code' => 'MKB222',
            'name' => 'Sistem Operasi',
            'user_id' => 8
        ]);

        Subject::create([
            'subject_code' => 'MKK222',
            'name' => 'Struktur Data',
            'user_id' => 8
        ]);

        Subject::create([
            'subject_code' => 'MKB220',
            'name' => 'Teori Pemograman Web',
            'user_id' => 6
        ]);

        Subject::create([
            'subject_code' => 'MKB223',
            'name' => 'Algoritma Pemograman',
            'user_id' => 8
        ]);
        
    }
}
