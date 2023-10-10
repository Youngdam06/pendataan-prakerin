@extends('layout')
@section('konten')
    <main class="main-content  mt-0">
        <div class="container my-auto">
        <div class="row">
            <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-info shadow-info border-radius-lg py-3 pe-1">
                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">EDIT DATA</h4>
                    <div class="row mt-3">
                    <div class="col-2 text-center ms-auto">
                    </div>
                    <div class="col-2 text-center px-1">
                    </div>
                    <div class="col-2 text-center me-auto">
                    </div>
                    </div>
                </div>
                </div>
                <div class="card-body">
                <form role="form" action="{{ route('datapembimbing.update',$pembimbing->id) }}" class="text-start" method="POST">
                    @csrf
                    @method('PUT')
                    <label class="form-label">NIK</label>
                    <div class="input-group input-group-outline my-3">
                    <input type="number" name="nik" value="{{ $pembimbing->nik }}" class="form-control">
                    </div>
                    <label class="form-label">Nama Pembimbing</label>
                    <div class="input-group input-group-outline my-3">
                    <input type="text" name="nama" value="{{ $pembimbing->nama }}" class="form-control">
                    </div>
                    <label class="form-label">Nomor Telepon</label>
                    <div class="input-group input-group-outline my-3">
                    <input type="number" name="no_telp" value="{{ $pembimbing->no_telp }}"class="form-control">
                    </div>
                    <label class="form-label">Email</label>
                    {{-- tampil error email --}}
                    @error('email')
                        <div class="alert alert-danger text-white">{{ $message }}</div>
                    @enderror
                    <div class="input-group input-group-outline my-3">
                    <input type="email" name="email" value="{{ $pembimbing->email }}" class="form-control" id="dengan-rupiah">
                    </div>
                    <div class="text-center">
                    <button type="submit" class="btn bg-gradient-info w-100 my-4 mb-2">Ubah Data</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
        </div>
        <footer class="footer position-absolute bottom-2 py-2 w-100">
        <div class="container">
            <div class="row align-items-center justify-content-lg-between">
            <div class="col-12 col-md-6 my-auto">
            </div>
            </div>
        </div>
        </footer>
    </div>
    </main>
@endsection