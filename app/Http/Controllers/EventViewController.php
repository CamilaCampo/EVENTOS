<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class EventViewController extends Controller
{
    public function index()
    {
        $response = Http::timeout(10)->get('http://127.0.0.1:8002/api/events');
        if ($response->failed()) {
            return response()->json(['error' => 'No se pudo conectar con el Servicio de Eventos'], 500);
        }
        $events = $response->json();

        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $token = Session::get('token');

        $response = Http::withToken($token)->post('http://127.0.0.1:8002/api/events', $request->all());

        if ($response->failed()) {
            return back()->withErrors(['error' => 'No autorizado o datos inválidos']);
        }

        return redirect()->route('events.index');
    }

    public function destroy($id)
    {
        $token = Session::get('token');

        $response = Http::withToken($token)->delete("http://127.0.0.1:8002/api/events/{$id}");

        if ($response->failed()) {
            return back()->withErrors(['error' => 'No autorizado']);
        }

        return redirect()->route('events.index');
    }

    public function login()
    {
        return view('events.login');
    }

    public function authenticate(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8001/api/login', [
            'email' => $request->email,
            'password' => $request->password
        ]);

        if ($response->failed()) {
            return back()->withErrors(['error' => 'Credenciales incorrectas']);
        }

        $data = $response->json();
        Session::put('token', $data['token']);
        Session::put('role', $data['user']['role']);

        return redirect()->route('events.index');
    }
}
