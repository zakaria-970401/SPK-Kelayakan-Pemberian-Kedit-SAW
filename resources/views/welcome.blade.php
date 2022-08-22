<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Page</title>
    <meta charset="utf-8" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .hidden {
            display: none;
        }
    </style>
</head>

<body id="kt_body" class="bg-body">
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative"
                style="background-color: #CEE0D2">
                <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                    <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                        <a href="#" class="py-9 mb-5">
                            <img alt="Logo" src="assets/media/logos/logo.png" class="h-60px" />
                        </a>
                        <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #08974B;">SISTEM INFORMASI KREDIT
                            NASABAH</h1>
                        <p class="fw-bold fs-2" style="color: #08974B;">PT. BPR ANTAR GUNA
                            <br />LAYANAN CEPAT, AMAN DAN TERPERCAYA
                        </p>
                    </div>
                    <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-400px"
                        style="background-image: url({{ url('assets/media/illustrations/sigma-1/17.png') }}"></div>
                </div>
            </div>
            <div class="d-flex flex-column flex-lg-row-fluid py-10">
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    @auth
                        <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                            <div class="text-center mb-10">
                                <h1 class="text-dark mb-3">KAMU SUDAH LOGIN</h1>
                            </div>
                            <div class="text-center">
                                <a href="{{ url('home') }}" class="btn btn-lg btn-primary w-100 mb-5">
                                    <span class="indicator-label"><i class="fas fa-home fa-lg"></i> Home</span>
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                            <form class="form w-100 post-login" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="text-center mb-10">
                                    <h1 class="text-dark mb-3">SILAHKAN LOGIN</h1>
                                </div>
                                <div class="fv-row mb-10">
                                    <label class="form-label fs-6 fw-bolder text-dark">NIK</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text"
                                        name="nik" autocomplete="off" placeholder="Masukan NIK" autofocus="on" />
                                </div>
                                <div class="fv-row mb-10">
                                    <div class="d-flex flex-stack mb-2">
                                        <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                                        {{-- <a href="javascript:void(0)" onclick="forgotPassword()">Forgot Password ?</a> --}}
                                    </div>
                                    <input class="form-control form-control-lg form-control-solid Password" type="password"
                                        name="password" autocomplete="off" placeholder="Masukan Password" />
                                    <input type="checkbox" class="ml-4 mr-4 mt-4" id="showPass"> Show Password
                                </div>
                                <div class="text-center">
                                    <button type="submit" id="btnSubmit" class="btn btn-lg btn-primary w-100 mb-5">
                                        <span class="indicator-label"><i class="fas fa-sign-in-alt fa-lg"></i> Login</span>
                                        <span
                                            class="spinner-border spinner-border-sm align-middle ms-2 hidden"></span></span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/plugins/global/plugins.bundle.js"></script>
        <script src="assets/js/scripts.bundle.js"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function forgotPassword() {
                Swal.fire({
                    title: 'Sistem akan mengirmkan permintaan ke super admin',
                    text: 'Masukkan NIK Anda',
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    showLoaderOnConfirm: true,
                    preConfirm: (login) => {
                        return fetch(`{{ url('forgot-password') }}`, {
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    nik: login
                                })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(response.statusText)
                                }
                                return response.json()
                            })
                            .catch(error => {
                                Swal.showValidationMessage(
                                    `Request failed: ${error}`
                                )
                            })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.value) {
                        Swal.fire({
                            title: 'Forgot Password',
                            text: 'Password telah dikirim ke email Anda',
                            type: 'success'
                        })
                    }
                })
            }

            $('.post-login').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var data = form.serialize();
                $('#btnSubmit').addClass('disabled', true);
                $('.spinner-border').removeClass('hidden');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    dataType: 'JSON',
                    success: function(response) {
                        console.log(response.status);
                        if (response.status == 1) {
                            location.href = "{{ url('/home') }}";
                        } else {
                            Swal.fire({
                                title: 'Login Gagal',
                                text: 'NIK atau Password salah',
                                icon: 'error'
                            });
                            $('#btnSubmit').removeClass('disabled', false);
                            $('.spinner-border').addClass('hidden');
                        }
                    },
                    error: function(error) {
                        Swal.fire({
                            title: 'Login Gagal',
                            text: 'NIK atau Password salah',
                            icon: 'error'
                        });
                        $('#btnSubmit').removeClass('disabled', false);
                        $('.spinner-border').addClass('hidden');
                    }
                });
            });

            $('#showPass').on('click', function() {
                var passInput = $(".Password");
                if (passInput.attr('type') === 'password') {
                    passInput.attr('type', 'text');
                } else {
                    passInput.attr('type', 'password');
                }
            });
        </script>
    </body>

    </html>
