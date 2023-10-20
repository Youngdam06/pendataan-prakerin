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
            <h6 class="text-white text-capitalize ps-3">Laporan Data Pembimbing</h6>
          </div>
        </div>
        <div class="alert">
          @if ($message = Session::get('success'))
          <div class="alert alert-success alert-dismissable text-white m-1" >
              <p>{{ $message }}</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
        </div>
        <div class="card-body px-1 pb-5">
          <div class="table-responsive p-0">
            <table id="laporan-pembimbing" class="table table-bordered">
                <thead>
                <tr>
                    <th class="align-middle text-center text-sm">No</th>
                    <th class="align-middle text-center text-sm">NIK</th>
                    <th class="align-middle text-center text-sm">Nama Pembimbing</th>
                    <th class="align-middle text-center text-sm">NIS Siswa</th>
                    <th class="align-middle text-center text-sm">Nama Siswa</th>
                    <th class="align-middle text-center text-sm">Jurusan Siswa</th>
                    <th class="align-middle text-center text-sm">Nama Instansi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($pembimbing as $data)
                <tr>
                    <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                    <td class="align-middle text-center text-sm" style="white-space: pre-wrap;">{{ $data->nik }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->nama_pembimbing }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->nis }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->nama }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->jurusan }}</td>
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
    $('#laporan-pembimbing').DataTable({
      dom: 'Bfrtip',
      buttons: [
        'pdf', 'print'
      ] 
    });
  });
</script>
@endsection
