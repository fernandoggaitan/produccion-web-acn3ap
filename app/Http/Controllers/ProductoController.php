<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

//Librería para validar.
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{

    private $rules = [
        'nombre' => 'required|max:255',
        'precio' => 'numeric|max:9999999',
        'categoria_id' => 'required',
        'descripcion' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $productos = Producto::where('is_visible', true)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('productos.index', [
            'productos' => $productos
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();
        return view('productos.create', [
            'categorias' => $categorias
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Agregamos la validación de imágenes.
        $this->rules['imagen'] = 'required|mimes:jpg,bmp,png,gif';

        $validator = Validator::make($request->all(), $this->rules, [
            'nombre.required' => 'El nombre del producto es obligatorio.'
        ]);

        if($validator->fails())
        {
            return redirect()
                ->route('productos.create')
                ->withErrors($validator)
                ->withInput();
        }

        //Guardamos el nombre del archivo, modificando el nombre original del cliente con time.
        $imagen_nombre = time() . $request->file('imagen')->getClientOriginalName();

        //Subimos el archivo a una carpeta del proyecto y guardamos el nombre con el que subió el archivo.
        $imagen = $request->file('imagen')->storeAs('productos', $imagen_nombre, 'public');
        
        Producto::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'categoria_id' => $request->categoria_id,
            'descripcion' => $request->descripcion,
            'imagen' => $imagen,
        ]);

        return redirect()
            ->route('productos.index')
            ->with('status', 'El producto se ha agregado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        return view('productos.show', [
            'producto' => $producto
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        $categorias = Categoria::orderBy('nombre')->get();
        return view('productos.edit', [
            'categorias' => $categorias,
            'producto' => $producto
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {

        //El usuario está intentando enviar un archivo.
        if($request->file('imagen')){
            $this->rules['imagen'] = 'required|mimes:jpg,bmp,png,gif';
        }

        //Valida todo.
        $validator = Validator::make($request->all(), $this->rules, [
            'nombre.required' => 'El nombre del producto es obligatorio.'
        ]);

        //Si falló la validación.
        if($validator->fails())
        {
            return redirect()
                ->route('productos.edit', $producto)
                ->withErrors($validator)
                ->withInput();
        }

        //El usuario está intentando enviar un archivo.
        if($request->file('imagen')){
            
            //Guardamos el nombre del archivo, modificando el nombre original del cliente con time.
            $imagen_nombre = time() . $request->file('imagen')->getClientOriginalName();

            //Subimos el archivo a una carpeta del proyecto y guardamos el nombre con el que subió el archivo.
            $imagen = $request->file('imagen')->storeAs('productos', $imagen_nombre, 'public');

        }else{
            $imagen = $producto->imagen;
        }        

        $producto->update([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'categoria_id' => $request->categoria_id,
            'descripcion' => $request->descripcion,
            'imagen' => $imagen,
        ]);

        return redirect()
            ->route('productos.index')
            ->with('status', 'El producto se ha modificado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        
        //Eliminado físico
        //$producto->delete();

        $producto->update([
            'is_visible' => false,
        ]);

        return redirect()
            ->route('productos.index')
            ->with('status', 'El producto se ha eliminado correctamente');

    }
}
