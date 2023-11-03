<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Pendataan Prakerin</title>
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form role="form" class="text-start" action="{{ route('postReg') }}" method="POST">
                        @csrf
                        <label class="form-label" for="nama">Nama</label>
                        <div class="form-outline mb-4">
                        <input type="text" id="nama" name="nama" class="form-control form-control-lg"
                            placeholder="Masukkan nama" />
                        </div>
                        <label class="form-label" for="email">Nomor Telepon</label>
                        <div class="form-outline mb-4">
                            <input type="number" class="form-control form-control-lg" name="no_telp" id="notelp"
                            placeholder="Masukkan nomor telepon">
                        </div>
                        <label class="form-label" for="email">Email</label>
                        @error('email')
                            <div class="alert alert-danger text-black">{{ $message }}</div>
                        @enderror
                        <div class="form-outline mb-4">
                            <input type="email" class="form-control form-control-lg" name="email" id="email"
                            placeholder="Masukkan alamat email">
                        </div>
                        <label class="form-label" for="password">Password</label> 
                        <div class="form-outline mb-3">
                        <input type="password" id="password" name="password" class="form-control form-control-lg"
                            placeholder="Masukkan password" />
                        </div>
                        <div class="text-center">
                            <button type="submit" name="submit"
                                class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                        </div>
                        <small class="d-block mt-3">Sudah punya akun? Silahkan <a class="text-danger" href="/signin">
                                Sign in
                            </a></small>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
