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
                    <div class="card-header"> Registro </div>
                    <div class="card-body">
                        <form id="registerForm">
                            @csrf
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="name" class="col-form-label">Nome Completo</label>
                                </div>
                                <div class="col-auto">
                                    <input class="form-control" type="text" name="name" id="name"
                                        value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="email" class="col-form-label">E-mail</label>
                                </div>
                                <div class="col-auto">
                                    <input class="form-control" type="text" name="email" id="email"
                                        value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="password" class="col-form-label">Senha</label>
                                </div>
                                <div class="col-auto">
                                    <input class="form-control" type="password" name="password" id="password"
                                        value="{{ old('password') }}" required>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="password_confirmation" class="col-form-label">Confirmar Senha</label>
                                </div>
                                <div class="col-auto">
                                    <input class="form-control" type="password" name="password_confirmation"
                                        id="password_confirmation" value="{{ old('password_confirmation') }}" required>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="cep" class="col-form-label">CEP</label>
                                </div>
                                <div class="col-auto">
                                    <input class="form-control" type="text" name="cep" id="cep" value="{{ old('cep') }}"
                                        required>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="rua" class="col-form-label">Rua</label>
                                </div>
                                <div class="col-auto">
                                    <input class="form-control" type="text" name="rua" id="rua" value="{{ old('rua') }}"
                                        required>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="bairro" class="col-form-label">Bairro</label>
                                </div>
                                <div class="col-auto">
                                    <input class="form-control" type="text" name="bairro" id="bairro"
                                        value="{{ old('bairro') }}" required>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="numero" class="col-form-label">Número</label>
                                </div>
                                <div class="col-auto">
                                    <input class="form-control" type="number" name="numero" id="numero"
                                        value="{{ old('numero') }}" required>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="cidade" class="col-form-label">Cidade</label>
                                </div>
                                <div class="col-auto">
                                    <input class="form-control" type="text" name="cidade" id="cidade"
                                        value="{{ old('cidade') }}" required>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="estado" class="col-form-label">Estado</label>
                                </div>
                                <div class="col-auto">
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
                    window.location.href = '/login';
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