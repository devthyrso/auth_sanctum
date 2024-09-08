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
                    <div class="card-header text-center">Editar Usuário</div>

                    <div class="card-body">
                        <form method="PUT" id="editUserForm" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="rua" class="form-label">Rua</label>
                                <input type="text" name="rua" class="form-control" value="{{ $user->rua }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" name="bairro" class="form-control" value="{{ $user->bairro }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" name="numero" class="form-control" value="{{ $user->numero }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" name="cidade" class="form-control" value="{{ $user->cidade }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <input type="text" name="estado" class="form-control" value="{{ $user->estado }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" name="cep" class="form-control" value="{{ $user->cep }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary" >Atualizar</button>
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
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('editUserForm');

            form.addEventListener('submit', function (event) {
                event.preventDefault();  // Previne o envio padrão do formulário

                const formData = new FormData(form);
                const url = form.action;

                $.ajax({
                    url: url,
                    method: 'PUT',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    success: function (response) {
                        alert('Usuário editado com sucesso.');
                        window.location.href = '/home';
                    },
                    error: function (response) {
                        alert('Erro ao editar o usuário.');
                    }
                });
            });
        });
    </script>


</body>

</html>

@endsection