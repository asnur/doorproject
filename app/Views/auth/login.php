<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">


</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="/assets/img/smart-door.png" style="width: 15%;">
                                        <h1 class="h2 text-gray-900 mt-1 mb-4">Door Lock System</h1>
                                    </div>
                                    <form action="<?= route_to('auth') ?>" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="text" oninvalid="invalid_alert(this,'username')" id="username" name="username" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Masukkan Username" required minlength="5">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" oninvalid="invalid_alert(this,'password')" required minlength="5" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Masukkan Password">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/assets/js/sb-admin-2.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const invalid_alert = (element, name) => {
            let length = element.value.length;
            console.log(length);
            if (length == 0) {
                element.setCustomValidity(`Kolom ${name} tidak boleh kosong`);
            } else if (length < 5) {
                element.setCustomValidity(`Kolom ${name} minimal 5 karakter`);
            } else {
                //reset
                element.setCustomValidity('');

            }
        };
        <?php if (session()->getFlashdata('success')) : ?>
            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil',
                text: '<?= session()->getFlashdata('success') ?>',
                type: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#4E73DF'
            });
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: '<?= session()->getFlashdata('error') ?>',
                type: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#4E73DF'
            });
        <?php endif; ?>
    </script>

</body>

</html>