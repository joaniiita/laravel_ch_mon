@extends('layouts.admin')

@section('content')
    <div class="container-fluid p-4">

        <a href="{{route('admincategories.create')}}" class="btn btn-primary mb-3">
            <i class="bi bi-plus-lg me-1"></i> New
        </a>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr class="table-light">
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>
                                    <a href="{{route('admincategories.edit', $category->id)}}" class="btn btn-sm btn-success me-1">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
{{--                                    <button class="btn btn-sm text-white me-1" style="background-color: #7c5fd0;">--}}
{{--                                        <i class="bi bi-eye-fill"></i>--}}
{{--                                    </button>--}}

                                    <button type="button"
                                            class="btn btn-sm btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal-{{ $category->id }}">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade"
                                 id="deleteModal-{{ $category->id }}"
                                 tabindex="-1"
                                 aria-labelledby="deleteModalLabel-{{ $category->id }}"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel-{{ $category->id }}">Confirmar
                                                eliminación</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Cerrar"></button>
                                        </div>

                                        <div class="modal-body">
                                            ¿Estás seguro de que deseas eliminar la petición {{ $category->name }} ?
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancelar
                                            </button>

                                            <form method="POST" action="{{ route('admincategories.delete', $category->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <nav class="d-flex justify-content-end mt-3">
            <ul class="pagination pagination-sm">
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

    </div>

@endsection
