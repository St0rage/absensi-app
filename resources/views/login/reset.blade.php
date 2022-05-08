<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Absensi AMIK Garut</title>
    
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
    
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
</head>
<body>
    
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4">
        <div class="d-flex justify-content-center">
          <img class="mb-3 img-fluid" src="{{ env('APP_URL') }}/img/logo.png" width="150" height="150">
        </div>
        <h5 class="mb-4 text-center">Silahkan Masukan Password Baru</h5>
        <form action="/reset-password" method="post">
          @csrf
          <input type="text" name="token" value="{{ $token }}" hidden>
          <div class="form-floating">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="email@emai.com" autofocus>
            <label for="email">Email</label>
            @error('email')
            <div class="invalid-feedback mb-2">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-floating">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="password">
            <label for="password">Password</label>
            @error('password')
            <div class="invalid-feedback mb-2">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-floating">
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="konfirmasi password">
            <label for="password">Konfirmasi Password</label>
            @error('password_confirmation')
            <div class="invalid-feedback mb-2">
              {{ $message }}
            </div>
            @enderror
          </div>

          <button class="w-100 btn btn-lg btn-warning mt-3 mb-2" type="submit">Reset Password</button>
        </form>
      </div>
    </div>
  </div>
  
  
</body>
</html>
