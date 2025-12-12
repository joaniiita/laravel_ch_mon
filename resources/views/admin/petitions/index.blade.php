@extends('layouts.admin')

@section('content')
    <div class="container-fluid p-4">

        <a href="{{route('adminpetitions.create')}}" class="btn btn-primary mb-3">
            <i class="bi bi-plus-lg me-1"></i> New
        </a>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr class="table-light">
                            <th>ID</th>
                            <th>Image</th>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Firmantes</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($petitions as $petition)
                            <tr>
                                <td>{{$petition->id}}</td>
                                <td>
                                    <img class="rounded-circle bg-secondary bg-opacity-25"
                                         src="{{ asset('assets/images/petitions/' . optional($petition->files->first())->file_path) }}"
                                         style="width: 35px; height: 35px;">
                                </td>
                                <td>{{$petition->title}}</td>
                                <td>{{$petition->description}}</td>
                                <td>{{$petition->signers}}</td>
                                <td>
                                    @if($petition->status === 'pending')
                                        <span class="badge badge-pendiente text-dark">{{$petition->status}}</span>
                                    @elseif($petition->status === 'accepted')
                                        <span class="badge bg-success text-white">{{$petition->status}}</span>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="{{route('adminpetitions.change', $petition->id)}}" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-yellow btn-sm text-white me-1 ">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </form>

                                    <a href="{{route('adminpetitions.edit', $petition->id)}}" class="btn btn-sm btn-success me-1">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a href="{{route('petitions.show', $petition->id)}}" class="btn btn-sm text-white me-1" style="background-color: #7c5fd0;">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>

                                    <button type="button"
                                            class="btn btn-sm btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal-{{ $petition->id }}">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade"
                                 id="deleteModal-{{ $petition->id }}"
                                 tabindex="-1"
                                 aria-labelledby="deleteModalLabel-{{ $petition->id }}"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel-{{ $petition->id }}">Confirmar
                                                eliminación</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Cerrar"></button>
                                        </div>

                                        <div class="modal-body">
                                            ¿Estás seguro de que deseas eliminar la petición {{ $petition->title }} ?
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancelar
                                            </button>

                                            <form method="POST" action="{{ route('petitions.delete', $petition->id) }}">
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
