<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mascota;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mascotas = Mascota::paginate(5);

        return view("mascotas.index", compact('mascotas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mascotas.crear_mascota');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'nombre' => 'required',
            'fecha_nacimiento' => 'required',
            'cedula_cliente' => 'required',
        ]);
        $usuario = User::where('cedula', $request['cedula_cliente'])->get()->first();

        if(!empty($usuario))
        {
            Mascota::create($request->all());
            return redirect()->route('mascotas.index')->with('Mensaje','Mascota creada exitosamente');
        }else{
            return redirect()->route('mascotas.create')->with('Error','Error!, el dueño no se encuentra registrado');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $mascota = Mascota::find($id);

        return view('mascotas.editar_mascota', compact('mascota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $this->validate($request, [
            'nombre' => 'required',
            'fecha_nacimiento' => 'required',
            'cedula_cliente' => 'required',
        ]);

        Mascota::find($id)->update([
            'nombre' => request('nombre'),
            'fecha_nacimiento' => request('fecha_nacimiento'),
            'cedula_cliente' => request("cedula_cliente"),
        ]);
        return redirect()->route('mascotas.index')
            ->with('Mensaje', 'Mascota correctamente editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $mascota = Mascota::findOrFail($id);
        Mascota::destroy($id); //Eliminar registro

        return redirect()->route('mascotas.index')->with('Mensaje','Mascota Eliminado con exito');
    }
}
