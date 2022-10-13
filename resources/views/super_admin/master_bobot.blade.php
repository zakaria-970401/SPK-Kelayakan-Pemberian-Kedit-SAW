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
                {{-- <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="#addpermission" data-bs-toggle="modal" class="btn btn-md btn-dark mt-4"
                                style="border-radius: 10px;"><i class="fas fa-plus mr-1"></i> Tambah
                                Menu</a>
                        </div>
                    </div>
                </div> --}}
                <div class="card-body mb-4">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="table-responsive">
                                <h5>MASTER BOBOT KRITERIA</h5>
                                <table id="table">
                                    <thead>
                                        <tr class="text-center">
                                            <th>NO</th>
                                            <th>KODE KRITERIA</th>
                                            <th>NAMA KRITERIA</th>
                                            <th>BOBOT</th>
                                            <th>Tools</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kriteria as $list)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $list->kode }}</td>
                                                <td>{{ $list->kriteria }}</td>
                                                <td>{{ $list->bobot . '%' }}</td>
                                                <td>
                                                    <a href="javascript:void(0)"
                                                        onclick="editKriteria('{{ $list->id }}')"
                                                        class="btn btn-sm btn-warning" style="border-radius: 10px;"><i
                                                            class="fas fa-edit mr-1"></i> Edit</a>
                                                    {{-- <a href="javascript:void(0)"
                                                        onclick="HapusPermission('permission','{{ $list->id }}')"
                                                        class="btn btn-sm btn-danger" style="border-radius: 10px;"><i
                                                            class="fas fa-trash-alt mr-1"></i> Hapus</a> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="table-responsive">
                                <h5>MASTER NILAI CRIPS KEDISIPLINAN KREDIT</h5>
                                <table id="table">
                                    <thead>
                                        <tr class="text-center">
                                            <th>NO.</th>
                                            <th>KODE KRITERIA</th>
                                            <th>KEDISIPLINAN KREDIT</th>
                                            <th>NILAI CRIPS</th>
                                            <th>TOOLS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sub as $list)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $list->kode }}</td>
                                                <td>{{ $list->sub }}</td>
                                                <td>{{ $list->nilai }}</td>
                                                <td>
                                                    <a href="javascript:void(0)" onclick="editSub('{{ $list->id }}')"
                                                        class="btn btn-sm btn-warning" style="border-radius: 10px;"><i
                                                            class="fas fa-edit mr-1"></i> Edit</a>
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

    <div class="modal fade" id="modal-kriteria" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">FORM EDIT KRITERIA</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('superadmin/updateKriteria') }}" method="post" id="auth_group">
                        @csrf
                        <input type="text" class="form-control idKriteriaValue" hidden name="idKriteria"
                            id="" />
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">KRITERIA</label>
                                    <input type="text" class="form-control kriteriaValue" name="kriteria" id=""
                                        aria-describedby="helpId" required>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="">BOBOT(DALAM PERSENTASE)</label>
                                    <input type="text" class="form-control bobotValue" name="bobot" id=""
                                        aria-describedby="helpId" required>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>
                        Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-sub" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">FORM EDIT SUB KRITERIA</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('superadmin/updatesubKriteria') }}" method="post" id="auth_group">
                        @csrf
                        <input type="text" class="form-control idsubKriteria" hidden name="idsub" id="" />
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">VALUE</label>
                                    <input type="text" class="form-control valueKriteria" name="value"
                                        id="" aria-describedby="helpId" required>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="">NILAI</label>
                                    <input type="text" class="form-control nilaiValue" name="nilai" id=""
                                        aria-describedby="helpId" required>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>
                        Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function editKriteria(id) {
            $.ajax({
                url: " {{ url('superadmin/editKriteria') }}/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(response) {
                    $('#modal-kriteria').modal('show');
                    $('.idKriteriaValue').val(response.data.id)
                    $('.kriteriaValue').val(response.data.kriteria)
                    $('.bobotValue').val(response.data.bobot)
                }
            })
        }

        function editSub(id) {
            $.ajax({
                url: " {{ url('superadmin/editSubKriteria') }}/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(response) {
                    $('#modal-sub').modal('show');
                    $('.idsubKriteria').val(response.data.id)
                    $('.valueKriteria').val(response.data.sub)
                    $('.nilaiValue').val(response.data.nilai)
                }
            })
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
