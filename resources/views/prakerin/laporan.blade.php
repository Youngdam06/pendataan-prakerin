@extends('layout')
@section('konten')
{{-- link --}}
<!-- Memuat DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
{{-- link --}}
<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">laporan Data Prakerin</h6>
          </div>
        </div>
        <div class="card-body px-3 pb-2">
          <div class="table-responsive p-0">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissable text-white">
                <p>{{ $message }}</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            <table id="laporan-prakerin" class="table table-bordered">
                <thead>
                <tr>
                    <th class="align-middle text-center text-sm">No</th>
                    <th class="align-middle text-center text-sm">Tanggal Awal</th>
                    <th class="align-middle text-center text-sm">Tanggal Akhir</th>
                    <th class="align-middle text-center text-sm">NIS Siswa</th>
                    <th class="align-middle text-center text-sm">Nama Siswa</th>
                    <th class="align-middle text-center text-sm">Kelas</th>
                    <th class="align-middle text-center text-sm">Jurusan</th>
                    <th class="align-middle text-center text-sm">Nama Instansi</th>
                    <th class="align-middle text-center text-sm">Nama Pembimbing</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($prakerin as $data)
                <tr>
                    <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                    <td class="align-middle text-center text-sm" style="white-space: pre-wrap;">{{ $data->tanggal_awal }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->tanggal_akhir }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->nis }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->nama }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->kelas }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->jurusan }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->nama_instansi }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->nama_pembimbing }}</td>
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
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
        $('#laporan-prakerin').DataTable({
          dom: 'Bfrtip',
          buttons: [
            'pdf', 'print'
          ]
        });
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
