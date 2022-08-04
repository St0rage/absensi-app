@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Absensi</h1>
    </div>

    <div class="col-lg-5 mb-3">
        <form action="/dashboard/attendance" method="post">
            @csrf
            <input type="text" class="form-control" id="subject_id" name="subject_id" value="{{ $subject->id }}" hidden>
            <div class="mb-3">
                <label for="subject_name" class="form-label">Mata Kuliah</label>
                <input type="text" class="form-control" id="subject_name" name="subject_name" value="{{ $subject->name }}" disabled>
            </div>
            <div class="mb-3">
                <label for="classroom_id" class="form-label">Kelas</label>
                <select id="classroom_id" class="form-select" name="classroom_id">
                    <option value="0" selected>Pilih Kelas</option>
                    @foreach ($subject->classrooms as $classroom)                        
                        @if (old('classroom_id') == $classroom->id)
                        <option value="{{ $classroom->id }}" selected>{{ $classroom->name }}</option>
                        @else
                        <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('classroom_id')
                <small class="d-block text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="meeting" class="form-label">Pertemuan Ke</label>
                <input type="text" class="form-control @error('meeting') is-invalid @enderror" id="meeting" name="meeting" value="{{ old('meeting', 0) }}" readonly>
                @error('meeting')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="subject_matter" class="form-label">Materi Perkuliahan</label>
                <input type="text" class="form-control @error('subject_matter') is-invalid @enderror" id="subject_matter" name="subject_matter" placeholder="Materi Perkuliahan" value="{{ old('subject_matter') }}">
                @error('subject_matter')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="expired" class="form-label">Batas Absensi Dalam Menit</label>
                <input type="expired" class="form-control @error('expired') is-invalid @enderror" id="expired" name="expired" placeholder="50" value="{{ old('expired') }}">
                @error('expired')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" id="button" class="btn btn-sm btn-primary mt-3">Buat Absensi</button>
        </form>
    </div>

    <script>
        const selected = document.querySelector('#classroom_id');
        const subjectId = document.querySelector('#subject_id');
        const meeting = document.querySelector('#meeting');

        selected.addEventListener('change', function() {

            if (selected.value == 0) {
                meeting.removeAttribute("readonly")
                meeting.value = 0
                meeting.setAttribute("readonly", "readonly")
            } else {
                fetch(`/dashboard/attendance/check-meeting?classroom_id=${selected.value}&subject_id=${subjectId.value}`)
                    .then(response => response.json())
                    .then(data => {
                        meeting.removeAttribute("readonly")
                        meeting.value = data.meeting
                        meeting.setAttribute("readonly", "readonly")
                    })
            }

        });
        
    </script>
@endsection