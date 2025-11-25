<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\TipoProducto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('tipoProducto')->latest()->get();
        $tipos = TipoProducto::orderBy('nombre')->get();

        return view('home.productos', compact('productos', 'tipos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'proveedor' => 'nullable|string|max:255',
            'estado' => 'required|in:disponible,no_disponible',
            'fecha' => 'nullable|date',
            'tipo_producto_id' => 'required|exists:tipo_productos,id',
        ]);

        Producto::create($data);

        return back()->with('success', 'Producto creado correctamente');
    }

    public function update(Request $request, Producto $producto)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'proveedor' => 'nullable|string|max:255',
            'estado' => 'required|in:disponible,no_disponible',
            'fecha' => 'nullable|date',
            'tipo_producto_id' => 'required|exists:tipo_productos,id',
        ]);

        $producto->update($data);

        return back()->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return back()->with('success', 'Producto eliminado correctamente');
    }
}

