<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
    <link rel="shortcut icon" href="{{ url('assets/media/logos/fav.png') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700')}}" />
    <link href="{{ url('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <style type="text/css">
        .hidden {
            display: none;
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-enabled">
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <div id="kt_aside" class="aside px-5" data-kt-drawer="true" data-kt-drawer-name="aside"
                data-kt-drawer-activate="true" data-kt-drawer-overlay="true"
                data-kt-drawer-width="{default:'200px', '300px': '285px'}" data-kt-drawer-direction="start"
                data-kt-drawer-toggle="#kt_aside_toggle">
                <div class="aside-menu flex-column-fluid">
                    @include('layouts.sidebar')
                </div>
                <!--end::Aside menu-->
                <!--begin::Footer-->
                <div class="aside-footer flex-column-auto pt-3 pb-7" id="kt_aside_footer">
                    <a href="javascript:void(0)" onclick="postLogout()" class="btn btn-custom btn-dark w-100"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" title="Logout">
                        <span class="btn-label">Logout</span>
                        <!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->
                        <span class="svg-icon btn-icon svg-icon-2">
                            <i class="fas fa-power-off"></i>
                        </span>
                        <!--end::Svg Icon-->
                    </a>
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header"
                    data-kt-sticky-animation="false" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
                    <!--begin::Container-->
                    <div class="container-xxl d-flex align-items-center flex-lg-stack">
                        <!--begin::Brand-->
                        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-2 me-lg-5">
                            <!--begin::Wrapper-->
                            <div class="flex-grow-1">
                                <!--begin::Aside toggle-->
                                <button
                                    class="btn btn-icon btn-color-gray-800 btn-active-color-primary aside-toggle justify-content-start w-30px w-lg-40px"
                                    id="kt_aside_toggle">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen059.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15"
                                            viewBox="0 0 16 15" fill="none">
                                            <rect y="6" width="16" height="3" rx="1.5"
                                                fill="black" />
                                            <rect opacity="0.3" y="12" width="8" height="3"
                                                rx="1.5" fill="black" />
                                            <rect opacity="0.3" width="12" height="3" rx="1.5"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                                <!--end::Aside toggle-->
                                <!--begin::Header Logo-->
                                <a href="{{ url('/home') }}">
                                    <img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}"
                                        class="h-30px h-lg-35px" />
                                </a>
                                <!--end::Header Logo-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Brand-->
                        <!--begin::Toolbar wrapper-->
                        <div class="d-flex align-items-stretch flex-shrink-0">
                            <a href="#" class="btn btn-light-success me-1 time"></a>
                            <!--begin::User menu-->
                            <div class="d-flex align-items-center ms-1 ms-lg-3">
                                <!--begin::Menu wrapper-->
                                <div class="btn btn-color-gray-800 btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px position-relative btn btn-color-gray-800 btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                                    data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                    data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                                    <span class="svg-icon svg-icon-2x">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                                fill="black" />
                                            <rect opacity="0.3" x="8" y="3" width="8"
                                                height="8" rx="4" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--begin::User account menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                                    data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content d-flex align-items-center px-3">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-50px me-5">
                                                <img alt="Logo"
                                                    src="{{ asset('assets/media/avatars/300-1.jpg') }}" />
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Username-->
                                            <div class="d-flex flex-column">
                                                <div class="fw-bolder d-flex align-items-center fs-5">
                                                    {{ Auth::user()->name }}
                                                </div>
                                                <a href="#"
                                                    class="fw-bold text-muted text-hover-primary fs-7">{{ Auth::user()->nik }}</a>
                                            </div>
                                            <!--end::Username-->
                                        </div>
                                    </div>
                                    <div class="separator my-2"></div>
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5 my-1">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#change-password"
                                            class="menu-link px-5">Ubah Password</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">
                                        <a href="javascript:void(0)" onclick="postLogout()"
                                            class="menu-link px-5">Sign Out</a>
                                    </div>
                                    <div class="separator my-2"></div>
                                    <div class="menu-item px-5">
                                        <div class="menu-content px-5">
                                            <span class="form-check-label text-dark fs-7 text-center">PT BPR Antar
                                                Guna</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::User menu-->
                            <!--begin::Chat-->
                            <!--end::Chat-->
                        </div>
                        <!--end::Toolbar wrapper-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->
                <!--begin::Container-->
                <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
                    <div class="content flex-row-fluid" id="kt_content">
                        @yield('content')
                    </div>
                </div>
                <div class="footer pb-4 d-flex flex-lg-column" id="kt_footer">
                    <div
                        class="container-xxl d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-bold me-1">2022©</span>
                            <a class="text-gray-800 text-hover-primary">PT. BPR ANTAR GUNA</a>
                        </div>
                        <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
                            <li class="menu-item">
                                <a class="menu-link px-2">Jl. Setia Darma I No.34, Setiadarma, Kec. Tambun Sel.,
                                    Kabupaten Bekasi, Jawa Barat 17510</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="change-password" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Ganti Password</h5>
                </div>
                <form action="{{ route('post-change-password') }}" method="POST" id="ubahPw">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="password" name="password" id=""
                                        class="form-control Password" placeholder="Masukan Password Baru"
                                        aria-describedby="helpId" required>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-4">
                                <div class="form-group">
                                    <input type="password" name="password_konfirm" id=""
                                        class="form-control Password" placeholder="Konfirmasi Password"
                                        aria-describedby="helpId" required>
                                </div>
                                <input type="checkbox" class="ml-4 mr-4 mt-4" id="showPass"> Show Password
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"> Update</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <script src="{{ url('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ url('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ url('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#showPass').on('click', function() {
            var passInput = $(".Password");
            if (passInput.attr('type') === 'password') {
                passInput.attr('type', 'text');
            } else {
                passInput.attr('type', 'password');
            }
        });


        function postLogout() {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                // text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout!',
                cancelButtonText: 'Nanti Dulu,'
            }).then((result) => {
                if (result.value) {
                    window.location.href = "{{ route('post-logout') }}";
                }
            })
        }

        function kasihNol($data) {
            if ($data < 10) {
                return '0' + $data;
            } else {
                return $data;
            }
        }

        function get_time() {
            const today = new Date();
            const time = kasihNol(today.getHours()) + ":" + kasihNol(today.getMinutes()) + ":" + kasihNol(today
                .getSeconds());
            const date = kasihNol(today.getDate()) + '/' + kasihNol((today.getMonth() + 1)) + '/' + kasihNol(today
                .getFullYear());
            // $('.date').text(date);
            $('.time').text(time);
        }

        get_time();

        setInterval(function() {
            get_time();
        }, 1000);

        $('#ubahPw').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var data = form.serialize();
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'gagal') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Password tidak sama!',
                        });
                    } else if (response.status == 'kurang') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Password minimal 6 karakter!',
                        });
                        // toastr.error(data.message);
                    } else {
                        Swal.fire({
                            icon: 'success',
                            text: 'Password berhasil diubah!',
                        });
                        location.href = "{{ route('post-logout') }}";
                    }
                }
            });
        });
    </script>
</body>

</html>
