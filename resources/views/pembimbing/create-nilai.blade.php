@extends('layout')
@section('konten')
    <main class="main-content  mt-0">
        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-12 mx-auto">
                    <div class="card z-index-0 fadeIn3 fadeInBottom">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-info shadow-info border-radius-lg py-3 pe-1">
                                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Penilaian Siswa</h4>
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
                            <form role="form" action="{{ route('postNilai', $penilaian->id) }}" class="text-start"
                                method="POST">
                                @csrf
                                @if (session('error-siswa'))
                                    <div class="alert alert-danger text-white">
                                        {{ session('error-siswa') }}
                                    </div>
                                @endif
                                <label class="form-label">Ketepatan Waktu</label>
                                @error('ketepatan_waktu')
                                    <div class="alert alert-danger text-white">{{ $message }}</div>
                                @enderror
                                <div class="input-group input-group-outline my-3">
                                    <input type="number" name="ketepatan_waktu" class="form-control"
                                        value="{{ old('ketepatan_waktu') }}">
                                </div>
                                <label class="form-label">Sikap Kerja</label>
                                @error('sikap_kerja')
                                    <div class="alert alert-danger text-white">{{ $message }}</div>
                                @enderror
                                <div class="input-group input-group-outline my-3">
                                    <input type="number" name="sikap_kerja" class="form-control"
                                        value="{{ old('sikap_kerja') }}">
                                </div>
                                <label class="form-label">Tanggung Jawab</label>
                                @error('tanggung_jawab')
                                    <div class="alert alert-danger text-white">{{ $message }}</div>
                                @enderror
                                <div class="input-group input-group-outline my-3">
                                    <input type="number" name="tanggung_jawab" class="form-control"
                                        value="{{ old('tanggung_jawab') }}">
                                </div>
                                <label class="form-label">Kehadiran</label>
                                @error('kehadiran')
                                    <div class="alert alert-danger text-white">{{ $message }}</div>
                                @enderror
                                <div class="input-group input-group-outline my-3">
                                    <input type="number" name="kehadiran" class="form-control"
                                        value="{{ old('kehadiran') }}">
                                </div>
                                <label class="form-label">Kemampuan Kerja</label>
                                @error('kemampuan_kerja')
                                    <div class="alert alert-danger text-white">{{ $message }}</div>
                                @enderror
                                <div class="input-group input-group-outline my-3">
                                    <input type="number" name="kemampuan_kerja" class="form-control"
                                        value="{{ old('kemampuan_kerja') }}">
                                </div>
                                <label class="form-label">Keterampilan Kerja</label>
                                @error('keterampilan_kerja')
                                    <div class="alert alert-danger text-white">{{ $message }}</div>
                                @enderror
                                <div class="input-group input-group-outline my-3">
                                    <input type="number" name="keterampilan_kerja" class="form-control"
                                        value="{{ old('keterampilan_kerja') }}">
                                </div>
                                <label class="form-label">Kualitas Kerja</label>
                                @error('kualitas_kerja')
                                    <div class="alert alert-danger text-white">{{ $message }}</div>
                                @enderror
                                <div class="input-group input-group-outline my-3">
                                    <input type="number" name="kualitas_kerja" class="form-control"
                                        value="{{ old('kualitas_kerja') }}">
                                </div>
                                <label class="form-label">Berkomunikasi</label>
                                @error('berkomunikasi')
                                    <div class="alert alert-danger text-white">{{ $message }}</div>
                                @enderror
                                <div class="input-group input-group-outline my-3">
                                    <input type="number" name="berkomunikasi" class="form-control"
                                        value="{{ old('berkomunikasi') }}">
                                </div>
                                <label class="form-label">Kerjasama</label>
                                @error('kerjasama')
                                    <div class="alert alert-danger text-white">{{ $message }}</div>
                                @enderror
                                <div class="input-group input-group-outline my-3">
                                    <input type="number" name="kerjasama" class="form-control"
                                        value="{{ old('kerjasama') }}">
                                </div>
                                <label class="form-label">Kerajinan</label>
                                @error('kerajinan')
                                    <div class="alert alert-danger text-white">{{ $message }}</div>
                                @enderror
                                <div class="input-group input-group-outline my-3">
                                    <input type="number" name="kerajinan" class="form-control"
                                        value="{{ old('kerajinan') }}">
                                </div>
                                <label class="form-label">Rasa Percaya Diri</label>
                                @error('rasa_pd')
                                    <div class="alert alert-danger text-white">{{ $message }}</div>
                                @enderror
                                <div class="input-group input-group-outline my-3">
                                    <input type="number" name="rasa_pd" class="form-control" value="{{ old('rasa_pd') }}">
                                </div>
                                <label class="form-label">Mematuhi Aturan</label>
                                @error('mematuhi_aturan')
                                    <div class="alert alert-danger text-white">{{ $message }}</div>
                                @enderror
                                <div class="input-group input-group-outline my-3">
                                    <input type="number" name="mematuhi_aturan" class="form-control"
                                        value="{{ old('mematuhi_aturan') }}">
                                </div>
                                <label class="form-label">Penampilan</label>
                                @error('penampilan')
                                    <div class="alert alert-danger text-white">{{ $message }}</div>
                                @enderror
                                <div class="input-group input-group-outline my-3">
                                    <input type="number" name="penampilan" class="form-control"
                                        value="{{ old('penampilan') }}">
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
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');

            form.addEventListener('submit', function(event) {
                const nik = form.querySelector('[name="nik"]');
                const namaPembimbing = form.querySelector('[name="nama_pembimbing"]');
                const no_telp = form.querySelector('[name="no_telp"]');
                const email = form.querySelector('[name="email"]');

                if (!nik.value || !namaPembimbing.value || !noTelp.value || !email.value) {
                    event.preventDefault(); // Mencegah pengiriman form
                    alert('Harap isi semua field sebelum menambahkan data.');
                }
            });
        });
    </script>
@endsection
