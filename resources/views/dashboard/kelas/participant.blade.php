@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom">
        <h1 class="h2">{{ $classroom->name }}</h1>
    </div>

    <h5 class="my-3">Pilih Peserta</h5>
    <div class="table-responsive col-lg-8 mb-4">
        <form action="/dashboard/classroom/participant" method="post" id="form-parent">
            @csrf
            <input type="text" value="{{ $classroom->id }}" name="classroom_id" hidden>
            <input type="text" value="{{ $classroom->slug }}" name="classroom_slug" hidden>
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama Peserta</th>
                  <th scope="col">Nim</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr>
                  <td scope="row">{{ $loop->iteration }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->nim }}</td>
                  <td>
                    <div class="form-check">
                        @if ($user->classroom_id == $classroom->id)
                        <input class="form-check-input checkedValue" type="checkbox" name="userId[]" value="{{ $user->id }}" checked>
                        @else
                        <input class="form-check-input" type="checkbox" name="userId[]" value="{{ $user->id }}">
                        @endif
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <button type="submit" class="btn btn-sm btn-primary my-2">Update Peserta</button>
        </form>
    </div>
    <script>
        const checkBoxes = document.querySelectorAll('.checkedValue');
        const formParent = document.querySelector('#form-parent');

        checkBoxes.forEach(check => {
            check.addEventListener('change', (e) => {
                if (e.target.checked == false) {
                    const input = document.createElement("input")
                    input.type = 'text'
                    input.hidden = true
                    input.className = 'input-hidden'
                    input.name = 'userIdDel[]'
                    input.value = e.target.value
                    formParent.appendChild(input)
                } else {
                    const inputs = document.querySelectorAll('.input-hidden')
                    inputs.forEach(input => {
                        if (input.value == e.target.value) {
                            input.remove()
                        }
                    })
                }
            })
        })

    </script>
@endsection