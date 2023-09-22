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
                <div class="alert alert-primary alert-dismissable text-white" >
                    <p>{{ $message }}</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                @endif
                
                <table class="table table-bordered">
                
                <tr>
                    <th class="align-middle text-center text-sm">No</th>
                    <th class="align-middle text-center text-sm">Nama Instansi</th>
                    <th class="align-middle text-center text-sm">Nomor Telepon</th>
                    <th class="align-middle text-center text-sm">Email</th>
                    <th class="align-middle text-center text-sm" width="350px">Action</th>
                </tr>
                <tr>
                    @foreach ($instansi as $data)
                    <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                    <td class="align-middle text-center text-sm" style="white-space: pre-wrap;">{{ $data->nama_instansi }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->no_telp }}</td>
                    <td class="align-middle text-center text-sm">{{ $data->email }}</td>
                    <td>
                        <form action="{{ route('datainstansi.destroy',$data->id) }}" method="POST">
                            <div class="align-middle text-center text-sm">
                                <a class="btn btn-info" href="{{ route('datainstansi.edit',$data->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
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
                    <a class="btn bg-info btn-dark" href="{{ route('datainstansi.create') }}">Tambah data</a>
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
{{-- <div class="container">
    <a class="btn bg-primary btn-dark" href="{{ route('Instansi') }}">Tambah data</a>
</div> --}}
@endsection