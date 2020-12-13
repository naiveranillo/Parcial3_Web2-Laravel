@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"><h4>{{ __('Editar Usuario') }}</h4></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.update', $usuario->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $usuario->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cedula" class="col-md-4 col-form-label text-md-right">{{ __('Cedula') }}</label>

                            <div class="col-md-6">
                                <input readonly id="cedula" type="text" class="form-control @error('cedula') is-invalid @enderror" name="cedula" value="{{ $usuario->cedula }}" required autocomplete="cedula" >

                                @error('cedula')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input readonly id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $usuario->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fecha_nacimiento" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Nacimiento') }}</label>

                            <div class="col-md-6">
                                <input id="fecha_nacimiento" type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" name="fecha_nacimiento" value="{{ $usuario->fecha_nacimiento }}" required autocomplete="fecha_nacimiento" >

                                @error('fecha_nacimiento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rol" class="col-md-4 col-form-label text-md-right">{{ __('Tipo Usuario') }}</label>

                            <div class="col-md-6">
                                <select name="rol" id="rol" class="form-control @error('rol') is-invalid @enderror">
                                    @if ( $usuario->rol == 'administrador')
                                        <option selected value="administrador">Administrador</option>
                                        <option value="cliente">Cliente</option>
                                    @else
                                        <option value="administrador">Administrador</option>
                                        <option selected value="cliente">Cliente</option>
                                    @endif
                                    
                                </select>

                                @error('rol')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        

                        <div class="form-group row" id="divpassword">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contrasena') }}</label>

                            <div class="col-md-6">
                                <input required id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Actualizar Datos') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <script>
                        valor = document.getElementById('rol');
                        opc = valor.options[valor.selectedIndex].value;
                        if(opc == 'cliente'){
                            document.getElementById('password').removeAttribute('required');
                            document.getElementById('divpassword').style.visibility = 'hidden';
                        }else{
                            document.getElementById('password').setAttribute('required', 'true');
                            document.getElementById('divpassword').style.visibility  = 'visible';
                        }
                        
                        function habilitar(){
                            select = document.getElementById('rol').value;
                            if(select == 'cliente'){
                                document.getElementById('password').removeAttribute('required');
                                document.getElementById('divpassword').style.visibility = 'hidden';
                            }else{
                                document.getElementById('password').setAttribute('required', 'true');
                                document.getElementById('divpassword').style.visibility  = 'visible';
                            }
                        }
                        document.getElementById('rol').addEventListener('change', habilitar);
                        
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
