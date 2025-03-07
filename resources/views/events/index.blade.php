@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Eventos</h1>
    @if(Session::get('role') === 'admin')
        <a href="{{ route('events.create') }}" class="btn btn-primary">Crear Evento</a>
    @endif
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Ubicación</th>
                <th>Capacidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>{{ $event['name'] }}</td>
                    <td>{{ $event['date'] }}</td>
                    <td>{{ $event['location'] }}</td>
                    <td>{{ $event['capacity'] }}</td>
                    <td>
                        @if(Session::get('role') === 'admin')
                            <form action="{{ route('events.destroy', $event['id']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
