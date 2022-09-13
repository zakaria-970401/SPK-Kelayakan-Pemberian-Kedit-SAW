@extends('layouts.base')
@section('title', 'List Jatuh Tempo')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%"
                            cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>#</th>
                                    <th>Nama Nasabah</th>
                                    <th>Nominal Kredit</th>
                                    <th>Pembayaran Kredit</th>
                                    <th>Pembayaran Ke</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    @foreach ($item as $list)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="#" onclick="Pembayaran('{{ $list->id }}')"
                                                    class="btn btn-primary btn-sm"><i
                                                        class="fas fa-check-double"></i>Pembayaran</a>
                                            </td>
                                            <td>{{ $list->nama }}</td>
                                            <td scope="row">
                                                Rp.
                                                {{ number_format($list->nominal_kredit, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                Rp.
                                                {{ number_format($list->nominal_kredit / $jangka_kredit, 0, ',', '.') }}
                                            </td>
                                            <td>{{ $list->pembayaran_ke }}</td>
                                            <td>{{ \Carbon\Carbon::parse($list->jatuh_tempo)->format('d M Y') }}</td>
                                            <td><span class="badge badge-warning"> BELUM DI BAYAR</span></td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-pembyaran" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{ url('nasabah/postPembayaran') }}" method="post" id="psot-pembayaran"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="idValue" name="id" value="">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group mb-4">
                                    <input type="file" name="file_bukti" id="" class="form-control"
                                        placeholder="" aria-describedby="helpId" required>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle"></i>
                                        <span id="helpId">*jpg, png</span>
                                    </small>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> SIMPAN</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function Pembayaran(id) {
            $('.idValue').val(id);
            $('#modal-pembyaran').modal('show');
            // $.ajax({
            //     url: "{{ url('/nasabah/pembayaran') }}/" + id,
            //     type: "GET",
            //     dataType: "JSON",
            //     success: function(data) {
            //     }
            // });
        }
    </script>
@endsection
