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

        $before = [
            // 'nama_nasabah' => $request->nama_nasabah,
            'C1'       => $request->kedisiplinan_kredit,
            'C2'       => $request->penghasilan_bulanan,
            'C3'       => $request->jaminan_kredit,
            'C4'       => $request->status_tempat_tinggal,
            'C5'       => $request->status_pekerjaan,
        ];
        $max_crips = max($crips);
        // dd($max_crips);

        foreach ($before as $key => $value) {
            $bobot = DB::table('master_kriteria')->where('kode', $key)->value('bobot');
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
            $keputusan = 'Layak';
        } else if ($keputusan <= 100) {
            $texthasil = 'Sangat Layak';
        }
        return response()->json([
            'data' => [
                'keputusan' => $keputusan,
                'texthasil' => $texthasil,
                'kriteria' => $before,
                'max_crips' => $max_crips,
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
