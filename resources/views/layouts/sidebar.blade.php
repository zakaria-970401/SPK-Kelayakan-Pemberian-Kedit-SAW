@php
    $permission = DB::table('auth_group_permission')
        ->join('auth_permission', 'auth_permission.id_permission', '=', 'auth_group_permission.permission_id')
        ->where('auth_group_permission.group_id', Auth::user()->auth_group)
        ->pluck('auth_permission.name')
        ->toArray();
@endphp
<div class="hover-scroll-overlay-y my-5 me-n4 pe-4" id="kt_aside_menu_wrapper" data-kt-scroll="true"
    data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_footer"
    data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="2px">
    <div class="menu menu-column menu-state-primary menu-title-gray-700 fs-6 menu-rounded w-100 fw-bold"
        id="#kt_aside_menu" data-kt-menu="true">
        <div data-kt-menu-trigger="click" class="menu-item here show">
            <span class="menu-link">
                <span class="menu-icon">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect x="2" y="2" width="9" height="9" rx="2"
                                fill="black" />
                            <rect opacity="0.3" x="13" y="2" width="9" height="9"
                                rx="2" fill="black" />
                            <rect opacity="0.3" x="13" y="13" width="9" height="9"
                                rx="2" fill="black" />
                            <rect opacity="0.3" x="2" y="13" width="9" height="9"
                                rx="2" fill="black" />
                        </svg>
                    </span>
                </span>
                <span class="menu-title">Dashboards</span>
            </span>
        </div>

        @if (in_array('menu_nasabah', $permission))
            <div class="menu-item">
                <div class="menu-content pt-8 pb-2">
                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">Perhitungan SAW</span>
                </div>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fas fa-users"></i>
                        </span>
                    </span>
                    <span class="menu-title">Nasabah</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    {{-- <div class="menu-item">
                        <a class="menu-link" href="{{ url('nasabah/pengajuan-kredit') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Perhitungan Kelayakan Kredit</span>
                        </a>
                    </div> --}}
                </div>
                {{-- <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ url('nasabah/list-kredit-aktif') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">List Kredit Aktif</span>
                        </a>
                    </div>
                </div>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ url('nasabah/list-jatuh-tempo') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">List Jatuh Tempo</span>
                        </a>
                    </div>
                </div> --}}
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    {{-- <div class="menu-item">
                        <a class="menu-link" href="{{ url('nasabah/permintaan-hapus-data') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Permintaan Hapus Data</span>
                        </a>
                    </div> --}}
                </div>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ url('nasabah/simulasi-kelayakan') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Perhitungan SAW</span>
                        </a>
                    </div>
                </div>
            </div>
        @endif
        @if (in_array('management_user', $permission))
            <div class="menu-item">
                <div class="menu-content pt-8 pb-2">
                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">Management Users</span>
                </div>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fas fa-cogs"></i>
                        </span>
                    </span>
                    <span class="menu-title">Master User</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ url('superadmin/user') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">List Users</span>
                        </a>
                    </div>
                </div>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                {{-- <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fas fa-desktop"></i>
                        </span>
                    </span>
                    <span class="menu-title">Master Menu</span>
                    <span class="menu-arrow"></span>
                </span> --}}
                {{-- <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ url('superadmin/menu') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Management Akses Menu</span>
                        </a>
                    </div>
                </div> --}}
                <div class="menu-item">
                    <a class="menu-link" href="{{ url('superadmin/master_bobot') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <i class="fas fa-database"></i>
                            </span>
                        </span>
                        <span class="menu-title">Kelola Bobot Kriteria
                        </span>
                    </a>
                </div>
            </div>
        @endif
        {{-- @if (in_array('permintaan_hapus_data', $permission))
            <div class="menu-item">
                <div class="menu-content pt-8 pb-0">
                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">PERMINTAAN HAPUS DATA</span>
                </div>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="#modal-permintaan-hapus" data-bs-toggle="modal">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fas fa-check-circle"></i>
                        </span>
                    </span>
                    @php
                        $permintaan = DB::table('master_nasabah')
                            ->where('status', 99)
                            ->count();
                    @endphp
                    <span class="menu-title">Lihat Permintaan @if ($permintaan > 0)
                            <span class="badge badge-danger ml-4">{{ $permintaan }}</span>
                        @endif
                    </span>
                </a>
            </div>
        @endif --}}
        @if (in_array('report', $permission))
            <div class="menu-item">
                <div class="menu-content pt-8 pb-0">
                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">REPORT</span>
                </div>
            </div>
            {{-- <div class="menu-item">
                <a class="menu-link" href="{{ url('report') }}">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fas fa-chart-bar"></i>
                        </span>
                    </span>
                    <span class="menu-title">Report</span>
                </a>
            </div> --}}
            <div class="menu-item">
                <a class="menu-link" href="{{ url('nasabah/tableHasilPerhitungan') }}">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fas fa-table"></i>
                        </span>
                    </span>
                    <span class="menu-title">Report</span>
                </a>
            </div>
        @endif
    </div>
</div>

<script>
    // function masterBunga() {
    //     $.ajax({
    //         url: "{{ url('masterbunga') }}",
    //         type: 'GET',
    //         dataType: 'json',
    //         success: function(response) {
    //             Swal.fire({
    //                 title: "Bunga Saat ini " + response.data.bunga + "%",
    //                 input: 'number',
    //                 showCancelButton: true
    //             }).then((result) => {
    //                 if (result.value) {
    //                     $.ajax({
    //                         url: "{{ url('updatebunga') }}/" + result.value,
    //                         type: 'GET',
    //                         dataType: 'json',
    //                         success: function(response) {
    //                             Swal.fire({
    //                                 title: "Success",
    //                                 text: "Bunga Berhasil Di ubah menjadi " +
    //                                     result.value + "%",
    //                                 icon: 'success',
    //                             }).then((result) => {
    //                                 location.reload()
    //                             });
    //                         }
    //                     })
    //                 }
    //             });
    //         }
    //     })
    // }
</script>
