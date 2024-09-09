@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
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
                        <form id="passwordResetForm">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ __('Enviar Link de Recuperação') }}
                            </button>
                        </form>

                        <div id="response-message" class="mt-3" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#passwordResetForm').on('submit', function (event) {
            event.preventDefault();

            const formData = $(this).serialize();

            $.ajax({
                url: '/api/password/email',
                method: 'POST',
                data: formData,
                success: function (response) {
                    $('#response-message').removeClass('text-danger').addClass('text-success')
                        .text('Link de recuperação enviado com sucesso!').show();
                        window.location.href = '/auth/login';
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors || {};
                    let errorMessage = 'Erro ao enviar o link de recuperação.';

                    if (errors.email) {
                        errorMessage = errors.email[0];
                    }

                    $('#response-message').removeClass('text-success').addClass('text-danger')
                        .text(errorMessage).show();
                }
            });
        });
    </script>
</body>

</html>

@endsection
