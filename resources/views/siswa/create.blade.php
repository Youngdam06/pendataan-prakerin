@extends('layout')
@section('konten')
<main class="main-content  mt-0">
    <div class="container my-auto">
    <div class="row">
        <div class="col-lg-5 col-md-8 col-12 mx-auto">
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
                <input type="number" name="nis" class="form-control" value="{{ old('nis') }}">
                </div>
                <label class="form-label">Nama Siswa</label>
                @error('nama')
                <div class="alert alert-danger text-white">{{ $message }}</div>
                @enderror
                <div class="input-group input-group-outline my-3">
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                </div>
                <label class="form-label">No Telepon</label>
                @error('no_telp')
                <div class="alert alert-danger text-white">{{ $message }}</div>
                @enderror
                <div class="input-group input-group-outline my-3">
                <input type="number" name="no_telp" class="form-control" value="{{ old('no_telp') }}">
                </div>
                <label class="form-label">Kelas</label>
                @error('kelas')
                <div class="alert alert-danger text-white">{{ $message }}</div>
                @enderror
                <div class="input-group input-group-outline my-3">
                    <select name="kelas" class="form-select form-select-outline my-3" value="{{ old('kelas') }}">
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
                <label class="form-label">Jurusan</label>
                @error('jurusan')
                <div class="alert alert-danger text-white">{{ $message }}</div>
                @enderror
                <div class="input-group input-group-outline my-3">
                <select name="jurusan" class="form-select form-select-outline my-3" value="{{ old('jurusan') }}">
                    <option value="Multimedia">Multimedia</option>
                    <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                    <option value="Otomatisasi Tata Kelola Perkantoran">Otomatisasi Tata Kelola Perkantoran</option>
                </select>
                </div>
                <label class="form-label">Angkatan</label>
                @error('angkatan')
                <div class="alert alert-danger text-white">{{ $message }}</div>
                @enderror
                <div class="input-group input-group-outline my-3">
                <input type="number" name="angkatan" class="form-control" value="{{ old('angkatan') }}">
                </div>
                <label class="form-label">Email</label>
                {{-- tampil error email --}}
                @error('email')
                <div class="alert alert-danger text-white">{{ $message }}</div>
                @enderror
                <div class="input-group input-group-outline my-3">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                <label class="form-label">Instansi</label>
                <div class="input-group input-group-outline my-1">
                    <select name="id_instansi" class="form-select form-select-outline my-3" value="{{ old('id_instansi') }}">
                        <option value="">Pilih Instansi</option>
                        @foreach($instansi as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <label class="form-label">Pembimbing</label>
                <div class="input-group input-group-outline my-1">
                    <select name="id_pembimbing" class="form-select form-select-outline my-3" value="{{ old('id_pembimbing') }}">
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
        const nis = form.querySelector('[name="nis"]');
        const namaSiswa = form.querySelector('[name="nama"]');
        const noTelp = form.querySelector('[name="no_telp"]');
        const kelas = form.querySelector('[name="kelas"]');
        const jurusan = form.querySelector('[name="jurusan"]');
        const angkatan = form.querySelector('[name="angkatan"]');
        const email = form.querySelector('[name="email"]');
        const instansi = form.querySelector('[name="id_instansi"]');
        const pembimbing = form.querySelector('[name="id_pembimbing"]');

        if (!nis.value || !namaSiswa.value || !noTelp.value
            || !kelas.value || !jurusan.value || !angkatan.value
            || !email.value || !instansi.value || !pembimbing.value ) {
            event.preventDefault(); // Mencegah pengiriman form
            alert('Harap isi semua field sebelum menambahkan data.');
        }
    });
});
</script>

@endsection