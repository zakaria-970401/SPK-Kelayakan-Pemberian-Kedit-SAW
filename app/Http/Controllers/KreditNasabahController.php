<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Session;
use carbon\Carbon;

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

    public function postKredit(Request $request)
    {
        // dd($request->all());
        $nominal = explode(',', $request->nominal);
        $nominal = implode('', $nominal);
        $nominal = (int) $nominal;

        $kriteria_nilai = explode(',', $request->value);

        //insert data
        DB::table('master_nasabah')->insert([
            'nama' => $request->nama_nasabah,
            'jenis_kelamin' => $request->jenis_kelamin,
            'usia' => $request->usia,
            'status_pernikahan' => $request->status_pernikahan,
            'alamat_nasabah' => $request->alamat_nasabah,
            'nama_ibu' => $request->nama_ibu,
            'c1' => $kriteria_nilai[0],
            'c2' => $kriteria_nilai[1],
            'c3' => $kriteria_nilai[2],
            'c4' => $kriteria_nilai[3],
            'c5' => $kriteria_nilai[4],
        ]);

        $id_nasabah = DB::table('master_nasabah')->orderBy('id', 'DESC')->value('id');

        $jatuh_tempo = [];
        for ($i = 1; $i <= (int)$request->pariode; $i++) {
            $jatuh_tempo[] = Carbon::now()->addMonths($i);
        }
        foreach ($jatuh_tempo as $key => $value) {
            DB::table('transaksi_nasabah')->insert([
                'id_nasabah' => $id_nasabah == null ? 1 : $id_nasabah,
                'jangka_kredit' => (int)$request->pariode,
                'nominal_kredit' => $nominal,
                'jatuh_tempo' => $value,
                'pembayaran_ke' => $key + 1,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->name,
            ]);
        }


        Session::flash('success', 'Data berhasil Disimpan, Silahkan Print Out Surat Keterangan Kredit');
        return redirect('nasabah/printout/' . $id_nasabah);
    }

    public function checkNominal($nominal)
    {
        $nominal = explode(',', $nominal);
        $nominal = implode('', $nominal);
        $nominal = (int) $nominal;
        if ($nominal == 0) {
            return response()->json([
                'status' => 'format',
            ]);
        } else {
            return response()->json([
                'status' => 'ok',
            ]);
        }
    }

    public function printout($id_nasabah)
    {
        $transaksi = DB::table('transaksi_nasabah')->where('id_nasabah', $id_nasabah)->get();
        $nasabah = DB::table('master_nasabah')->where('id', $id_nasabah)->first();

        return view('nasabah.printout', compact('transaksi', 'nasabah'));
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
