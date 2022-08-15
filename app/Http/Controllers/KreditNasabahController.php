<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Session;

class KreditNasabahController extends Controller
{
    public function index()
    {
        $kriteria = DB::table('master_kriteria')->get();
        $sub = DB::table('master_subkriteria')->orderBy('nilai', 'ASC')->get();
        return view('nasabah.pengajuan-kredit', compact('kriteria', 'sub'));
    }

    public function checkKelayakan(Request $request)
    {
        $crips = [
            $request->kedisiplinan_kredit,
            $request->penghasilan_bulanan,
            $request->jaminan_kredit,
            $request->status_tempat_tinggal,
            $request->status_pekerjaan,
        ];

        $normalisasi = [
            // 'nama_nasabah' => $request->nama_nasabah,
            'C1'       => $request->kedisiplinan_kredit,
            'C2'       => $request->penghasilan_bulanan,
            'C3'       => $request->jaminan_kredit,
            'C4'       => $request->status_tempat_tinggal,
            'C5'       => $request->status_pekerjaan,
        ];

        $sub_text = DB::table('master_subkriteria')->get();
        $kriteria = DB::table('master_kriteria')->get();
        // $bobot_value = $kriteria->toArray();
        $before = [
            'C1_text'       => $sub_text->where('kode', 'C1')->where('nilai', $request->kedisiplinan_kredit)->first(),
            'C2_text'       => $sub_text->where('kode', 'C2')->where('nilai', $request->penghasilan_bulanan)->first(),
            'C3_text'       => $sub_text->where('kode', 'C3')->where('nilai', $request->jaminan_kredit)->first(),
            'C4_text'       => $sub_text->where('kode', 'C4')->where('nilai', $request->status_tempat_tinggal)->first(),
            'C5_text'       => $sub_text->where('kode', 'C5')->where('nilai', $request->status_pekerjaan)->first(),
        ];
        $bobot_value = [
            'C1'       => $kriteria->where('kode', 'C1')->value('bobot'),
            'C2'       => $kriteria->where('kode', 'C2')->value('bobot'),
            'C3'       => $kriteria->where('kode', 'C3')->value('bobot'),
            'C4'       => $kriteria->where('kode', 'C4')->value('bobot'),
            'C5'       => $kriteria->where('kode', 'C5')->value('bobot'),
        ];
        # code...
        $max_crips = max($crips);

        foreach ($normalisasi as $key => $value) {
            $bobot = DB::table('master_kriteria')->where('kode', $key)->value('bobot');
            $hasil_bagi_crips[$key] = $value / $max_crips;
            $hasil[$key] = (int)$value / (int)$max_crips * (int)$bobot;
        }
        $keputusan = (int)array_sum($hasil);
        $texthasil = '';
        if ($keputusan <= 20) {
            $texthasil = 'Sangat Tidak Layak';
        } else if ($keputusan <= 40) {
            $texthasil = 'Tidak Layak';
        } else if ($keputusan <= 60) {
            $texthasil = 'Cukup';
        } else if ($keputusan <= 80) {
            $texthasil = 'Layak';
        } else if ($keputusan <= 100) {
            $texthasil = 'Sangat Layak';
        }
        return response()->json([
            'data' => [
                'keputusan' => $keputusan,
                'texthasil' => $texthasil,
                'normalisasi' => $normalisasi,
                'max_crips' => $max_crips,
                'before' => $before,
                'kriteria' => $kriteria,
                'bobot_value' => $bobot_value,
                'hasil_bagi_crips' => $hasil_bagi_crips,
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
