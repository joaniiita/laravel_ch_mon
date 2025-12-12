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

                        <form action="{{ route('petitions.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="title" class="form-label fw-semibold">Título</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="Escribe un título claro y descriptivo" required>
                                @error('title')
                                    <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-semibold">Descripción</label>
                                <textarea class="form-control" id="description" name="description" rows="6"
                                          placeholder="Describe el problema y lo que pides a los responsables" required></textarea>
                                @error('description')
                                    <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="category" class="form-label fw-semibold">Categoría</label>
                                    <select class="form-select" id="category" name="category" required>
                                        <option selected disabled value="">Selecciona una Categoría...</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="text-danger mt-1 small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="destinatary" class="form-label fw-semibold">Responsable/Destinatario</label>
                                    <input type="text" class="form-control" id="destinatary" name="destinatary"
                                           placeholder="Ej: Ministerio de Salud, Alcalde X, Empresa Y" required>
                                    @error('destinatary')
                                    <div class="text-danger mt-1 small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label fw-semibold">Imagen Principal (Opcional)</label>
                                <input class="form-control" type="file" id="image" name="image" accept="image/*">
                                <div id="imagenHelp" class="form-text">Sube una imagen representativa para tu petición (Max 2MB).</div>
                                @error('imagen')
                                    <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>


                            <hr class="my-4">

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('adminpetitions.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                                <button type="submit" class="btn btn-danger">
                                    Guardar Petición
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

