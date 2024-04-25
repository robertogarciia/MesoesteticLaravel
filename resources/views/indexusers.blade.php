@extends('master')

@section('content')
    <div class="container">
        <h1>Lista de Usuarios</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Correo</th>
                    <th>Contraseña</th>
                    <th>Cargo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->password }}</td>
                    <td>
                        @if($usuario->post == 1)
                            admin
                        @elseif($usuario->post == 0)
                            user
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
