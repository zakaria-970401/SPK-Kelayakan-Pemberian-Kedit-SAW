@extends('layouts.base')
@section('title', 'Pengajuan Kredit')
@section('content')
<style type="text/css">
   table {
  width: 100%;
}
table, th, td {
    border: 1px solid black;
}
</style>
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
                                        <input type="text" id="nama_nasabah" name=""
                                            class="form-control namaNasabahValue" aria-describedby="passwordHelpInline"
                                            required placeholder="Silahkan Di isi" autofocus="on">
                                    </div>
                                </div>
                                <div class="row g-3 mt-4 align-items-center">
                                    <div class="col-auto">
                                        <label for="" class="col-form-label">Jenis Kelamin</label>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-control jenisKelaminValue" name="" required id="">
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
                                        <select class="form-control usiaNasabahValue" name="" required id="">
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
                                        <select class="form-control statusPernikahanValue" name="" required id="">
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
                                        <label for="" class="col-form-label">Alamat Nasabah</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" id="alamatNasabahvalue" name="" class="form-control "
                                            aria-describedby="passwordHelpInline" required placeholder="Silahkan Di isi"
                                            >
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mt-4 filektp">
                                    <div class="col-auto">
                                        <label for="nama_ibu" class="col-form-label">Nama Ibu</label>
                                    </div>
                                     <div class="col-auto">
                                        <input type="text" id="nama_ibu" name=""
                                            class="form-control namaIbuValue" aria-describedby="passwordHelpInline"
                                            required placeholder="Silahkan Di isi">
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
                                        <select class="form-control kriteriavalue" name="{{ $name }}" required id="">
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

        <div class="modal fade" id="modal-result" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center">FORM HASIL PERHITUNGAN SAW</h5>
                    </div>
                    <form action="{{url('nasabah/postKredit')}}" method="post" id="postKredit" enctype="multipart/form-data">
                        @csrf
                        <div class="appendForm">

                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12 appendResult">

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:void(0)" onclick="location.reload()" class="btn btn-secondary"> Batal</a>
                            <button type="submit" class="btn btn-primary btnSave hidden"> <i class="fas fa-save"></i> Simpan</button>
                            {{-- <span class="spinner-border spinner-border-sm align-middle ms-2 hidden"></span></span> --}}
                        </div>
                    </form>
                    </div>
            </div>
        </div>

        <div class="modal fade" id="modal-nominal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="float-end">
                                    <h3>
                                        <span class="badge badge-info"><i class="fas fa-info-circle text-white"></i> Bunga : {{ $bunga }} %</span>
                                    </h3>
                                </div>
                                <div class="form-group mb-4">
                                  <input type="text" name="" id="" class="form-control nominalKreditValue" placeholder="NOMINAL KREDIT" aria-describedby="helpId">
                                </div>
                                <div class="form-group">
                                  <label for="">PARIODE KREDIT</label>
                                  <select class="form-control pariodeKreditValue" name="" id="">
                                    <option value="" selected disabled>RANGE WAKTU DALAM BULAN</option>
                                    @for ($i = 1; $i <= 100; $i++)
                                        <option value="{{$i}}"> {{$i}} BULAN</option>
                                    @endfor
                                  </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btnNominal"> <i class="fas fa-save"></i> OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('.namaIbuValue').change(function() {
            $('.btnnext').removeClass('hidden');
        }); 

        $(function() {
            $(".nominalKreditValue").keyup(function(e) {
                $(this).val(format($(this).val()));
            });
        });

        var format = function(num) {
        var str = num.toString().replace("", ""),
            parts = false,
            output = [],
            i = 1,
            formatted = null;
        if (str.indexOf(".") > 0) {
            parts = str.split(".");
            str = parts[0];
        }
        str = str.split("").reverse();
        for (var j = 0, len = str.length; j < len; j++) {
            if (str[j] != ",") {
                output.push(str[j]);
                if (i % 3 == 0 && j < (len - 1)) {
                    output.push(",");
                }
                i++;
            }
        }
        formatted = output.reverse().join("");
        return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
    };

        $('.btnNominal').on('click', function(){
            var nominal = $('.nominalKreditValue').val();
            var pariode = $('.pariodeKreditValue').val();
            console.log(pariode);
            if(nominal == '' || pariode == null){
                alert('Silahkan isi data dengan lengkap');
            }else{
                $.ajax({
                    url: "{{url('nasabah/checkNominal')}}/" + nominal,
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'nominal': nominal,
                    },
                    success: function(response){
                        if(response.status == 'format'){
                            Swal.fire({
                                title: 'Format Nominal Salah',
                                text: 'Format nominal salah, silahkan isi dengan format angka',
                                icon: 'error',
                                confirmButtonText: 'Oke'
                            });
                        }
                        else{
                            $('.btnSave').removeClass('hidden');
                            $('.appendForm').append(`
                                <input type="text"
                                    class="form-control" hidden name="nominal" value="${nominal}" id="" aria-describedby="helpId" placeholder="">
                                <input type="text"
                                    class="form-control" hidden name="pariode" value="${pariode}" id="" aria-describedby="helpId" placeholder="">
                            `)
                            $('#modal-result').modal('show');
                            $('#modal-nominal').modal('hide');
                        }
                    },
                });
            }
        });

        $('#postKredit').on('submit', function(e){
            $('.btnSave').addClass('hidden');
            e.preventDefault();
            $('#modal-result').modal('hide');
            var pariode = $('.pariodeKreditValue').val();
            if(pariode == null){
                $('#modal-nominal').modal('show');
            }else{
                $('#postKredit').submit();
            }
        });

        function showsaw() {
            $('.viewSaw').removeClass('hidden');
            $('.btnnext').addClass('hidden');
            $('.btnKelayakan').removeClass('hidden');
            $('.appendForm').html("")
            $('.appendForm').append(`
                  <input type="text"
                    class="form-control" hidden name="nama_nasabah" value="${$('.namaNasabahValue').val()}" id="" aria-describedby="helpId" placeholder="">
                  <input type="text"
                    class="form-control" hidden name="jenis_kelamin" value="${$('.jenisKelaminValue').val()}" id="" aria-describedby="helpId" placeholder="">
                  <input type="text"
                    class="form-control" hidden name="usia" value="${$('.usiaNasabahValue').val()}" id="" aria-describedby="helpId" placeholder="">
                  <input type="text"
                    class="form-control" hidden name="status_pernikahan" value="${$('.statusPernikahanValue').val()}" id="" aria-describedby="helpId" placeholder="">
                  <input type="text"
                    class="form-control" hidden name="alamat_nasabah" value="${$('#alamatNasabahValue').val()}" id="" aria-describedby="helpId" placeholder="">
                  <input type="text"
                    class="form-control" hidden name="nama_ibu" value="${$('.namaIbuValue').val()}" id="" aria-describedby="helpId" placeholder="">
            `)
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
                        $('.btnSave').addClass('hidden');
                    } else if (response.data.keputusan <= 40) {
                        var style = 'bg-warning text-white';
                        $('.btnSave').addClass('hidden');
                    } else if (response.data.keputusan <= 60) {
                        var style = 'bg-warning text-white';
                        $('.btnSave').removeClass('hidden');
                    } else if (response.data.keputusan <= 80) {
                        var style = 'bg-info text-white';
                        $('.btnSave').removeClass('hidden');
                    } else if (response.data.keputusan <= 100) {
                        var style = 'bg-info text-white';
                        $('.btnSave').removeClass('hidden');
                    }
                    var values = [];
                    $(".kriteriavalue").each(function(i, sel){
                        var selectedVal = $(sel).val();
                        values.push(selectedVal);
                    });
                    $('.appendForm').append(`
                       <input type="text"
                        class="form-control" hidden name="value" value="${values}" id="" aria-describedby="helpId" placeholder="">`
                    );
                    $('#modal-result').modal('show');
                    $('.appendResult').html("");
                    $('.appendResult').append(`
                        <div class="table-responsive">
                            <table id="table">
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
                            <table id="table">
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
                                <table id="table">
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
                            <table id="table">
                                <thead>
                                    <tr class="border-0" style="zoom: 150%;">
                                        <th class="${style}">PERHITUNGAN</th>
                                        <th class="${style}">HASIL SCORE</th>
                                        <th class="${style}">KEPUTUSAN</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                <tr class="">
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
                    for (var index = 0; index < 5; index++) {
                        var i = index + 1;
                        $('.beforeNormalisasi').append(`
                            <td>${response.data.before['C'+i+'_text'].sub}</td>
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
                     for (var index = 0; index < 5; index++) {
                        var i = index + 1;
                        $('.footerAfterNormalisasi').append(`
                            <td>${response.data.normalisasi['C'+i]}/${response.data.max_crips} = ${response.data.hasil_bagi_crips['C'+i]}</td>
                            `);
                        $('.perangkingan').append(`
                            <td class="text-center">${response.data.hasil_bagi_crips['C'+i]} * ${response.data.bobot_value['C'+i]}, </td>
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
