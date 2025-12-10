@extends('layouts.admin')

@section('content')
    <div class="container-fluid p-4">

        <button class="btn btn-primary mb-3">
            <i class="bi bi-plus-lg me-1"></i> New
        </button>

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
                                    <img class="rounded-circle bg-secondary bg-opacity-25" src="{{ asset('assets/images/petitions/' . optional($petition->files->first())->file_path) }}" style="width: 35px; height: 35px;">
                                </td>
                                <td>{{$petition->title}}</td>
                                <td>{{$petition->description}}</td>
                                <td>{{$petition->signers}}</td>
                                <td><span class="badge badge-pendiente text-dark">{{$petition->status}}</span></td>
                                <td>
                                    <button class="btn btn-sm btn-success me-1">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    <button class="btn btn-sm text-white me-1" style="background-color: #7c5fd0;">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>

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
