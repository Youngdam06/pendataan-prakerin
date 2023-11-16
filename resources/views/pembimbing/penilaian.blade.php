@extends('layout')
@section('konten')
{{-- link --}}
<!-- Memuat DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
{{-- link --}}
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Penilaian Siswa Prakerin</h6>
                </div>
            </div>
            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-11">
                        <div class="card">
                            <div class="card-header">
                                <h6>Filter Tanggal </h6>
                            </div>
                            <div class="card-body">
                                <form method="GET" action="{{ route('indexNilai') }}">
                                    <div class="row mt-1">
                                        <div class="col-md-4 form-group">
                                            <label for="tanggal_awal" class="text-dark">Tanggal Awal</label>
                                            <input type="date" class="form-control" name="tanggal_awal"
                                                id="tanggal_awal">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="tanggal_akhir" class="text-dark">Tanggal Akhir</label>
                                            <input type="date" class="form-control" name="tanggal_akhir"
                                                id="tanggal_akhir">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <button type="submit" class="btn btn-info">Filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-3 pb-2">
                <div class="table-responsive p-0 text-dark">
                    <table id="table-penilaian" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="align-middle text-center text-sm text-dark">No</th>
                                <th class="align-middle text-center text-sm text-dark">NIS Siswa</th>
                                <th class="align-middle text-center text-sm text-dark">Nama Siswa</th>
                                <th class="align-middle text-center text-sm text-dark">Kelas</th>
                                <th class="align-middle text-center text-sm text-dark">Jurusan</th>
                                <th class="align-middle text-center text-sm text-dark">Tanggal Awal</th>
                                <th class="align-middle text-center text-sm text-dark">Tanggal Akhir</th>
                                <th class="align-middle text-center text-sm text-dark">Nama Instansi</th>
                                <th class="align-middle text-center text-sm text-dark" width="350px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penilaian as $data)
                                <tr>
                                    <td class="align-middle text-center text-sm text-dark">{{ $loop->iteration }}</td>
                                    <td class="align-middle text-center text-sm text-dark">{{ $data->nis }}</td>
                                    <td class="align-middle text-center text-sm text-dark" style="white-space: pre-wrap;">{{ $data->nama }}</td>
                                    <td class="align-middle text-center text-sm text-dark">{{ $data->kelas }}</td>
                                    <td class="align-middle text-center text-sm text-dark" style="white-space: pre-wrap;">{{ $data->jurusan }}</td>
                                    <td class="align-middle text-center text-sm text-dark">{{ date('d M Y', strtotime($data->tanggal_awal)) }}</td>
                                    <td class="align-middle text-center text-sm text-dark">{{ date('d M Y', strtotime($data->tanggal_akhir)) }}</td>
                                    <td class="align-middle text-center text-sm text-dark" style="white-space: pre-wrap;">{{ $data->nama_instansi }}</td>
                                    <td>
                                        @if (!$data->sudahDinilai)
                                            <!-- kondisi ketika id siswa sudah ada yang dinilai -->
                                            @if (strtotime($data->tanggal_akhir) < strtotime(date('Y-m-d')))
                                                <!-- kondisi apabila pembimbing klik tombol sebelum/sesudah siswa prakerin  -->
                                                <div class="align-middle text-center text-sm">
                                                    <a class="btn btn-info" href="{{ route('createNilai', $data->id_siswa) }}">Nilai</a>
                                                </div>
                                            @else
                                                <div class="align-middle text-center text-sm">
                                                    <button class="btn btn-info" onclick="showAlert()">Nilai</button>
                                                </div>
                                            @endif
                                        @else
                                            <div class="align-middle text-center text-sm text-danger">
                                                Sudah Dinilai
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

</main>
{{-- javascript --}}
<!-- Memuat jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table-penilaian').DataTable();
    });
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function showAlert() {
        Swal.fire({
            icon: 'warning',
            title: 'Belum bisa dinilai!',
            text: 'Karena siswa belum selesai prakerin / belum memulai prakerin',
        });
    }
</script>
<script>
    @if (session()->has('success'))
        Swal.fire({
            icon: 'success',
            title: 'Data Berhasil di Tambah!',
            text: '{{ session()->get('success') }}'
        });
    @endif
</script>
@endsection
