<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Session;
use carbon\Carbon;
use Validator;

class SuperAdminController extends Controller
{
    public function masterUser()
    {
        $data = DB::table('users')->get();
        return view('super_admin.user', compact('data'));
    }

    public function postUser(Request $request)
    {
        $validasi = DB::table('users')->where('nik', $request->nik)->first();
        if ($validasi) {
            Session::flash('error', 'NIK ' . $request->nik . ' Sudah dimiliki oleh ' . $validasi->name);
            return back();
        } else {
            DB::table('users')->insert([
                'name' => $request->name,
                'nik' => $request->nik,
                'password' => bcrypt($request->password),
                'auth_group' => $request->auth_group,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->name,
            ]);
        }
        Session::flash('success', 'Data berhasil ditambahkan');
        return back();
    }

    public function showUser($id)
    {
        $data = DB::table('users')
            ->join('auth_group', 'users.auth_group', '=', 'auth_group.id_group')
            ->select('users.*', 'auth_group.name as group_name')
            ->where('users.id', $id)
            ->first();
        return response()->json([
            'data' => $data
        ]);
    }

    public function updateUser(Request $request)
    {
        DB::table('users')->where('id', $request->id_user)->update([
            'name' => $request->name,
            'nik' => $request->nik,
            'auth_group' => $request->auth_group,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => Auth::user()->name,
        ]);
        Session::flash('success', 'User berhasil diubah');
        return back();
    }

    public function resetPassword($id)
    {
        DB::table('users')->where('id', $id)->update([
            'password' => bcrypt('123456'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => Auth::user()->name,
        ]);
        Session::flash('success', 'Password berhasil diubah');
        return back();
    }

    public function aksesMenu()
    {
        $permission = DB::table('auth_permission')->get();
        $auth_group = DB::table('auth_group')->get();
        return view('super_admin.menu', compact('permission', 'auth_group'));
    }

    public function deleteUser($id)
    {
        DB::table('users')->where('id', $id)->delete();
        Session::flash('success', 'User berhasil dihapus');
        return back();
    }

    public function showMenu($id)
    {
        $auth_group = DB::table('auth_group')->where('id_group', $id)->first();
        $permission = DB::table('auth_permission')->get()->pluck('id_permission')->toArray();

        $list_exist = DB::table('auth_permission')
            ->join('auth_group_permission', 'auth_group_permission.permission_id', '=', 'auth_permission.id_permission')
            ->where('group_id', $auth_group->id)
            ->get();

        $list = DB::table('auth_permission')
            ->join('auth_group_permission', 'auth_group_permission.permission_id', '=', 'auth_permission.id_permission')
            ->where('group_id', $auth_group->id)
            ->get()->pluck('permission_id')->toArray();;

        $list = array_diff($permission, $list);
        $list_kosong = [];
        foreach ($list as $_val) {
            $list_kosong[] = DB::table('auth_permission')->where('id_permission', $_val)->get();
        }

        return response()->json([
            'status' => 1,
            'data' => [
                'auth_group' => $auth_group,
                'permission' => $permission,
                'list_exist' => $list_exist,
                'list_kosong' => $list_kosong,
            ],
        ]);
    }

    public function masterBobot()
    {
        $kriteria = DB::table('master_kriteria')->get();
        $sub      = DB::table('master_subkriteria')->get();
        return view('super_admin.master_bobot', compact('kriteria', 'sub'));
    }

    public function editKriteria($id)
    {
        $data = DB::table('master_kriteria')->where('id_kriteria', $id)->first();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function updateKriteria(Request $request)
    {
        DB::table('master_kriteria')->where('id_kriteria', $request->idKriteria)->update([
            'kriteria' => $request->kriteria,
            'bobot' => $request->bobot,
        ]);
        Session::flash('success', 'Data berhasil di Update');
        return back();
    }

    public function editSubKriteria($id)
    {
        $data = DB::table('master_subkriteria')->where('id_subkriteria', $id)->first();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function updatesubKriteria(Request $request)
    {
        DB::table('master_subkriteria')->where('id_subkriteria', $request->idsub)->update([
            'sub' => $request->value,
            'nilai' => $request->nilai,
        ]);
        Session::flash('success', 'Data berhasil di Update');
        return back();
    }
}
