@extends('layouts.app')
@section('content')
<div class="container">
    @if(Session::has('Mensaje'))
		<script>
			toastr["success"]("{{ Session::get('Mensaje') }}", "Exito");
		</script>
    @endif
    <div class="card">
        <div class="card-header">
            <a href="{{ route('mascotas.create') }}" class="btn btn-success" style="display: inline;">Crear Mascota</a>
            <h4 class="text-center mt-3" style="display: inline; margin-left: 26%;">Listado de Mascotas</h4>
        </div>
        <div class="card-body">
            <table class="table table-light table-hover">
                <thead class="thead-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Nombre:</th>
                    <th>Fecha de Nacimiento:</th>
                    <th>Cedula del Cliente:</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                @foreach($mascotas as $mascota)
                    <tbody class="text-center">
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <th >{{ $mascota->nombre }}</th>
                                <td >{{ $mascota->fecha_nacimiento }}</td>
                                <td >{{ $mascota->cedula_cliente }}</td>
                                <td >
                                    <a href="{{ route('mascotas.edit', $mascota->id) }}" class="btn btn-primary">
                                        Editar
                                    </a>
            
                                    <form action="{{ route('mascotas.destroy', $mascota->id) }}" method="post" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Desea Eliminar?')">
                                            Eliminar</button>
                                    </form>
                                </td>
                            </tr>     
                    </tbody>
                @endforeach
            </table>
            {{ $mascotas->links() }}
        </div>
    </div>    
</div>
@endsection

