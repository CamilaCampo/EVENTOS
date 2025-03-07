@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Evento</h1>
    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Fecha</label>
            <input type="datetime-local" name="date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Ubicación</label>
            <input type="text" name="location" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Capacidad</label>
            <input type="number" name="capacity" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
