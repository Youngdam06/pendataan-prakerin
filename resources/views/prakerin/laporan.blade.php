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
        <div class="container mt-4">
          <div class="row justify-content-center">
            <div class="col-md-11">
              <div class="card">
                <div class="card-header"><h6>Filter Tanggal </h6></div>
                <div class="card-body">
                  <form method="GET" action="{{ route('laporanprakerin') }}">
                    <div class="row mt-1">
                        <div class="col-md-4 form-group">
                            <label for="tanggal_awal" class="text-dark">Tanggal Awal</label>
                            <input type="date" class="form-control" name="tanggal_awal" id="tanggal_awal">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="tanggal_akhir" class="text-dark">Tanggal Akhir</label>
                            <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir">
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
          <div class="table-responsive p-0 text-dark  ">
            <table id="laporan-prakerin" class="table table-bordered">
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
                @foreach ($prakerin as $data)
                <tr>
                    <td class="align-middle text-center text-sm text-dark">{{ $loop->iteration }}</td>
                    <td class="align-middle text-center text-sm text-dark">{{ date('d M Y', strtotime($data->tanggal_awal)) }}</td>
                    <td class="align-middle text-center text-sm text-dark">{{  date('d M Y', strtotime($data->tanggal_akhir)) }}</td>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
@if (session()->has('status_error'))
Swal.fire({
    icon: 'warning',
    title: 'Gagal!',
    text: '{{ session()->get('status_error') }}'
});
@endif
</script>

@endsection
