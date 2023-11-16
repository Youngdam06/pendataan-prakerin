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
                    <h6 class="text-white text-capitalize ps-3">Kelola Data Prakerin</h6>
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
                                <form method="GET" action="{{ route('dataprakerin.index') }}">
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
                    <table id="table-prakerin" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="align-middle text-center text-sm text-dark">No</th>
                                <th class="align-middle text-center text-sm text-dark">Tanggal Awal</th>
                                <th class="align-middle text-center text-sm text-dark">Tanggal Akhir</th>
                                <th class="align-middle text-center text-sm text-dark">NIS Siswa</th>
                                <th class="align-middle text-center text-sm text-dark">Nama Siswa</th>
                                <th class="align-middle text-center text-sm text-dark">Kelas</th>
                                <th class="align-middle text-center text-sm text-dark">Jurusan</th>
                                <th class="align-middle text-center text-sm text-dark" width="350px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prakerin as $data)
                                <tr>
                                    <td class="align-middle text-center text-sm text-dark">{{ $loop->iteration }}</td>
                                    <td class="align-middle text-center text-sm text-dark">{{ date('d M Y', strtotime($data->tanggal_awal)) }}</td>
                                    <td class="align-middle text-center text-sm text-dark">{{ date('d M Y', strtotime($data->tanggal_akhir)) }}</td>
                                    <td class="align-middle text-center text-sm text-dark">{{ $data->nis }}</td>
                                    <td class="align-middle text-center text-sm text-dark" style="white-space: pre-wrap;">{{ $data->nama }}</td>
                                    <td class="align-middle text-center text-sm text-dark">{{ $data->kelas }}</td>
                                    <td class="align-middle text-center text-sm text-dark" style="white-space: pre-wrap;">{{ $data->jurusan }}</td>
                                    <td>
                                        <form action="{{ route('dataprakerin.destroy', $data->id_prakerin) }}" method="POST">
                                            <div class="align-middle text-center text-sm">
                                                <a class="btn btn-warning"
                                                    href="{{ route('dataprakerin.edit', $data->id_prakerin) }}">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    id="btnDelete">Delete</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="container">
                        <a class="btn bg-info btn-dark mt-3" href="{{ route('dataprakerin.create') }}">Tambah data</a>
                    </div>
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
        $('#table-prakerin').DataTable();
    });
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Mengambil semua tombol delete dengan ID "btnDelete"
        var deleteButtons = document.querySelectorAll("#btnDelete");

        deleteButtons.forEach(function(button) {
            button.addEventListener("click", function(event) {
                event.preventDefault();

                Swal.fire({
                    title: 'Konfirmasi Hapus Data',
                    text: "Apakah Anda yakin ingin menghapus data ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika pengguna mengonfirmasi, lanjutkan dengan mengirimkan formulir
                        // Dalam hal ini, formulir di dalam loop di atas
                        button.closest("form").submit();
                        Swal.fire(
                            'Berhasil',
                            'Data berhasil dihapus',
                            'info'
                        );
                    } else {
                        // Jika pengguna membatalkan, tidak ada tindakan yang diambil
                        Swal.fire(
                            'Dibatalkan',
                            'Data tidak dihapus',
                            'info'
                        );
                    }
                });
            });
        });
    });
</script>
<script>
    @if (session()->has('success'))
        Swal.fire({
            icon: 'success',
            title: 'Data Berhasil Ditambah!',
            text: '{{ session()->get('success') }}'
        });
    @endif

    @if (session()->has('success2'))
        Swal.fire({
            icon: 'success',
            title: 'Data Berhasil Diubah!',
            text: '{{ session()->get('success2') }}'
        });
    @endif
    @if (session()->has('status_error'))
        Swal.fire({
            icon: 'warning',
            title: 'Gagal!',
            text: '{{ session()->get('status_error') }}'
        });
    @endif
</script>
@endsection
