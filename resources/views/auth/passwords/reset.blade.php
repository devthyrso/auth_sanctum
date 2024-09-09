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
                    <div class="card-header">{{ __('Recuperar Senha') }}</div>

                    <div class="card-body">
                        <form id="resetPasswordForm">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" name="email" id="email"required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Nova Senha</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirme a Nova Senha</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    id="password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Redefinir Senha</button>
                        </form>

                        <div id="error-message" class="text-danger mt-3" style="display: none;"></div>
                        <div id="success-message" class="text-success mt-3" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#resetPasswordForm').on('submit', function (event) {
            event.preventDefault();

            const token = $('input[name="token"]').val();
            const password = $('#password').val();
            const password_confirmation = $('#password_confirmation').val();
            const email = $('#email').val();

            $.ajax({
                url: `/api/password/reset/${token}`,
                method: 'POST',
                data: {
                    email: email,
                    token: token,
                    password: password,
                    password_confirmation: password_confirmation,
                },
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                success: function (response) {
                    $('#success-message').text(response.message).show();
                    $('#error-message').hide();
                    window.location.href = '/auth/login';
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors || {};
                    let errorMessage = '';

                    if (errors.password) {
                        errorMessage = errors.password[0];
                    } else if (errors.password_confirmation) {
                        errorMessage = errors.password_confirmation[0];
                    } else if (errors.token) {
                        errorMessage = 'O token de redefinição é inválido ou expirou.';
                    } else {
                        errorMessage = 'Erro ao redefinir a senha. Por favor, tente novamente.';
                    }

                    $('#error-message').text(errorMessage).show();
                    $('#success-message').hide();
                }
            });
        });

    </script>
</body>

</html>
@endsection