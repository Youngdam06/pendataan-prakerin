@extends('layout')
@section('konten')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">weekend</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize text-bold text-dark" >Jumlah Instansi</p>
                        {{-- menampilkan hasil count di controller --}}
                        <h4 class="mb-0 ">{{ $instansi }}</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize text-bold text-dark">Jumlah Siswa</p>
                        <h4 class="mb-0">{{ $siswa }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-info shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize text-bold text-dark">Jumlah</p>
                        <p class="text-sm mb-0 text-capitalize text-bold text-dark">Pembimbing</p>
                        <h4 class="mb-0">{{ $pembimbing }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">schedule</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize text-bold text-dark">Jumlah</p>
                        <p class="text-sm mb-0 text-capitalize text-bold text-dark">Siswa Prakerin</p>
                        <h4 class="mb-0">{{ $prakerin }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
{{-- link --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
{{-- link --}}
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Data Prakerin Siswa</h6>
                </div>
            </div>
            <div class="card-body px-3 pb-2 text-dark">
                <div class="table-responsive p-0 text-dark">
                    {{-- tabel untuk menampilkan data siswa yang prakerin --}}
                    <table id="table-prakerin" class="table table-bordered text-dark">
                        <thead>
                            <tr>
                                <th class="align-middle text-center text-sm text-dark">No</th>
                                <th class="align-middle text-center text-sm text-dark">Tanggal Awal</th>
                                <th class="align-middle text-center text-sm text-dark">Tanggal Akhir</th>
                                <th class="align-middle text-center text-sm text-dark">NIS Siswa</th>
                                <th class="align-middle text-center text-sm text-dark">Nama Siswa</th>
                                <th class="align-middle text-center text-sm text-dark">Kelas</th>
                                <th class="align-middle text-center text-sm text-dark">Jurusan</th>
                                <th class="align-middle text-center text-sm text-dark">Nama Instansi</th>
                                <th class="align-middle text-center text-sm text-dark">Nama Pembimbing</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prakerin1 as $data)
                                <tr>
                                    <td class="align-middle text-center text-sm text-dark">{{ $loop->iteration }}</td>
                                    <td class="align-middle text-center text-sm text-dark">{{ date('d M Y', strtotime($data->tanggal_awal)) }}</td>
                                    <td class="align-middle text-center text-sm text-dark">{{ date('d M Y', strtotime($data->tanggal_akhir)) }}</td>
                                    <td class="align-middle text-center text-sm text-dark">{{ $data->nis }}</td>
                                    <td class="align-middle text-center text-sm text-dark" style="white-space: pre-wrap;">{{ $data->nama }}</td>
                                    <td class="align-middle text-center text-sm text-dark">{{ $data->kelas }}</td>
                                    <td class="align-middle text-center text-sm text-dark" style="white-space: pre-wrap;">{{ $data->jurusan }}</td>
                                    <td class="align-middle text-center text-sm text-dark" style="white-space: pre-wrap;">{{ $data->nama_instansi }}</td>
                                    <td class="align-middle text-center text-sm text-dark" style="white-space: pre-wrap;">{{ $data->nama_pembimbing }}</td>
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
</div>
</div>

</main>
{{-- javascript --}}
<!-- Memuat jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table-prakerin').DataTable(
            
        );
    });
</script>
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
