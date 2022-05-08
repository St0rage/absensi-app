<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Sistem Absensi AMIK Garut</title>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="mb-3 text-center">Selamat {{ $name }} Akun Anda {{ $flash }}</h1>
                <div>
                    <p>Gunakan Email/NIM Dan Password Untuk Login</p>
                    <p>Email : {{ $email }}</p>
                    <p>NIM : {{ $nim }}</p>
                    <p>Password : {{ $password }}</p>
                    <p>Harap Ganti Password Anda Ketika Sudah Berhasil Login</p>
                </div>
                <div class="mt-5">
                    <h5 class="text-center text-muted">Akademi Manajamen Informatika dan Komputer Garut</h5>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>