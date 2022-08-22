<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        @media print {

            .no-print,
            .no-print * {
                display: none !important;
            }
        }
    </style>

    <title>Print Out</title>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="float-left">
                                <img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}"
                                    style="width: 310px;" />
                            </div>
                            <div class="col-sm-7">
                                <h1 class="text-bold text-center">PT. BPR ANTAR GUNA</h1>
                                <h5 class="text-bold text-center">Jl. Setiadarma I No. 34 Tambun Selatan – kab. Bekasi
                                    Jawa Barat Telp. (021) 8803724/8803734</h5>
                            </div>
                            <div class="col-sm-1">
                                <a href="#" class="btn btn-lg btn-dark no-print" onclick="window.print()">
                                    Print</a>
                                <p>
                                    <a href="{{ url('/home') }}" class="btn btn-danger btn-lg mt-4 no-print"> BACK</a>
                                </p>
                            </div>
                        </div>
                        <hr style="border: 2px solid #000;" class="mb-4">
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6 text-center"><u><b>
                                        <h5>SURAT KETERANGAN PERMOHONAN KREDIT</h5>
                                    </b></u></div>
                            <div class="col-sm-2"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <p>Saya yang bertanda tangan di bawah ini:</p>
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-4">
                                <p class="mt-2"><b>NAMA : {{ $nasabah->nama }}</b></p>
                                <p class="mt-4"><b>JENIS KELAMIN : {{ $nasabah->jenis_kelamin }}</b></p>
                                <p class="mt-4"><b>USIA : {{ $nasabah->usia }} TAHUN</b></p>
                                <p class="mt-4"><b>STATUS PERNIKAHAN : {{ $nasabah->status_pernikahan }}</b></p>
                                <p class="mt-4"><b>ALAMAT : {{ $nasabah->alamat_nasabah }}</b></p>
                                <p class="mt-4"><b>NAMA IBU : {{ $nasabah->nama_ibu }}</b></p>
                            </div>
                            <div class="col-sm-12">
                                <br>
                                <p>Dengan ini saya menyatakan bahwa data di atas merupakan data sah untuk persyaratan
                                    mengajukan permohonan kredit dalam besaran nominal <b>Rp.
                                        {{ number_format($transaksi[0]->nominal_kredit, 0, ',', '.') }}</b> dengan
                                    jangka
                                    waktu <b>{{ $transaksi[0]->jangka_kredit }} Bulan</b>, dan data di atas bisa
                                    di
                                    pertanggung
                                    jawabkan sebagaimana mestinya. Adapun rincian pembayaran tersebut:
                                </p>
                                <table id="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th>NO</th>
                                            <th>PEMBAYARAN KE</th>
                                            <th>NOMINAL</th>
                                            <th>JATUH TEMPO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaksi as $item)
                                            <tr class="text-center">
                                                <td scope="row">{{ $loop->iteration }}</td>
                                                <td scope="row">{{ $item->pembayaran_ke }}</td>
                                                <td scope="row">
                                                    Rp.
                                                    {{ number_format($item->nominal_kredit / count($transaksi), 0, ',', '.') }}
                                                </td>
                                                <td scope="row">
                                                    {{ \Carbon\Carbon::parse($item->jatuh_tempo)->format('d M Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <br>
                                <br>
                                <table id="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th>NAMA PETUGAS</th>
                                        </tr>
                                        <tr>
                                            <th><br><br></th>
                                        </tr>
                                        <tr class="text-center">
                                            <th>{{ Auth::user()->name }}</th>
                                        </tr>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <table id="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Bekasi, {{ date('d M Y') }}</th>
                                        </tr>
                                        <tr class="text-center">
                                            <th>PEMOHON</th>
                                        </tr>
                                        <tr>
                                            <th><br><br></th>
                                        </tr>
                                        <tr class="text-center">
                                            <th>{{ $nasabah->nama }}</th>
                                        </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
