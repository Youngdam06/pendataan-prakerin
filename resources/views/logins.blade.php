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
                    <form action="{{ route('postPemb') }}" method="post">
                        {{-- apabila gagal login --}}
                        @if (session()->has('loginError'))
                            <div class="alert alert-danger alert-dismissable text-dark text-center">
                                {{ session()->get('loginError') }}
                            </div>
                        @endif
                        <h3 class="text-center">Pembimbing</h3>
                        @csrf
                        <!-- Email input -->
                        <label class="form-label" for="email">Email</label>
                        <div class="form-outline mb-4">
                            <input type="text" id="email" name="email" class="form-control form-control-lg"
                                placeholder="Enter a valid email address" />
                        </div>

                        <!-- Password input -->
                        <label class="form-label" for="password">Password</label>
                        <div class="form-outline mb-3">
                            <input type="password" id="password" name="password" class="form-control form-control-lg"
                                placeholder="Enter password" />
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        @if (session()->has('berhasil-logout'))
            Swal.fire({
                icon: 'success',
                title: 'Logout!',
                text: '{{ session()->get('berhasil-logout') }}'
            });
        @endif
    </script>
</body>

</html>
