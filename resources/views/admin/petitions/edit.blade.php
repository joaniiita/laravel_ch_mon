@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        {{$error}}
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h3 mb-0 text-gray-800">Editar Petición</h2>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-white">
                        <h6 class="m-0 font-weight-bold text-danger">Detalles de la Petición</h6>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('petitions.update', $petition->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="mb-3">
                                <label for="title" class="form-label fw-semibold">Título</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{$petition->title}}" required>
                                @error('title')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label fw-semibold">Imagen Principal (Opcional)</label>
                                <input class="form-control" type="file" id="image" name="image" accept="image/*">
                                <div id="imagenHelp" class="form-text">Sube una imagen representativa para tu petición.</div>
                                @error('imagen')
                                    <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-semibold">Descripción</label>
                                <input type="text" class="form-control" id="description" name="description"
                                       value="{{$petition->description}}" required>
                                @error('description')
                                    <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="destinatary" class="form-label fw-semibold">Destinatario</label>
                                <input type="text" class="form-control" id="destinatary" name="destinatary"
                                       value="{{$petition->destinatary}}" required>
                                @error('description')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="category" class="form-label fs-5">Categoría</label>
                                <select class="form-select" aria-label="Default select example" name="category" id="category">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>

                                @error('category')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

{{--                            <div class="mb-3">--}}
{{--                                <label for="status" class="form-label fw-semibold">Estado</label>--}}
{{--                                <input type="text" class="form-control" id="status" name="status"--}}
{{--                                       placeholder="{{$petition->status}}" required>--}}
{{--                                @error('status')--}}
{{--                                    <div class="text-danger mt-1 small">{{ $message }}</div>--}}
{{--                                @enderror--}}
{{--                            </div>--}}


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

