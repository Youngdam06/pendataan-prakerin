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
            <h6 class="text-white text-capitalize ps-3">Kelola Data Pembimbing</h6>
          </div>
        </div>
        <div class="alert">
          @if ($message = Session::get('success'))
          <div class="alert alert-success alert-dismissable text-white m-1" >
              <p>{{ $message }}</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
        </div>
        <div class="card-body px-5 pb-0">
          <div class="table-responsive p-3">
            <table id="table-pembimbing" class="table table-bordered">
                <thead>
                <tr>
                    <th class="align-middle text-center text-sm">No</th>
                    <th class="align-middle text-center text-sm">NIK</th>
                    <th class="align-middle text-center text-sm">Nama Pembimbing</th>
                    <th class="align-middle text-center text-sm">Nomor Telepon</th>
                    <th class="align-middle text-center text-sm">Email</th>
                    <th class="align-middle text-center text-sm" width="350px">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($pembimbing as $data)
                <tr>
                    <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                    <td class="align-middle text-center text-sm" style="white-space: pre-wrap;">{{ $data->nik }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->nama_pembimbing }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->no_telp }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->email }}</td>
                    <td>
                        <form action="{{ route('datapembimbing.destroy',$data->id) }}" method="POST">
                            <div class="align-middle text-center text-sm">
                                <a class="btn btn-info" href="{{ route('datapembimbing.edit',$data->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" id="btnDelete">Delete</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
              </table>
              <div class="container">
                <a class="btn bg-info btn-dark" href="{{ route('datapembimbing.create') }}">Tambah data</a>
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
    $('#table-pembimbing').DataTable();
  });
</script>
<!-- Memuat npm sweetalert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
        // Mengambil semua tombol delete dengan ID "btnDelete"
        var deleteButtons = document.querySelectorAll("#btnDelete");

        deleteButtons.forEach(function (button) {
            button.addEventListener("click", function (event) {
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
</script>
@endsection
