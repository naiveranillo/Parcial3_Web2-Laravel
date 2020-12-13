<?php

namespace App\Http\Controllers;

use App\Mail\BienvenidaMailable;
use App\Models\Mascota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usuarios = User::paginate(5);
        return view('admin.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.crear');
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
        if($request['rol'] == 'cliente'){
            $this->validate($request, [
                'name' => 'required',
                'cedula' => 'required',
                'fecha_nacimiento' => 'required',
                'rol' => 'required',
                'email' => 'required',
            ]);
            $request['password'] = 'N/A';
        }else{
            $this->validate($request, [
                'name' => 'required',
                'cedula' => 'required',
                'fecha_nacimiento' => 'required',
                'rol' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);
        }


        $datos = request()->except('_token');


        $email = User::where('email', $datos['email'])->get()->first();
        $cedula = User::where('cedula', $datos['cedula'])->get()->first();

        if(empty($email) && empty($cedula)){

            $datos['password'] = password_hash($request['password'], PASSWORD_DEFAULT);
            User::create($datos);
            $correo = new BienvenidaMailable();
            Mail::to($request['email'])->send($correo);

            return redirect()->route('admin.index')->with('Mensaje','Usuario Agregado');
        }else{
            if(!empty($email) && empty($cedula)){
                return redirect()->route('admin.index')->with('Error','Error!, el correro ya existe');
            }else if(!empty($cedula) && empty($email)){
                return redirect()->route('admin.index')->with('Error','Error!, la cedula ya existe');
            }else{
                return redirect()->route('admin.index')->with('Error','Error!, la cedula y el correo ya existe');
            }
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
        $usuario = User::find($id);
        return view('admin.editar', compact('usuario'));
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
        if($request['rol'] == 'cliente'){
            $this->validate($request, [
                'name' => 'required',
                'cedula' => 'required',
                'fecha_nacimiento' => 'required',
                'rol' => 'required',
                'email' => 'required',
            ]);
            $request['password'] = 'N/A';
        }else{
            $request['password']=password_hash($request['password'], PASSWORD_DEFAULT);
            $this->validate($request, [
                'name' => 'required',
                'cedula' => 'required',
                'fecha_nacimiento' => 'required',
                'rol' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);
        }

        User::find($id)->update($request->all());
        return redirect()->route('admin.index')->with('Mensaje','Usuario Actualizado');

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
        $usuario = Mascota::where('cedula_cliente', $id)->get()->first();
        if(empty($usuario)){
            User::where('cedula', $id)->delete();
            return redirect()->route('admin.index')->with('Mensaje','Usuario Eliminado');
        }else{
            return redirect()->route('admin.index')->with('Error','El usuario no se puede eliminar porque tiene mascotas registradas');
        }

    }
}
