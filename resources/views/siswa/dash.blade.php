@extends('layout')
@section('konten')
<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Kelola Data Instansi</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center justify-content-center mb-0">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissable text-white" >
                    <p>{{ $message }}</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                @endif
                
                <table class="table table-bordered">
                
                <tr>
                    <th class="align-middle text-center text-sm">No</th>
                    <th class="align-middle text-center text-sm">NIS</th>
                    <th class="align-middle text-center text-sm">Nama Siswa</th>
                    <th class="align-middle text-center text-sm">Nomor Telepon</th>
                    <th class="align-middle text-center text-sm">Kelas</th>
                    <th class="align-middle text-center text-sm">Angkatan</th>
                    <th class="align-middle text-center text-sm">Email</th>
                    <th class="align-middle text-center text-sm">Id Instansi</th>
                    <th class="align-middle text-center text-sm">Id Pembimbing</th>
                    <th class="align-middle text-center text-sm" width="350px">Action</th>
                </tr>
                <tr>
                    @foreach ($siswa as $data)
                    <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                    <td class="align-middle text-center text-sm" style="white-space: pre-wrap;">{{ $data->nis }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->nama }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->no_telp }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->kelas }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->angkatan }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->email }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->id_instansi }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->id_pembimbing }}</td>
                    <td>
                        <form action="{{ route('datasiswa.destroy',$data->id) }}" method="POST">
                            <div class="align-middle text-center text-sm">
                                <a class="btn btn-info" href="{{ route('datasiswa.edit',$data->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" id="btnDelete">Delete</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
              </table>
              {{-- <div class="row text-center">
                {!! $pemasukans->links() !!}
              </div> --}}
                <div class="container">
                    <a class="btn bg-info btn-dark" href="{{ route('datasiswa.create') }}">Tambah data</a>
                </div>
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