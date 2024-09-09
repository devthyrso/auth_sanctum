@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> LOGIN </div>
                    <div class="card-body">
                        <form id="loginForm" method="POST">
                            @csrf

                            <div class="mb-3 row">
                                <label for="email" class="col-sm-3 col-form-label">E-mail</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="email" name="email" id="email"
                                        value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password" class="col-sm-3 col-form-label">Senha</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="password" name="password" id="password"
                                        required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6 offset-md-3">
                                    <div class="form-check">
                                        <a href="{{ route('password.request') }}" class="btn btn-link">Esqueceu a senha?</a>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#loginForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '/api/auth/login',
                method: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    localStorage.setItem('token', response.access_token);

                    $.ajax({
                        url: '/home',
                        method: 'GET',
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('token')
                        },
                        success: function (data) {
                            window.location.href = '/home';
                        },
                        error: function (error) {
                            console.log('Erro ao acessar home:', error);
                        }
                    });
                },
                error: function (response) {
                    alert('Erro: ' + response.responseJSON.error);
                }
            });
        });
    </script>

</body>

</html>
@endsection