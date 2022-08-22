<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission = DB::table('auth_permission')->where('status', 1)->get();

        $auth_group = DB::table('auth_group')->where('status', 1)->get();

        return view('permission.index', compact('permission', 'auth_group'));
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
        DB::table('auth_permission')->insert([
            'name' => $request->permission,
            'created_at' => date('Y-m-d H:i:s'),
            'codename' => $request->permission,
        ]);
        Session::flash('success', 'Data Berhasil Di Tambah');
        return back();
    }

    public function add_group(Request $request)
    {
        DB::table('auth_group')->insert([
            'name' => $request->auth_group,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        Session::flash('success', 'Data Berhasil Di Tambah');
        return back();
    }

    public function add_group_permission(Request $request)
    {
        //delete
        DB::table('auth_group_permission')->where('group_id', $request->auth_group_id)->delete();
        $auth_group  =  DB::table('auth_group')->select('id')->where('id', $request->auth_group_id)->first();

        foreach ($request->list_menu as $list) {
            $auth_permission  =  DB::table('auth_permission')->select('id')->where('name', $list)->first();
            DB::table('auth_group_permission')->insert([
                'group_id' => $auth_group->id,
                'permission_id' => $auth_permission->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        Session::flash('success', 'Permission Berhasil Di Update');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function lihat_permission($id)
    {
        $auth_group = DB::table('auth_group')->where('id', $id)->first();
        $permission = DB::table('auth_permission')->get()->pluck('id')->toArray();

        $list_exist = DB::table('auth_permission')
            ->join('auth_group_permission', 'auth_group_permission.permission_id', '=', 'auth_permission.id')
            ->where('group_id', $auth_group->id)
            ->get();

        $list = DB::table('auth_permission')
            ->join('auth_group_permission', 'auth_group_permission.permission_id', '=', 'auth_permission.id')
            ->where('group_id', $auth_group->id)
            ->get()->pluck('permission_id')->toArray();;

        $list = array_diff($permission, $list);
        $list_kosong = [];
        foreach ($list as $_val) {
            $list_kosong[] = DB::table('auth_permission')->where('id', $_val)->get();
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
    public function hapus_permission($kategori, $id)
    {
        if ($kategori == 'permission') {
            DB::table('auth_permission')->where('id', $id)->delete();
            DB::table('auth_group_permission')->where('permission_id', $id)->delete();

            Session::flash('success', 'Permission Berhasil Di Hapus');
            return back();
        } else {
            DB::table('auth_group')->where('id', $id)->delete();
            DB::table('auth_group_permission')->where('group_id', $id)->delete();

            Session::flash('success', 'Permission Berhasil Di Hapus');
            return back();
        }
    }

    public function update_permission($kategori, $nama, $id)
    {
        if ($kategori == 'permission') {
            DB::table('auth_permission')->where('id', $id)->update(
                [
                    'name' => $nama
                ]
            );

            Session::flash('success', 'Permission Berhasil Di Update');
            return back();
        } else {
            DB::table('auth_group')->where('id', $id)->update(
                [
                    'name' => $nama
                ]
            );

            Session::flash('success', 'Permission Berhasil Di Update');
            return back();
        }
    }
}
