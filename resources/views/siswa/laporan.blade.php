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
            <h6 class="text-white text-capitalize ps-3">Laporan Data Siswa</h6>
          </div>
        </div>
        <div class="alert">
          @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissable text-white" >
                <p>{{ $message }}</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>    
          @endif
        </div>
        
        <div class="card-body px-2 pb-0">
          <div class="table-responsive p-3">
            <table id="laporan-siswa" class="table table-bordered">
                <thead>
                <tr>
                    <th class="align-middle text-center text-sm">No</th>
                    <th class="align-middle text-center text-sm">NIS</th>
                    <th class="align-middle text-center text-sm">Nama Siswa</th>
                    <th class="align-middle text-center text-sm">Kelas</th>
                    <th class="align-middle text-center text-sm">Jurusan</th>
                    <th class="align-middle text-center text-sm">Nama Pembimbing</th>
                    <th class="align-middle text-center text-sm">Nama Instansi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($siswa as $data)
                <tr>
                    <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                    <td class="align-middle text-center text-sm" style="white-space: pre-wrap;">{{ $data->nis }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->nama }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->kelas }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->jurusan }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->nama_pembimbing }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->nama_instansi }}</td>
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
  
  </main>
{{-- javascript --}}
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#laporan-siswa').DataTable();
  });
</script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
        // Mengambil semua tombol delete dengan ID "btnDelete"
        var deleteButtons = document.querySelectorAll("#btnDelete");

        deleteButtons.forEach(function (button) {
            button.addEventListener("click", function (event) {
                event.preventDefault();

                // Tampilkan prompt konfirmasi
                var confirmation = confirm("Apakah Anda yakin ingin menghapus data ini?");

                if (confirmation) {
                    // Jika pengguna mengonfirmasi, lanjutkan dengan mengirimkan formulir
                    // Dalam hal ini, formulir di dalam loop di atas
                    button.closest("form").submit();
                } else {
                    // Jika pengguna membatalkan, tidak ada tindakan yang diambil
                    alert("Penghapusan dibatalkan.");
                }
            });
        });
    });
</script>
@endsection
