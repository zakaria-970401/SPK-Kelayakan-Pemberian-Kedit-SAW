@extends('layouts.base')

@section('title', 'Akses Menu User')
@section('content')
    <style type="text/css">
        .hide {
            display: none;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-5 mb-xl-8">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12">
                            {{-- <h5>LIST NAMA MENU</h5> --}}
                            <a href="#addpermission" data-bs-toggle="modal" class="btn btn-md btn-dark mt-4"
                                style="border-radius: 10px;"><i class="fas fa-plus mr-1"></i> Tambah
                                Menu</a>
                        </div>
                    </div>
                </div>
                <div class="card-body mb-4">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="table-responsive">
                                <table id="table">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No.</th>
                                            <th>Nama Permission</th>
                                            {{-- <th>Tools</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permission as $list)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $list->name }}</td>
                                                {{-- <td> --}}
                                                {{-- <a href="javascript:void(0)"
                                                                            onclick="EditPermission('permission', '{{ $list->name }}' , '{{ $list->id }}')"
                                                                            class="btn btn-sm btn-warning"
                                                                            style="border-radius: 10px;"><i
                                                                                class="fas fa-edit mr-1"></i> Edit</a> --}}
                                                {{-- <a href="javascript:void(0)"
                                                        onclick="HapusPermission('permission','{{ $list->id }}')"
                                                        class="btn btn-sm btn-danger" style="border-radius: 10px;"><i
                                                            class="fas fa-trash-alt mr-1"></i> Hapus</a> --}}
                                                {{-- </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="table-responsive">
                                <h5>LIST AUTH GROUP PERMISSION</h5>
                                <table id="table">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No.</th>
                                            <th>Nama Auth Group</th>
                                            {{-- <th>Tools</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($auth_group as $list)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="javascript:void(0)"
                                                        onclick="AddAuthGroupPermission('{{ $list->id }}')">
                                                        {{ $list->name }}
                                                    </a>
                                                </td>
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

    <div class="modal fade" id="addpermission" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">FORM TAMBAH PERMISSION MENU</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('permission.add') }}" method="post" id="permission_add">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Nama Permission</label>
                                    <input type="text" class="form-control" name="permission" id=""
                                        aria-describedby="helpId" placeholder="Masukan Nama Permission" required>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success BtnSave"><i class="fas fa-save"></i>
                        Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_group" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">FORM TAMBAH AUTH GROUP PERMISSION</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('permission.add_group') }}" method="post" id="auth_group">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Nama Auth Group</label>
                                    <input type="text" class="form-control" name="auth_group" id=""
                                        aria-describedby="helpId" placeholder="Masukan Nama Auth Group" required>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success BtnSaveGroup"><i class="fas fa-save"></i>
                        Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="AddAuthGroupPermission" data-keyboard="false" data-backdrop="static" tabindex="-1"
        role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">AKSES MENU USER <b> <span class="badge badge-dark badge-lg UserText"></span>
                        </b></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('permission.add_group_permission') }}" method="post"
                        id="add_group_permission">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" class="form-control PermissionId" name="permission_id" id=""
                                aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control AuthGroupId" name="auth_group_id" id=""
                                aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="text-bold">MEMILIKI AKSES MENU : </label>
                                <ul class="ListMenuExist">
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <label class="text-bold">TIDAK MEMILIKI AKSES MENU : </label>
                                <ul class="ListMenuKosong">
                                </ul>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success BtnSaveAdd"><i class="fas fa-save"></i>
                        Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function EditPermission(kategori, nama, id) {
            if (kategori == 'permission') {
                var value = prompt("Edit Auth Permission", nama);
                if (value == null) {
                    return false;
                } else {
                    location.href = "{{ url('permission/update_permission/permission') }}/" + value + '/' + id
                }
            } else {
                var value = prompt("Edit Auth Group", nama);
                if (value == null) {
                    return false;
                } else {
                    location.href = "{{ url('permission/update_permission/group/') }}/" + value + '/' + id
                }
            }
        }

        function HapusPermission(kategori, id) {
            if (kategori == 'permission') {
                if (confirm('Apakah Kamu Yakin?')) {
                    location.href = "{{ url('permission/hapus_permission/permission') }}/" + id
                } else {
                    alert('Cancel');
                }
            } else {
                if (confirm('Apakah Kamu Yakin?')) {
                    location.href = "{{ url('permission/hapus_permission/group/') }}/" + id
                } else {
                    alert('Cancel');
                }
            }
        }

        $('#permission_add').on('submit', function(e) {
            $('.BtnSave').hide('slow');
        });

        $('#auth_group').on('submit', function(e) {
            $('.BtnSaveGroup').hide('slow');
        });

        $('#add_group_permission').on('submit', function(e) {
            $('.BtnSaveAdd').hide('slow');
        });

        function AddAuthGroupPermission(id) {
            $.ajax({
                url: "{{ url('/permission/lihat_permission') }}/" + id,
                type: "GET",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 1) {
                        $('#AddAuthGroupPermission').modal('show');
                        $('.UserText').text(response.data.auth_group.name)
                        $('.AuthGroupId').val(response.data.auth_group.id)
                        $('.PermissionId').val(response.data.permission.id)
                        $('.ListMenuExist').html('')
                        $('.ListMenuKosong').html('')
                        jQuery.each(response.data.list_exist, function(id, value) {
                            $('.ListMenuExist').append(`<li><div class="form-group form-check mt-4">
                                                        <input mt-4 type="checkbox" name="list_menu[]" value="${value.name}" checked class="form-check-input" id="exampleCheck1">${value.name}
                                                            </div>
                                                            </li>`)
                        });
                        jQuery.each(response.data.list_kosong, function(id, val) {
                            $('.ListMenuKosong').append(`<li><div class="form-group form-check mt-4">\
                                                    <input type="checkbox" name="list_menu[]" value="${val[0].name}" class="form-check-input" id="exampleCheck1">${val[0].name}
                                                        </div>
                                                            </li>`)
                        });
                    }
                }
            });
        }
    </script>
@endsection
