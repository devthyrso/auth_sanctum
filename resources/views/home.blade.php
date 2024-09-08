@section('content')

<div class="container">
    <h2>Usuários Cadastrados</h2>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Endereço</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->address }}, {{ $user->neighborhood }}, {{ $user->city }}, {{ $user->state }} -
                        {{ $user->cep }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $.ajax({
        url: '/api/user',
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        },
        success: function (response) {
            console.log(response);
        },
        error: function (response) {
            alert('Erro ao buscar os dados.');
        }
    });
</script>