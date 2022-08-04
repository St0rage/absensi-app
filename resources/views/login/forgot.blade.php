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
      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-8">
        @if (session()->has('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
        @endif
        @if (session()->has('email'))
        <div class="alert alert-danger" role="alert">
          {{ session('email') }}
        </div>
        @endif
        <div class="d-flex justify-content-center">
          <img class="mb-3 img-fluid" src="img/logo.png" width="150" height="150">
        </div>
        <h5 class="mb-4 text-center">Lupa Password ? </h5>
        <form action="/forgot-password" method="post">
          @csrf
          <div class="form-floating">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="email@emai.com" autofocus>
            <label for="email">Email</label>
            @error('email')
            <div class="invalid-feedback mb-2">
              {{ $message }}
            </div>
            @enderror
          </div>

          <button class="w-100 btn btn-lg btn-warning mt-3 mb-2" type="submit">Reset Password</button>
          <small class="d-block text-center d-block">Jika lupa email silahkan hubungi admin</small>
          <small class="d-block text-center"><a href="/">Kembali</a></small>
        </form>
      </div>
    </div>
  </div>
  
  
</body>
</html>
