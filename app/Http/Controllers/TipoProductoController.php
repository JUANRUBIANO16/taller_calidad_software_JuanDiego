<?php

namespace App\Http\Controllers;

use App\Models\TipoProducto;
use Illuminate\Http\Request;

class TipoProductoController extends Controller
{
    public function index()
    {
        $tipos = TipoProducto::orderBy('nombre')->get();

        return view('home.tipo_productos', compact('tipos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255|unique:tipo_productos,nombre',
        ]);

        TipoProducto::create($data);

        return back()->with('success', 'Tipo de producto creado correctamente');
    }

    public function update(Request $request, TipoProducto $tipo_producto)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255|unique:tipo_productos,nombre,' . $tipo_producto->id,
        ]);

        $tipo_producto->update($data);

        return back()->with('success', 'Tipo de producto actualizado correctamente');
    }

    public function destroy(TipoProducto $tipo_producto)
    {
        $tipo_producto->delete();

        return back()->with('success', 'Tipo de producto eliminado correctamente');
    }
}



