<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('assets') }}/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/favicon.png" type="image/x-icon">
    <title>{{ $page.' - '.get_config('site_name') }}</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/feather-icon.css">
    <!-- Plugins css start-->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/style.css">
    <link id="color" rel="stylesheet" href="{{ asset('assets') }}/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/responsive.css">
</head>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="loader-p"></div>
        </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <section>
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="login-card">
                        <form class="theme-form login-form">
                            <h4>Masuk</h4>
                            <h6>Silahkan Masuk dengan akun yang sudah terdaftar.</h6>
                            <div class="form-group">
                                <label>Email Address</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                    <input class="form-control" name="email" type="email" required="" placeholder="Email anda">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control" type="password" name="password" required="" placeholder="Password anda" <div class="show-hide"><span class="show"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" id="submit" type="submit">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page-wrapper end-->
    <!-- latest jquery-->
    <script src="{{ asset('assets') }}/js/jquery-3.5.1.min.js"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets') }}/js/icons/feather-icon/feather.min.js"></script>
    <script src="{{ asset('assets') }}/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets') }}/js/sidebar-menu.js"></script>
    <script src="{{ asset('assets') }}/js/config.js"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets') }}/js/bootstrap/popper.min.js"></script>
    <script src="{{ asset('assets') }}/js/bootstrap/bootstrap.min.js"></script>
    <!-- Plugins JS start-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets') }}/js/script.js"></script>
    <!-- login js-->
    <!-- Plugin used-->
    <!-- CUSTOM JS -->
    <script>
        var token = "{{ csrf_token() }}"
        $(".login-form").submit(function(e) {
            $("#submit").attr('disabled', true);
            $("#submit").html('<i class="fa fa-spinner fa-spin"></i> Memproses');
            e.preventDefault();
            let form = new FormData(this);
            form.append('_token', token);
            axios.post(`{{ url('auth/doLogin') }}`, form)
                .then(result => {
                    if (result.data.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: result.data.message,
                        })
                    } else {
                        Swal.fire({
                            title: 'Berhasil',
                            text: "Anda akan diarahkan di dashboard",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Arahkan ke dashboard!'
                        }).then(function(result) {
                            if (result.isConfirmed) {
                                window.location.href = "{{ url('/dashboard') }}";
                            }
                        });
                    }
                    $("#submit").attr('disabled', false);
                    $("#submit").html('Sign in');
                }).catch(error => {
                    if (error.response) {
                        const data = error.response.data;
                        var errorAjax = data.errors;
                        let errorMessage = data.message
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            html: errorMessage,
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Server mengalami masalah!',
                        })
                    }
                    $("#submit").attr('disabled', false);
                    $("#submit").html('Sign in');
                })
        })
    </script>
</body>

</html>