@extends('layout')
@section('konten')
    @if (session()->has('loginBerhasil'))
    <div class="alert alert-success alert-dismissable text-light text-center">
    {{ session()->get('loginBerhasil') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

    </button>
    </div>
@endif
@endsection