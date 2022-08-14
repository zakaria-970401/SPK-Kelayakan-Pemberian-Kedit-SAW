@extends('layouts.base')
@section('title', 'Pengajuan Kredit')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h3>Form Pengajuan Kredit Nasabah</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ url('nasabah/checkKelayakan') }}" method="post" id="form-pengajuan">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="nama_nasabah" class="col-form-label">Nama Nasabah</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control"
                                            aria-describedby="passwordHelpInline" required placeholder="Silahkan Di isi"
                                            autofocus="on">
                                    </div>
                                </div>
                                <div class="row g-3 mt-4 align-items-center">
                                    <div class="col-auto">
                                        <label for="" class="col-form-label">Jenis Kelamin</label>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-control" name="jenis_kelamin" required id="">
                                            <option value="" disabled selected>SILAHKAN DI PILIH</option>
                                            <option value="LAKI-LAKI">LAKI-LAKI</option>
                                            <option value="PEREMPUAN">PEREMPUAN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-3 mt-4 align-items-center">
                                    <div class="col-auto">
                                        <label for="" class="col-form-label">Usia Nasabah</label>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-control" name="usia" required id="">
                                            <option value="" disabled selected>SILAHKAN DI PILIH</option>
                                            @for ($i = 17; $i <= 90; $i++)
                                                <option value="{{ $i }}">{{ $i }} TAHUN</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="" class="col-form-label">Status Pernikahan</label>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-control" name="status_pernikahan" required id="">
                                            <option value="" disabled selected>SILAHKAN DI PILIH</option>
                                            <option value="BELUM MENIKAH">BELUM MENIKAH</option>
                                            <option value="MENIKAH">MENIKAH</option>
                                            <option value="JANDA">JANDA</option>
                                            <option value="DUDA">DUDA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mt-4">
                                    <div class="col-auto">
                                        <label for="nama_nasabah" class="col-form-label">Alamat Nasabah</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" id="alamat_nasabah" name="alamat_nasabah" class="form-control"
                                            aria-describedby="passwordHelpInline" required placeholder="Silahkan Di isi"
                                            autofocus="on">
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mt-4 filektp">
                                    <div class="col-auto">
                                        <label for="nama_nasabah" class="col-form-label">File KTP</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="file" id="file_ktp" name="file_ktp" class="form-control"
                                            aria-describedby="passwordHelpInline" required placeholder="Silahkan Di isi"
                                            autofocus="on">
                                        <small class="form-text text-muted">*.jpg .png .pdf</small>
                                    </div>
                                </div>
                                <div class="float-end">
                                    <button type="button" class="btn btn-primary btnnext hidden" onclick="showsaw()"
                                        style=""><i class="fas fa-check-circle"></i> Lanjutkan</button>
                                </div>
                            </div>
                            <div class="col-sm-12 viewSaw hidden">
                                <hr>
                                @foreach ($kriteria as $item)
                                    @php
                                        $name = strtolower($item->kriteria);
                                        $name = implode('_', explode(' ', $name));
                                        $sub_where = $sub->where('kode', $item->kode);
                                    @endphp
                                    <div class="form-group mb-4">
                                        <select class="form-control" name="{{ $name }}" required id="">
                                            <option value="" selected disabled>{{ $item->kriteria }}</option>
                                            @foreach ($sub_where as $list)
                                                <option value="{{ $list->nilai }}">
                                                    {{ $list->sub }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="float-end">
                            <button type="submit" class="btn btn-primary btnKelayakan hidden" style=""><i
                                    class="fas fa-check-circle"></i> Check Kelayakan</button>
                            <span class="spinner-border spinner-border-sm align-middle ms-2 hidden"></span></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.filektp').change(function() {
            $('.btnnext').removeClass('hidden');
        });

        function showsaw() {
            $('.viewSaw').removeClass('hidden');
            $('.btnnext').addClass('hidden');
            $('.btnKelayakan').removeClass('hidden');
        }

        $('#form-pengajuan').on('submit', function(e) {
            e.preventDefault();
            $('.btnKelayakan').addClass('hidden');
            $('.spinner-border').removeClass('hidden');
            $.ajax({
                url: "{{ route('checkKelayakan') }}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    console.log(response.data);
                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Internal Server Error, Please Try Again!',
                    });
                    $('.btnKelayakan').removeClass('hidden');
                    $('.spinner-border').addClass('hidden');
                }
            });
        });
    </script>
@endsection
