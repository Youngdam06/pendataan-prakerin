@extends('layout')
@section('konten')
    @if (session()->has('loginBerhasil'))
    <div class="alert alert-success alert-dismissable text-light text-center">
    {{ session()->get('loginBerhasil') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

    </button>
    </div>
    @endif
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        @if (session()->has('loginBerhasil'))
        Swal.fire({
            icon: 'success',
            title: 'Login Berhasil',
            text: '{{ session()->get('loginBerhasil') }}'
        });
        @endif
    </script>
@endsection