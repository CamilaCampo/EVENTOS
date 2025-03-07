<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    // Listar todos los eventos
    public function index()
    {
        return response()->json(Event::all(), 200);
    }

    // Obtener detalles de un evento específico
    public function show(Event $event)
    {
        return response()->json($event);
    }

    // Crear un nuevo evento
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);

        $event = Event::create($request->all());

        return response()->json($event, 201);
    }

    // Actualizar un evento
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'date' => 'date',
            'location' => 'string|max:255',
            'capacity' => 'integer|min:1',
        ]);

        $event->update($request->all());

        return response()->json($event);
    }

    // Eliminar un evento
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['message' => 'Evento eliminado']);
    }

    // Reducir capacidad cuando se haga una reserva
    public function reduceCapacity(Request $request, Event $event)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        if ($event->capacity < $request->quantity) {
            return response()->json(['error' => 'No hay suficientes entradas'], 400);
        }

        $event->decrement('capacity', $request->quantity);
        return response()->json(['message' => 'Capacidad actualizada']);
    }
}
