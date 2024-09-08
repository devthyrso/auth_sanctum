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
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Usuários Cadastrados</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Endereço</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody id="users-table-body">
                                <!-- Dados serão preenchidos via AJAX -->
                            </tbody>
                        </table>
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
        function fetchUsers() {
            $.ajax({
                url: '/api/home/users',
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                success: function (response) {
                    var tableBody = $('#users-table-body');
                    tableBody.empty(); // Limpa o tbody

                    response.forEach(function (user) {
                        var row = `
                            <tr>
                                <td>${user.name}</td>
                                <td>${user.email}</td>
                                <td>${user.rua}, ${user.bairro}, ${user.cidade}, ${user.estado} - ${user.cep}</td>
                                <td>
                                    <a href="/users/${user.id}/edit" class="btn btn-sm btn-warning">Editar</a>
                                    <button class="btn btn-sm btn-danger" onclick="deleteUser(${user.id})">Excluir</button>
                                </td>
                            </tr>
                        `;
                        tableBody.append(row);
                    });
                },
                error: function () {
                    alert('Erro ao buscar os dados.');
                }
            });
        }

        function deleteUser(userId) {
            if (confirm('Tem certeza que deseja excluir este usuário?')) {
                $.ajax({
                    url: `/api/home/users/${userId}`,
                    method: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('token'),
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    success: function () {
                        alert('Usuário excluído com sucesso.');
                        window.location.href = '/home';
                        fetchUsers(); // Recarrega a tabela
                    },
                    error: function () {
                        alert('Erro ao excluir o usuário.');
                    }
                });
            }
        }

        $(document).ready(function () {
            fetchUsers(); // Carrega os usuários quando a página é carregada
        });
    </script>

    @endsection