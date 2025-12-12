@extends('layouts.admin')

@section('content')
    <div class="container-fluid p-4">

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr class="table-light">
                            <th>ID</th>
                            <th>Image</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>
                                    <img class="rounded-circle bg-secondary bg-opacity-25" src="{{ asset('assets/images/users/' . $user->image) }}" style="width: 35px; height: 35px;">
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td>
                                    <a href="{{route('adminusers.edit', $user->id)}}" class="btn btn-sm btn-success me-1">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a href="{{route('adminusers.show', $user->id)}}" class="btn btn-sm text-white me-1" style="background-color: #7c5fd0;">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>

                                    <button type="button"
                                            class="btn btn-sm btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal-{{ $user->id }}">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade"
                                 id="deleteModal-{{ $user->id }}"
                                 tabindex="-1"
                                 aria-labelledby="deleteModalLabel-{{ $user->id }}"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel-{{ $user->id }}">Confirmar
                                                eliminación</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Cerrar"></button>
                                        </div>

                                        <div class="modal-body">
                                            ¿Estás seguro de que deseas eliminar la petición {{ $user->name }} ?
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancelar
                                            </button>

                                            <form method="POST" action="{{ route('adminusers.delete', $user->id) }}">
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
