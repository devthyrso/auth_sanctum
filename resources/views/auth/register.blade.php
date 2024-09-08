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
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registro</div>
                    <div class="card-body">
                        <form id="registerForm">
                            @csrf
                            <div class="mb-3 row">
                                <label for="name" class="col-sm-3 col-form-label">Nome Completo</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="name" id="name"
                                        value="{{ old('name') }}" required>
                                </div>
                            </div>

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

                            <div class="mb-3 row">
                                <label for="password_confirmation" class="col-sm-3 col-form-label">Confirmar Senha</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="password" name="password_confirmation"
                                        id="password_confirmation" required>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="mb-3 row">
                                <label for="cep" class="col-sm-3 col-form-label">CEP</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="cep" id="cep" value="{{ old('cep') }}"
                                        required onBlur="buscarEndereco()" pattern="\d{8,9}" inputmode="numeric">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="rua" class="col-sm-3 col-form-label">Rua</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="rua" id="rua" value="{{ old('rua') }}"
                                        required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="bairro" class="col-sm-3 col-form-label">Bairro</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="bairro" id="bairro"
                                        value="{{ old('bairro') }}" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="numero" class="col-sm-3 col-form-label">Número</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="number" name="numero" id="numero"
                                        value="{{ old('numero') }}" required inputmode="numeric">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="cidade" class="col-sm-3 col-form-label">Cidade</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="cidade" id="cidade"
                                        value="{{ old('cidade') }}" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="estado" class="col-sm-3 col-form-label">Estado</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="estado" id="estado"
                                        value="{{ old('estado') }}" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Cadastrar</button>
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

        $('#registerForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '/api/auth/register',
                method: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    alert('Cadastro realizado com sucesso! Redirecionando para o login...');
                    window.location.href = '/auth/login';
                },
                error: function (response) {
                    alert('Erro: ' + response.responseJSON.message);
                }
            });
        });

        function buscarEndereco() {
            var cep = document.getElementById('cep').value;

            if (cep.length === 8 || cep.length === 9) {
                fetch('https://viacep.com.br/ws/' + cep + '/json/')
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            document.getElementById('rua').value = data.logradouro;
                            document.getElementById('bairro').value = data.bairro;
                            document.getElementById('cidade').value = data.localidade;
                            document.getElementById('estado').value = data.uf;
                        } else {
                            alert("CEP inválido.");
                        }
                    })
                    .catch(error => {
                        alert("Erro ao buscar endereço.");
                    });
            } else {
                alert("Digite um CEP válido.");
            }
        }
    </script>
</body>

</html>

@endsection
