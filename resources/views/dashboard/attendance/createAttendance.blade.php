@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Form Absensi</h1>
    </div>


    @error('signature')
    <div class="alert alert-danger col-lg-5" role="alert">
      {{ $message }}
    </div>
    @enderror 
    <div class="col-lg-5 mb-3">
        <form action="/dashboard/attendance/store-attendance" method="post">
            @csrf
            <input type="text" class="form-control" name="active_attendance_id" value="{{ $attendance->id }}" readonly hidden>
            <input type="text" class="form-control" name="user_id" value="{{ auth()->user()->id }}" readonly hidden>
            <div class="mb-3">
                <label for="name" class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control" id="name" value="{{ auth()->user()->name }}" disabled>
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" value="{{ auth()->user()->nim }}" disabled>
            </div>
            <div class="mb-3">
                <label for="subject_name" class="form-label">Mata Kuliah</label>
                <input type="text" class="form-control" id="subject_name" value="{{ $subject->name }}" disabled>
            </div>
            <div class="mb-3">
                <label for="classroom" class="form-label">Kelas</label>
                <input type="text" class="form-control" id="classroom" value="{{ $classroom->name }}" disabled>
            </div>
            <div class="mb-3">
                <label for="subject_matter" class="form-label">Materi Perkuliahan</label>
                <input type="text" class="form-control" id="subject_matter" value="{{ $attendance->subject_matter }}" disabled>
            </div>
            <div class="mb-3">
                <label for="meeting" class="form-label">Pertemuan Ke</label>
                <input type="text" class="form-control" id="meeting" value="{{ $attendance->meeting }}" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanda Tangan Kehadiran</label>
                <div id="sig"></div>
                <textarea name="signature" id="signature64" style="display: none"></textarea>
            	<a class="btn btn-sm btn-warning" id="clear">Reset</a>
            </div>

            <button type="submit" id="button" class="btn btn-primary mt-4">Kirim Absensi</button>
        </form>
    </div>

    <!-- Siganture-pad script-->
    <script>
        $(function() {
            var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
            // $('#disable').click(function() {
            //     var disable = $(this).text() === 'Disable';
            //     $(this).text(disable ? 'Enable' : 'Disable');
            //     sig.signature(disable ? 'disable' : 'enable');
            // });
            $('#clear').click(function(e) {
                e.preventDefault();
                sig.signature('clear');
                $("#signature64").val('');
            });
            // $('#json').click(function() {
            //     alert(sig.signature('toJSON'));
            // });
            // $('#svg').click(function() {
            //     alert(sig.signature('toSVG'));
            // });
        });
    </script>
    
@endsection