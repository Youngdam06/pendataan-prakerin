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
                <form role="form" action="{{ route('dataprakerin.update',$prakerin->id) }}" class="text-start" method="POST">
                    @csrf
                    @method('PUT')
                    <label class="form-label">Tanggal Awal</label>
                    <div class="input-group input-group-outline my-3">
                    <input type="date" name="tanggal_awal" value="{{ $prakerin->tanggal_awal }}" class="form-control" min="{{ date('Y-m-d') }}">
                    </div>
                    <label class="form-label">Nomor Telepon</label>
                    <div class="input-group input-group-outline my-3">
                    <input type="date" name="tanggal_akhir" value="{{ $prakerin->tanggal_akhir }}"class="form-control" min="{{ date('Y-m-d') }}">
                    </div>
                    <label class="form-label">Nama Siswa</label>
                    @error('id_siswa')
                    <div class="alert alert-danger text-white">{{ $message }}</div>
                    @enderror
                    <div class="input-group input-group-outline my-3">
                        <select name="id_siswa" class="form-select form-select-outline my-3">
                            <option value="">Pilih Siswa</option>
                            @foreach($siswa as $key => $value)
                                <option value="{{ $key }}" {{ $key == $prakerin->id_siswa ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
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