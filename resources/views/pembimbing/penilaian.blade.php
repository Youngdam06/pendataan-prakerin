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
        <div class="card-body px-3 pb-2">
          <div class="table-responsive p-0">
            <table id="table-penilaian" class="table table-bordered">
                <thead>
                <tr>
                    <th class="align-middle text-center text-sm">No</th>
                    <th class="align-middle text-center text-sm">NIS Siswa</th>
                    <th class="align-middle text-center text-sm">Nama Siswa</th>
                    <th class="align-middle text-center text-sm">Kelas</th>
                    <th class="align-middle text-center text-sm">Jurusan</th>
                    <th class="align-middle text-center text-sm">Tanggal Awal</th>
                    <th class="align-middle text-center text-sm">Tanggal Akhir</th>
                    <th class="align-middle text-center text-sm">Nama Instansi</th>
                    <th class="align-middle text-center text-sm" width="350px">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($penilaian as $data)
                <tr>
                    <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->nis }}</td>
                    <td class="align-middle text-center text-sm" style="white-space: pre-wrap;">{{ $data->nama }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->kelas }}</td>
                    <td class="align-middle text-center text-sm" style="white-space: pre-wrap;">{{ $data->jurusan }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->tanggal_awal }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->tanggal_akhir }}</td>
                    <td class="align-middle text-center text-sm" style="white-space: pre-wrap;">{{ $data->nama_instansi }}</td>
                    <td>
                      @if (!$data->sudahDinilai) <!-- Tambahkan kondisi ini -->
                        @if (strtotime($data->tanggal_akhir) < strtotime(date('Y-m-d'))) <!-- Tambahkan kondisi ini -->
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
          text: 'Karena siswa belum selesai prakerin',
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
