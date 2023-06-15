<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ $this->asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ $this->asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style---->
    <link rel="stylesheet" href="{{ $this->asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="hold-transition login-page ">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center card-outline card-primary">
                <a href="../../index2.html" class="h1"><b>Lo</b>gin</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Bienvenido al sistema de notas</p>
                @if ($this->ExistSession('mensaje'))
                    <div class="alert alert-danger">
                        <b>{{ $this->getSession('mensaje') }}</b>
                    </div>
                    @php
                        $this->destroySession('mensaje');
                    @endphp
                @endif

                @if ($this->ExistSession('errores'))
                    <div class="alert alert-danger">
                        @foreach ($this->getSession('errores') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>

                    @php
                        $this->destroySession('errores');
                    @endphp
                @endif

                <form action="{{ $this->route('login/SignIn') }}" method="post">
                    <input type="hidden" class="form-control" name="token_" value="{{ $this->get_Csrf() }}">

                    <div class="input-group mb-3">
                        <input type="email" class="form-control" autofocus placeholder="Email" name="email"
                            id="email" value="{{ $this->old('email') }}" autocomplete="email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password"
                            id="password" autocomplete="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" id="login"><b>Entrar</b> <i
                                    class="fas fa-sign-in"></i></button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ $this->asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ $this->asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ $this->asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
