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
                                        <input type="text" id="nama_nasabah" name="nama_nasabah"
                                            class="form-control namaNasabahValue" aria-describedby="passwordHelpInline"
                                            required placeholder="Silahkan Di isi" autofocus="on">
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
                                            aria-describedby="passwordHelpInline" placeholder="Silahkan Di isi"
                                            autofocus="on">
                                        <small class="form-text text-muted">*.jpg .png .pdf</small>
                                    </div>
                                </div>
                                <div class="float-end">
                                    <button type="button" class="btn btn-primary btnnext hidden" onclick="showsaw()"
                                        style=""><i class="fas fa-check-circle"></i> Lanjutkan</button>
                                </div>
                            </div>
                            <div class="col-sm-12 viewSaw ">
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
                            <button type="submit" class="btn btn-primary btnKelayakan " style=""><i
                                    class="fas fa-check-circle"></i> Check Kelayakan</button>
                            <span class="spinner-border spinner-border-sm align-middle ms-2 hidden"></span></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-result" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center">FORM HASIL PERHITUNGAN SAW</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 appendResult">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0)" onclick="location.reload()" class="btn btn-secondary"> Batal</a>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
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
                    if (response.data.keputusan <= 20) {
                        var style = 'bg-danger';
                    } else if (response.data.keputusan <= 40) {
                        var style = 'bg-warning text-white';
                    } else if (response.data.keputusan <= 60) {
                        var style = 'bg-warning text-white';
                    } else if (response.data.keputusan <= 80) {
                        var style = 'bg-info text-white';
                    } else if (response.data.keputusan <= 100) {
                        var style = 'bg-info text-white';
                    }
                    $('#modal-result').modal('show');
                    $('.appendResult').html("");
                    $('.appendResult').append(`
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4 border-3">
                            <thead>
                                <tr class="border-0 text-dark text-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <th>C{{$i}}</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody class="">
                                <tr class="bodyKriteria  text-center"></tr>
                            </tbody>
                            <tfooter class="">
                                <tr class="footerBodyKriteria  text-center"></tr>
                            </tfooter>
                        </table>
                        <hr>
                        <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4 border-3">
                            <thead>
                                <tr class="border-0 text-center">
                                    <th>NAMA NASABAH</th>
                                    @for ($i = 1; $i <= 5; $i++)
                                    <th>C{{$i}}</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody class="text-center">
                              <tr class="beforeNormalisasi"></tr>
                            </tbody>
                        </table>
                        <hr>
                        <h4 class="text-dark text-center mt-4"><b>TABLE NORMALISASI</b></h4>
                            <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4 border-3">
                            <thead>
                                <tr class="border-0 text-center">
                                    <th>NAMA NASABAH</th>
                                    @for ($i = 1; $i <= 5; $i++)
                                    <th>C{{$i}}</th>
                                    @endfor
                                    <th>MAX CRIPS</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                              <tr class="afterNormalisasi"></tr>
                            </tbody>
                            <tfooter class="text-center">
                                <tr class="footerAfterNormalisasi text-center">
                                </tr>
                            </tfooter>
                        </table>
                        <hr>
                        <h4 class="text-dark text-center mt-4"><b>TABLE PERANGKINGAN(R x W) </b></h4>
                         <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4 border-3">
                            <thead>
                                <tr class="border-0" style="zoom: 150%;">
                                    <th class="${style}">PERHITUNGAN</th>
                                    <th class="${style}">HASIL SCORE</th>
                                    <th class="${style}">KEPUTUSAN</th>
                                </tr>
                            </thead>
                            <tbody class="">
                              <tr class="" style="align-items-center">
                                    <td style="zoom: 150%;" class="perangkingan  ${style}"></td>
                                    <td style="zoom: 150%;" class="${style}">${response.data.keputusan}</td>
                                    <td style="zoom: 150%;" class="${style}">${response.data.texthasil}</td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                    `);
                    $('.beforeNormalisasi').append(`
                        <td scope="row">` + $('.namaNasabahValue').val() + `</td>
                        `);
                    for (var index = 1; index <= 5; index++) {
                        $('.beforeNormalisasi').append(`
                            <td>${response.data.before['C'+index+'_text'].sub}</td>
                            `);
                    }
                    $.each(response.data.kriteria, function(index, value) {
                        $('.bodyKriteria').append(`
                            <td scope="row">` + value.kriteria + `</td>
                        `);
                        $('.footerBodyKriteria').append(`
                            <td scope="row">BOBOT : ` + value.bobot + `</td>
                        `);
                        
                    });

                    $('.afterNormalisasi').append(`
                        <td scope="row">` + $('.namaNasabahValue').val() + `</td>
                        `);
                    $.each(response.data.normalisasi, function(index, value) {
                        $('.afterNormalisasi').append(`
                        <td>${value}</td>
                        `);
                    });
                    $('.afterNormalisasi').append(`
                        <td scope="row">${response.data.max_crips}</td>
                    `);
                    $('.footerAfterNormalisasi').append(`
                        <td scope="row">-</td>
                    `);
                     for (var index = 1; index <= 5; index++) {
                        console.log(response.data.kriteria[index].bobot);
                        $('.footerAfterNormalisasi').append(`
                            <td>${response.data.normalisasi['C'+index]}/${response.data.max_crips} = ${response.data.hasil_bagi_crips['C'+index]}</td>
                            `);
                        $('.perangkingan').append(`
                            <td class="text-center">${response.data.hasil_bagi_crips['C'+index]} * ${response.data.bobot_value['C'+index]}, </td>
                        `);
                    }
                    // console.log(response.data);
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
        function submitKelayakan(){
            
        }
    </script>
@endsection
