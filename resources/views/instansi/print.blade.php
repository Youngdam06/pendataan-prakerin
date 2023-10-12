{{-- link --}}
<!-- Memuat DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
{{-- link --}}
<main>
  <table class="static" align="center" rules="all" border="1px" style="width:95%" id="laporan-instansi" class="table table-bordered">
    <thead>
      <tr>
        <th class="align-middle text-center text-sm">No</th>
        <th class="align-middle text-center text-sm">Nama Instansi</th>
        <th class="align-middle text-center text-sm">Nomor Telepon</th>
        <th class="align-middle text-center text-sm">Email</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($instansi as $data)
      <tr>  
        <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
        <td class="align-middle text-center text-sm" style="white-space: pre-wrap;">{{ $data->nama_instansi }}</td>
        <td class="align-middle text-center text-sm">{{ $data->no_telp }}</td>
        <td class="align-middle text-center text-sm">{{ $data->email }}</td>
      </tr>
      @endforeach
      </tbody>
  </table>
</main>
{{-- javascript --}}
{{-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#laporan-instansi').DataTable();
  });
</script> --}}
