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
        @if (session()->has('LoginError'))
        <div class="alert alert-danger" role="alert">
          {{ session('LoginError') }}
        </div>
        @endif
        <form action="/login" method="post">
          @csrf
          <div class="d-flex justify-content-center">
            <img class="mb-3 img-fluid" src="img/logo.png" width="150" height="150">
          </div>
          <h5 class="mb-4 text-center">Selamat Datang di Sistem Absensi AMIK Garut</h5>
    
          <div class="form-floating">
            <input type="text" class="form-control @error('login') is-invalid @enderror" id="login" name="login" placeholder="email@emai.coms" autofocus>
            <label for="login">NIM / Email</label>
            @error('login')
            <div class="invalid-feedback mb-2">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-floating">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
            <label for="password">Password</label>
            @error('password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <button class="w-100 btn btn-lg btn-warning mt-3 mb-2" type="submit">Login</button>
          <small class="d-block text-center">Lupa Password? <a href="#">Klik disni</a></small>
        </form>
      </div>
    </div>
  </div>
  
  
</body>
</html>
