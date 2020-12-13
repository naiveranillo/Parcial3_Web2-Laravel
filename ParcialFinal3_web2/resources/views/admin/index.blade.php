@extends('layouts.app')
@section('content')
<div class="container">
    @if(Session::has('Mensaje'))
		<script>
			toastr["success"]("{{ Session::get('Mensaje') }}", "Exito");
		</script>
    @endif
    @if(Session::has('Error'))
		<script>
			toastr["error"]("{{ Session::get('Error') }}", "Error");
		</script>
    @endif
    <div class="card">
        <div class="card-header">
            <a class="nav-link btn btn-success" href="{{ url('admin/create') }}" 
            style="display: inline;">Crear usuario</a>
            <h4 class="text-center mt-3" style="display: inline; margin-left: 25%;">Listado de Usuarios</h4>
        </div>
        <div class="card-body">
            <table class="table table-light table-hover">
                <thead class="thead-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Nombre:</th>
                    <th>Cédula:</th>
                    <th>Fecha Nacimiento</th>
                    <th>Rol</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                @foreach($usuarios as $usuario)
                    <tbody class="text-center">
                        @if(Auth::user()->cedula != $usuario->cedula)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <th >{{ $usuario->name }}</th>
                                <td >{{ $usuario->cedula }}</td>
                                <td >{{ $usuario->fecha_nacimiento }}</td>
                                <td >{{ $usuario->rol }}</td>
                                <td >{{ $usuario->email }}</td>
                                <td >
                                    <a href="{{ route('admin.edit', $usuario->id) }}" class="btn btn-primary">
                                        Editar
                                    </a>
            
                                    <form action="{{ route('admin.destroy', $usuario->cedula) }}" method="post" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Desea Eliminar?')">
                                            Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endif    
                    </tbody>
                @endforeach
            </table>
            {{ $usuarios->links() }}
        </div>
    </div>
    
    
</div>



@endsection