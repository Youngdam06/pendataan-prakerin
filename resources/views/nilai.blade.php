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
                        <h6 class="text-white text-capitalize ps-3">Laporan Data Siswa</h6>
                    </div>
                </div>
                <div class="card-body px-1 pb-0">
                    <div class="table-responsive p-3 text-dark">
                        <table id="laporan-siswa" class="table table-bordered mt-0">
                            <thead>
                                <tr>
                                    <th class="align-middle text-center text-sm text-dark">No</th>
                                    <th class="align-middle text-center text-sm text-dark">Nama Siswa</th>
                                    <th class="align-middle text-center text-sm text-dark">Nama Pembimbing</th>
                                    <th class="align-middle text-center text-sm text-dark">Ketepatan Waktu</th>
                                    <th class="align-middle text-center text-sm text-dark">Sikap Kerja</th>
                                    <th class="align-middle text-center text-sm text-dark">Tanggung Jawab</th>
                                    <th class="align-middle text-center text-sm text-dark">Kehadiran</th>
                                    <th class="align-middle text-center text-sm text-dark">Kemampuan Kerja</th>
                                    <th class="align-middle text-center text-sm text-dark">Keterampilan Kerja</th>
                                    <th class="align-middle text-center text-sm text-dark">Kualitas Kerja</th>
                                    <th class="align-middle text-center text-sm text-dark">Berkomunikasi</th>
                                    <th class="align-middle text-center text-sm text-dark">Kerjasama</th>
                                    <th class="align-middle text-center text-sm text-dark">Kerajinan</th>
                                    <th class="align-middle text-center text-sm text-dark">Rasa Percaya Diri</th>
                                    <th class="align-middle text-center text-sm text-dark">Mematuhi Aturan</th>
                                    <th class="align-middle text-center text-sm text-dark">Penampilan</th>
                                    <th class="align-middle text-center text-sm text-dark">Total Nilai</th>
                                    <th class="align-middle text-center text-sm text-dark">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai as $data)
                                    <tr>
                                        <td class="align-middle text-center text-sm text-dark">{{ $loop->iteration }}</td>
                                        <td class="align-middle text-center text-sm text-dark" style="white-space: pre-wrap;">{{ $data->nama_siswa }}</td>
                                        <td class="align-middle text-center text-sm text-dark" style="white-space: pre-wrap;">{{ $data->nama_pembimbing }}</td>
                                        <td class="align-middle text-center text-sm text-dark">{{ $data->ketepatan_waktu }}</td>
                                        <td class="align-middle text-center text-sm text-dark">{{ $data->sikap_kerja }}</td>
                                        <td class="align-middle text-center text-sm text-dark">{{ $data->tanggung_jawab }}</td>
                                        <td class="align-middle text-center text-sm text-dark">{{ $data->kehadiran }}</td>
                                        <td class="align-middle text-center text-sm text-dark">{{ $data->kemampuan_kerja }}</td>
                                        <td class="align-middle text-center text-sm text-dark">{{ $data->keterampilan_kerja }}</td>
                                        <td class="align-middle text-center text-sm text-dark">{{ $data->kualitas_kerja }}</td>
                                        <td class="align-middle text-center text-sm text-dark">{{ $data->berkomunikasi }}</td>
                                        <td class="align-middle text-center text-sm text-dark">{{ $data->kerjasama }}</td>
                                        <td class="align-middle text-center text-sm text-dark">{{ $data->kerajinan }}</td>
                                        <td class="align-middle text-center text-sm text-dark">{{ $data->rasa_pd }}</td>
                                        <td class="align-middle text-center text-sm text-dark">{{ $data->mematuhi_aturan }}</td>
                                        <td class="align-middle text-center text-sm text-dark">{{ $data->penampilan }}</td>
                                        <td class="align-middle text-center text-sm text-dark">{{ $data->ttl_nilai }}</td>
                                        <td class="align-middle text-center text-sm text-dark">
                                            <a href="{{ route('exportNilai', ['id' => $data->id_siswa]) }}" class="btn btn-success btn-sm">Export</a>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <form action="{{ route('importExcel') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="excelFile"></label>
                                <input type="file" class="form-control-file" id="excelFile" name="excelFile">
                            </div>
                            <button type="submit" class="btn btn-info mt-2">Import Excel</button>
                        </form>
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
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#laporan-siswa').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'print'
                ]
            });
        });
    </script>
@endsection
