@extends('layout')
@section('konten')
<main class="main-content  mt-0">
    <div class="container my-auto">
    <div class="row">
        <div class="col-lg-6 col-md-8 col-12 mx-auto">
        <div class="card z-index-0 fadeIn3 fadeInBottom">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-info shadow-info border-radius-lg py-3 pe-1">
                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">ISI DATA</h4>
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
            <form role="form" action="{{ route('datasiswa.store') }}" class="text-start" method="POST">
                @csrf
                <label class="form-label">NIS</label>
                {{-- tampil error nis --}}
                @error('nis')
                <div class="alert alert-danger text-white">{{ $message }}</div>
                @enderror
                <div class="input-group input-group-outline my-3">
                <input type="number" name="nis" class="form-control">
                </div>
                <label class="form-label">Nama Siswa</label>
                <div class="input-group input-group-outline my-3">
                <input type="text" name="nama" class="form-control">
                </div>
                <label class="form-label">No Telepon</label>
                <div class="input-group input-group-outline my-3">
                <input type="number" name="no_telp" class="form-control">
                </div>
                <label class="form-label">Kelas</label>
                <div class="input-group input-group-outline my-3">
                <input type="number" name="kelas" class="form-control">
                </div>
                <label class="form-label">Jurusan</label>
                <div class="input-group input-group-outline my-3">
                {{-- <input type="text" name="jurusan" class="form-control"> --}}
                <select name="jurusan" class="form-select form-select-outline my-3">
                    <option value="Multimedia">Multimedia</option>
                    <option value="Rakayasa Perangkat Lunak">Rakayasa Perangkat Lunak</option>
                    <option value="Otomatisasi Tata Kelola Perkantoran">Otomatisasi Tata Kelola Perkantoran</option>
                </select>
                </div>
                <label class="form-label">Angkatan</label>
                <div class="input-group input-group-outline my-3">
                <input type="text" name="angkatan" class="form-control">
                </div>
                <label class="form-label">Email</label>
                {{-- tampil error email --}}
                @error('email')
                <div class="alert alert-danger text-white">{{ $message }}</div>
                @enderror
                <div class="input-group input-group-outline my-3">
                    <input type="email" name="email" class="form-control" id="dengan-rupiah">
                </div>
                <label class="form-label">Instansi</label>
                <div class="input-group input-group-outline my-1">
                    <select name="id_instansi" class="form-select form-select-outline my-3">
                        <option value="">Pilih Instansi</option>
                        @foreach($instansi as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <label class="form-label">Pembimbing</label>
                <div class="input-group input-group-outline my-1">
                    <select name="id_pembimbing" class="form-select">
                        <option value="">Pilih Pembimbing</option>
                        @foreach($pembimbing as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-center">
                <button type="submit" class="btn bg-gradient-info w-100 my-4 mb-2">Tambahkan</button>
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
<script>
// fungsi untuk menambahkan pesan alert, jika ada item yang kosong
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    form.addEventListener('submit', function (event) {
        const namaInstansi = form.querySelector('[name="nama_instansi"]');
        const noTelp = form.querySelector('[name="no_telp"]');
        const email = form.querySelector('[name="email"]');

        if (!namaInstansi.value || !noTelp.value || !email.value) {
            event.preventDefault(); // Mencegah pengiriman form
            alert('Harap isi semua field sebelum menambahkan data.');
        }
    });
});
</script>

@endsection