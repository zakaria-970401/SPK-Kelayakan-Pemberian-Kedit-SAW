<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Session;
use carbon\Carbon;
use Validator;

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
        // dd($bobot_value);
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

    public function listJatuhTempo()
    {
        $list  = DB::table('transaksi_nasabah')->get();
        $data = [];
        foreach ($list as $list) {
            $jatuh_tempo   = Carbon::parse($list->jatuh_tempo);
            $jangka_kredit = $list->jangka_kredit;
            $jatuh_tempo = $jatuh_tempo->diffInDays(date('Y-m-d'));
            if ($jatuh_tempo <= 4) {
                $data[]  = DB::table('transaksi_nasabah')
                    ->select(
                        'transaksi_nasabah.*',
                        'master_nasabah.nama',
                    )
                    ->join('master_nasabah', 'master_nasabah.id', '=', 'transaksi_nasabah.id_nasabah')
                    ->where('jatuh_tempo', date('Y-m-d', strtotime('+' . $jatuh_tempo . ' days')))
                    ->where('transaksi_nasabah.status', 1)
                    ->get()->toArray();
            }
        }
        // dd($jangka_kredit);
        return view('nasabah.list-jatuh-tempo', compact('data', 'jangka_kredit'));
    }

    public function postPembayaran(Request $request)
    {
        if ($request->has('file_bukti')) {
            $validator = Validator::make($request->all(), [
                'file_bukti' => 'mimes:jpeg,png,jpg',
            ]);

            if ($validator->fails()) {
                Session::flash('error', 'Foto tidak sesuai format');
                return back();
            } else {
                $file_bukti = $request->file('file_bukti');
                $file_bukti_name = $request->id . '-' . uniqid() . "." . $file_bukti->getClientOriginalExtension();
                $file_bukti->move(public_path('/file-bukti-pembayaran'), $file_bukti_name);

                DB::table('transaksi_nasabah')->where('id', $request->id)->update([
                    'status' => 0,
                    'file_bukti' => $file_bukti_name,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => Auth::user()->name,
                ]);
            }
            Session::flash('success', 'Data Berhasil Di Simpan..');
            return back();
        }
    }

    public function listKreditAktif()
    {
        $data = DB::table('transaksi_nasabah')
            ->select(
                'transaksi_nasabah.*',
                'master_nasabah.nama',
                'master_nasabah.jenis_kelamin',
                'master_nasabah.usia',
                'master_nasabah.status_pernikahan',
                'master_nasabah.alamat_nasabah',
                'master_nasabah.nama_ibu',
            )
            ->join('master_nasabah', 'master_nasabah.id', '=', 'transaksi_nasabah.id_nasabah')
            ->where('transaksi_nasabah.status', 1)
            ->groupBy('transaksi_nasabah.id_nasabah')
            ->get();
        // dd($data);
        return view('nasabah.list-kredit-aktif', compact('data'));
    }

    public function tracePembayaran($id)
    {
        $id_nasabah = DB::table('transaksi_nasabah')->where('id', $id)->first()->id_nasabah;
        $data = DB::table('transaksi_nasabah')
            ->select(
                'transaksi_nasabah.*',
                'master_nasabah.nama',
            )
            ->join('master_nasabah', 'master_nasabah.id', '=', 'transaksi_nasabah.id_nasabah')
            ->where('transaksi_nasabah.id_nasabah', $id_nasabah)
            ->get();
        // dd($data);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function simulasiKelayakan()
    {
        $kriteria = DB::table('master_kriteria')->get();
        $sub = DB::table('master_subkriteria')->orderBy('nilai', 'ASC')->get();
        return view('nasabah.simulasi-kelayakan-kredit', compact('kriteria', 'sub'));
    }

    public function resultSimulasiKelayakan(Request $request)
    {
        // dd($request->all());
        $sub_text = DB::table('master_subkriteria')->get();
        $kriteria = DB::table('master_kriteria')->get();
        for ($i = 0; $i < count($request->nama_nasabah); $i++) {
            $crips[] = [
                $request->kedisiplinan_kredit[$i],
                $request->penghasilan_bulanan[$i],
                $request->jaminan_kredit[$i],
                $request->status_tempat_tinggal[$i],
                $request->status_pekerjaan[$i],
            ];

            $normalisasi_before[] = [
                'C1'       => $request->kedisiplinan_kredit[$i],
                'C2'       => $request->penghasilan_bulanan[$i],
                'C3'       => $request->jaminan_kredit[$i],
                'C4'       => $request->status_tempat_tinggal[$i],
                'C5'       => $request->status_pekerjaan[$i],
            ];
        }

        foreach ($normalisasi_before as $key => $value) {
            foreach ($value as $_key => $_value) {
                $normalisasi[$_key][] = $_value;
            }
        }
        $normalisasi = collect($normalisasi);
        $max_crips = collect([]);
        $nama_nasabah = collect([]);
        $sub_text_after = collect([]);

        foreach ($crips as $key => $value) {
            $max_crips = $max_crips->merge($value);
        }
        $max_crips = max($max_crips->toArray());

        foreach ($request->nama_nasabah as $key => $value) {
            $nama_nasabah = $nama_nasabah->merge($value);
            for ($i = 1; $i <= 5; $i++) {
                $hasil[] = $normalisasi['C' . $i][$key] * $kriteria->where('kode', 'C' . $i)->first()->bobot;
            }
            $hasil_hitungan[] = array_sum($hasil);
        }

        $rankings = array_unique($hasil_hitungan);
        rsort($rankings);
        $rank = array();
        foreach ($rankings as $value) {
            $rankedValue = array();
            $rankedValue['value'] = $value;
            $rankedValue['rank'] = array_search($value, $rankings) + 1;
            $rank[] = $rankedValue;
        }
        $rank = collect($rank);
        // dd($rank);
        return view('nasabah.result-simulasi-kelayakan-kredit', compact('kriteria', 'sub_text', 'nama_nasabah', 'normalisasi', 'max_crips', 'rank'));
    }

    public function permintaanHapusData()
    {
        $data =  DB::table('transaksi_nasabah')
            ->select(
                'transaksi_nasabah.nominal_kredit',
                'transaksi_nasabah.jangka_kredit',
                'master_nasabah.nama',
                'master_nasabah.id',
            )
            ->join('master_nasabah', 'transaksi_nasabah.id_nasabah', '=', 'master_nasabah.id')
            ->where('created_by', Auth::user()->name)
            ->whereDate('created_at', Carbon::today())
            ->groupBy('id_nasabah')
            ->where('master_nasabah.status', 1)
            ->get();
        return view('nasabah.permintaan-hapus-data', compact('data'));
    }

    public function sendPermintaanHapus($id)
    {
        //update status
        DB::table('transaksi_nasabah')->where('id_nasabah', $id)->update(['status' => 99]);
        DB::table('master_nasabah')->where('id', $id)->update(['status' => 99, 'deleted_by' => Auth::user()->name]);

        Session::flash('success', 'Permintaan Hapus Data Berhasil Dikirim');
        return back();
    }

    public function approvePermintaanHapus($id)
    {
        //update status
        DB::table('transaksi_nasabah')->where('id_nasabah', $id)->delete();
        DB::table('master_nasabah')->where('id', $id)->delete();
        Session::flash('success', 'Permintaan Hapus Data Berhasil Disetujui');
        return back();
    }
}
