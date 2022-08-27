@extends('layouts.base')
@section('title', 'Hasil Simulasi Kelayakan Kredit')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="table">
                                <thead>
                                    <tr class="text-center">
                                        <th colspan="6"><b>DATA AWAL </b></th>
                                        <th colspan="1"><b>MAX CRIPS : {{ $max_crips }}</b></th>
                                    </tr>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama</th>
                                        @foreach ($kriteria as $item)
                                            <th>{{ $item->kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nama_nasabah as $key => $item)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item }}</td>
                                            <td>{{ $sub_text->where('kode', 'C1')->where('nilai', $normalisasi['C1'][$key])->first()->sub }}
                                            </td>
                                            <td>{{ $sub_text->where('kode', 'C2')->where('nilai', $normalisasi['C2'][$key])->first()->sub }}
                                            <td>{{ $sub_text->where('kode', 'C3')->where('nilai', $normalisasi['C3'][$key])->first()->sub }}
                                            <td>{{ $sub_text->where('kode', 'C4')->where('nilai', $normalisasi['C4'][$key])->first()->sub }}
                                            <td>{{ $sub_text->where('kode', 'C5')->where('nilai', $normalisasi['C5'][$key])->first()->sub }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="table">
                                <thead>
                                    <tr class="text-center">
                                        <th colspan="6"><b>HASIL KONVERSI </b></th>
                                        <th colspan="1"><b>MAX CRIPS : {{ $max_crips }}</b></th>
                                    </tr>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama</th>
                                        @foreach ($kriteria as $item)
                                            <th>{{ $item->kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nama_nasabah as $key => $item)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item }}</td>
                                            <td>{{ $normalisasi['C1'][$key] }}</td>
                                            <td>{{ $normalisasi['C2'][$key] }}</td>
                                            <td>{{ $normalisasi['C3'][$key] }}</td>
                                            <td>{{ $normalisasi['C4'][$key] }}</td>
                                            <td>{{ $normalisasi['C5'][$key] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="table">
                                <thead>
                                    <tr class="text-center">
                                        <th colspan="6"><b>HASIL NORMALISASI </b></th>
                                        <th colspan="1"><b>MAX CRIPS : {{ $max_crips }}</b></th>
                                    </tr>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama</th>
                                        @foreach ($kriteria as $item)
                                            <th>{{ $item->kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nama_nasabah as $key => $item)
                                        @php
                                            $hasil_bagi[] = [
                                                'C1' => $normalisasi['C1'][$key] / $max_crips,
                                                'C2' => $normalisasi['C2'][$key] / $max_crips,
                                                'C3' => $normalisasi['C3'][$key] / $max_crips,
                                                'C4' => $normalisasi['C4'][$key] / $max_crips,
                                                'C5' => $normalisasi['C5'][$key] / $max_crips,
                                            ];
                                        @endphp
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item }}</td>
                                            <td>{{ $normalisasi['C1'][$key] }} / {{ $max_crips }} =
                                                {{ $normalisasi['C1'][$key] / $max_crips }}
                                            </td>
                                            <td>{{ $normalisasi['C2'][$key] }} / {{ $max_crips }} =
                                                {{ $normalisasi['C2'][$key] / $max_crips }}
                                            </td>
                                            <td>{{ $normalisasi['C3'][$key] }} / {{ $max_crips }} =
                                                {{ $normalisasi['C3'][$key] / $max_crips }}
                                            </td>
                                            <td>{{ $normalisasi['C4'][$key] }} / {{ $max_crips }} =
                                                {{ $normalisasi['C4'][$key] / $max_crips }}
                                            </td>
                                            <td>{{ $normalisasi['C5'][$key] }} / {{ $max_crips }} =
                                                {{ $normalisasi['C5'][$key] / $max_crips }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            <table id="table">
                                <thead>
                                    <tr class="text-center">
                                        <th colspan="6"><b>HASIL NORMALISASI </b></th>
                                        <th colspan="1"><b>MAX CRIPS : {{ $max_crips }}</b></th>
                                    </tr>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama</th>
                                        @foreach ($kriteria as $item)
                                            <th>{{ $item->kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nama_nasabah as $key => $item)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item }}</td>
                                            <td>
                                                {{ $normalisasi['C1'][$key] / $max_crips }}
                                            </td>
                                            <td>
                                                {{ $normalisasi['C2'][$key] / $max_crips }}
                                            </td>
                                            <td>
                                                {{ $normalisasi['C3'][$key] / $max_crips }}
                                            </td>
                                            <td>
                                                {{ $normalisasi['C4'][$key] / $max_crips }}
                                            </td>
                                            <td>
                                                {{ $normalisasi['C5'][$key] / $max_crips }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <table id="table">
                                <thead>
                                    <tr class="text-center">
                                        <th colspan="6"><b>TABLE BOBOT </b></th>
                                    </tr>
                                    <tr class="text-center">
                                        <th>KODE</th>
                                        <th>KRITERIA</th>
                                        <th>BOBOT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kriteria as $item)
                                        <tr class="text-center">
                                            <td>{{ $item->kode }}</td>
                                            <td>{{ $item->kriteria }}</td>
                                            <td>{{ $item->bobot }} % </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-9">
                            <div class="table-responsive">
                                <table id="table">
                                    <thead>
                                        <tr class="text-center">
                                            <th colspan="9"><b>HASIL PERHITUNGAN </b></th>
                                        </tr>
                                        <tr class="text-center">
                                            <th>Nama</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->kriteria }}</th>
                                            @endforeach
                                            <th class="bg-info text-white">HASIL</th>
                                            <th class="bg-info text-white">KETERANGAN</th>
                                            <th class="bg-info text-white">RANGKING</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($nama_nasabah as $key => $item)
                                            <tr class="text-center">
                                                <td>{{ $item }}</td>
                                                @php
                                                    $hasil = 0;
                                                @endphp
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @php
                                                        $hasil += $hasil_bagi[$key]['C' . $i] * $kriteria->where('kode', 'C' . $i)->first()->bobot;
                                                        $texthasil = '';
                                                        if ($hasil <= 20) {
                                                            $texthasil = 'Sangat Tidak Layak';
                                                        } elseif ($hasil <= 40) {
                                                            $texthasil = 'Tidak Layak';
                                                        } elseif ($hasil <= 60) {
                                                            $texthasil = 'Cukup';
                                                        } elseif ($hasil <= 80) {
                                                            $texthasil = 'Layak';
                                                        } elseif ($hasil <= 100) {
                                                            $texthasil = 'Sangat Layak';
                                                        }
                                                    @endphp
                                                    <td>
                                                        {{ $hasil_bagi[$key]['C' . $i] }} *
                                                        {{ $kriteria->where('kode', 'C' . $i)->first()->bobot }} =
                                                        <b>
                                                            {{ $hasil_bagi[$key]['C' . $i] * $kriteria->where('kode', 'C' . $i)->first()->bobot }}
                                                        </b>
                                                    </td>
                                                @endfor
                                                <td class="bg-info text-white">{{ $hasil }}</td>
                                                <td class="bg-info text-white">{{ $texthasil }}</td>
                                                <td class="bg-info text-white">
                                                    {{ $rank->where('value', $hasil)->first()['rank'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript"></script>
@endsection
