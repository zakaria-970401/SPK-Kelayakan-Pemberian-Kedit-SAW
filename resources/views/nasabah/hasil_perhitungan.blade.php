@extends('layouts.base')
@section('title', 'List Hasil Perhitungan')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table responsive">
                        <table id="table" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>#</th>
                                    <th>COUNT DATE</th>
                                    <th>COUNT BY</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ url('nasabah/showHasilPerhitungan/' . $item->created_at) }}"
                                                class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Show</a>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i:s') }} WIB</td>
                                        <td>{{ $item->created_by }}</td>
                                    </tr>
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
