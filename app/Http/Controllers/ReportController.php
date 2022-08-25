<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Session;
use carbon\Carbon;
use Validator;

class ReportController extends Controller
{
    public function index()
    {
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $data = DB::table('transaksi_nasabah')
            // ->join('master_nasabah', 'master_nasabah.id', '=', 'transaksi_nasabah.id_nasabah')
            ->where('pariode_tahun', (int)date('Y'))
            ->groupBy('id_nasabah')
            ->get();
        foreach ($bulan as $key => $value) {
            $data_series[] = $data->where('pariode_bulan', (int)$key)->sum('nominal_kredit');
        }

        $charts_years = [];
        $categories = [];
        $years = DB::table('transaksi_nasabah')
            ->where('pariode_tahun', (int)date('Y'))
            ->groupBy('id_nasabah')
            ->get();
        // dd($years->sum('nominal_kredit'), $years);

        foreach ($years->groupBy('pariode_tahun') as $key => $value) {
            $charts_years[] = [
                'name' => $key,
                'data' => [$years->sum('nominal_kredit')],
            ];
            $categories[] = $key;
        }
        $categories = json_encode($categories);

        return view('report', compact('data_series', 'charts_years', 'categories'));
    }
}
