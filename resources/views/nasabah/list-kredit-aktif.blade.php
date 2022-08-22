@extends('layouts.base')
@section('title', 'List Kredit Aktif')
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
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Usia</th>
                                    <th>Jangka Kredit</th>
                                    <th>Nominal Kredit</th>
                                    <th>Nominal Pembayaran</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $list)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="#" onclick="detail('{{ $list->id }}')"
                                                class="btn btn-primary btn-sm"><i class="fas fa-eye"></i>Trace
                                            </a>
                                            <a href="{{ url('nasabah/printout/' . $list->id_nasabah) }}"
                                                class="btn btn-dark btn-sm"><i class="fas fa-print"></i>Print
                                            </a>
                                        </td>
                                        <td>{{ $list->nama }}</td>
                                        <td>{{ $list->jenis_kelamin }}</td>
                                        <td>{{ $list->usia }} TAHUN</td>
                                        <td>{{ $list->jangka_kredit }} BULAN</td>
                                        <td scope="row">
                                            Rp.
                                            {{ number_format($list->nominal_kredit, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            Rp.
                                            {{ number_format($list->nominal_kredit / $list->jangka_kredit, 0, ',', '.') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($list->jatuh_tempo)->format('d M Y') }}</td>
                                        <td><span class="badge badge-info"> AKTIF</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detail-pembyaran" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row appendBody">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function formatRupiah(angka, prefix) {
            console.log(angka);
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        function formatTanggalIndonesia(tanggal) {
            var formated;
            const today = new Date(tanggal);
            const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                'Oktober', 'November', 'Desember'
            ];
            formated = kasihNol(today.getDate()) + ' ' + bulan[today.getMonth()] + ' ' + kasihNol(today.getFullYear());

            if (tanggal == null || tanggal == '') {
                formated = '';
            }

            return formated;
        }

        function detail(id) {
            $.ajax({
                url: "{{ url('/nasabah/tracePembayaran') }}/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(response) {
                    $('#detail-pembyaran').modal('show');
                    $('.appendBody').html("");
                    $('.appendBody').append(`
                        <table id="table" width="100%"
                            cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>Nama</th>
                                    <th>Pembayaran Ke</th>
                                    <th>Jangka Kredit</th>
                                    <th>Nominal Kredit</th>
                                    <th>Nominal Pembayaran</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Waktu Pembayaran</th>
                                    <th>Petugas</th>
                                    <th>Foto Bukti</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="appendTable">
                            </tbody>
                        </table>
                    `);

                    $.each(response.data, function(index, value) {
                        var bagi = parseInt(value.nominal_kredit / value.jangka_kredit)
                        var pembayaran = String(bagi);
                        if (value.status == 1) {
                            var status = '<span class="badge badge-warning"> BELUM DI BAYAR</span>';
                        } else {
                            var status = '<span class="badge badge-success"> SUDAH DI BAYAR</span>';
                        }
                        // console.log(pembayaran);
                        $('#appendTable').append(`
                            <tr class="text-center">
                                <td>${value.nama}</td>
                                <td>${value.pembayaran_ke}</td>
                                <td>${value.jangka_kredit}</td>
                                <td>Rp. ${formatRupiah(value.nominal_kredit)}</td>
                                <td>Rp. ${formatRupiah(pembayaran)}</td>
                                <td>${formatTanggalIndonesia(value.jatuh_tempo)}</td>
                                <td>${formatTanggalIndonesia(value.updated_at)}</td>
                                <td>${value.updated_by}</td>
                                <td>
                                    <img class="appendImage" src="{{ asset('file-bukti-pembayaran/${value.file_bukti}') }}" alt="${value.file_bukti}" width="100px">
                                </td>
                                <td>${status}</td>
                            </tr>
                        `);
                    });
                }
            });
        }
    </script>
@endsection
