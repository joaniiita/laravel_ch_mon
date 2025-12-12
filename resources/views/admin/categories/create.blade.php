@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">



        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h3 mb-0 text-gray-800">Crear Nueva Petición</h2>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-white">
                        <h6 class="m-0 font-weight-bold text-danger">Detalles de la Petición</h6>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('admincategories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Escribe un nombre descriptivo" required>
                                @error('name')
                                    <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admincategories.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                                <button type="submit" class="btn btn-danger">
                                    Guardar Categoría
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

