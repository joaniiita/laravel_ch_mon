@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h3 mb-0 text-gray-800">Editar Usuario</h2>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-white">
                        <h6 class="m-0 font-weight-bold text-danger">Detalles del Usuario</h6>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('adminusers.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{$user->name}}" required>
                                @error('name')
                                    <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label fw-semibold">Imagen Principal (Opcional)</label>
                                <input class="form-control" type="file" id="image" name="image" accept="image/*">
                                <div id="imagenHelp" class="form-text">Sube una imagen representativa para tu petición (Max 2MB).</div>
                                @error('imagen')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{$user->email}}" required>
                                @error('email')
                                    <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Contraseña</label>
                                <input type="text" class="form-control" id="password" name="password"
                                       value="{{$user->password}}" required>
                                @error('password')
                                    <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label fw-semibold">Rol</label>
                                <input type="text" class="form-control" id="role" name="role"
                                       value="{{$user->role}}" required>
                                @error('role')
                                    <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>




                            <hr class="my-4">

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('adminusers.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                                <button type="submit" class="btn btn-danger">
                                    Guardar Usuario
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

