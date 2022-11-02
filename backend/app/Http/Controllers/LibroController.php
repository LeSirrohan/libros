<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function index()
    {
        return Libro::all();
    }
    public function store(Request $request)
    {
        $request->validate([
            "titulo"=>["required"],
            "autor"=>["required"]

        ]);
        $libro = new Libro;
        $libro->titulo = $request->input('titulo');
        $libro->autor = $request->input('autor');
        $libro->save();
        return $libro;
    }
    public function show(Libro $libro)
    {
        return $libro;
    }

    public function update(Request $request, Libro $libro)
    {
        $request->validate([
            "titulo"=>["required"],
            "autor"=>["required"]

        ]);
        $libro->titulo = $request->input('titulo');
        $libro->autor = $request->input('autor');
        $libro->save();
        return $libro;
    }
    public function destroy(Libro $libro)
    {
        $libro->delete();
        return response()->noContent();
    }
}
