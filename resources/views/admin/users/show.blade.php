@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4 ">

        <div class="d-flex justify-content-between align-items-center mb-4 mx-5">
            <h2 class="h3 mb-0 text-gray-800">Detalle del Usuario: {{ $user->name }}</h2>
            <a href="{{ route('adminusers.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Volver al Listado
            </a>
        </div>

        <div class="row mx-5">

            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-body text-center">

                        <div class="mt-3 mb-4">
                            <img src="{{ asset('assets/images/users/' . $user->image) }}" class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center border border-3 border-secondary" style="width: 120px; height: 120px; overflow: hidden;">
                        </div>

                        <h4 class="card-title">{{ $user->name }}</h4>
                        <p class="text-muted">{{ $user->email }}</p>

                        <hr>

                        <div class="row text-center">
                            <div class="col-6">
                                <h5 class="fw-bold">{{ $user->petitions_count ?? 0 }}</h5>
                                <p class="text-muted small">Peticiones Creadas</p>
                            </div>
                            <div class="col-6">
                                <h5 class="fw-bold">{{ $user->signatures_count ?? 0 }}</h5>
                                <p class="text-muted small">Peticiones Firmadas</p>
                            </div>
                        </div>

                        <div class="d-grid mt-3">
                            <a href="{{ route('adminusers.edit', $user->id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil-square me-2"></i> Editar Perfil
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">

                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-white">
                        <h6 class="m-0 font-weight-bold text-danger">Información Administrativa</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                ID:
                                <span>{{ $user->id }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Rol:
                                @php
                                    $roleClass = ($user->is_admin ?? false) ? 'bg-danger' : 'bg-success';
                                @endphp
                                <span class="badge {{ $roleClass }}">{{ ($user->is_admin ?? false) ? 'Administrador' : 'Usuario Estándar' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Cuenta Verificada (Email):
                                @if ($user->email_verified_at)
                                    <span class="badge bg-success">Sí ({{ $user->email_verified_at->format('d/m/Y') }})</span>
                                @else
                                    <span class="badge bg-warning text-dark">No</span>
                                @endif
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Fecha de Registro:
                                <span>{{ $user->created_at->format('d/m/Y H:i') }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Última Actualización:
                                <span>{{ $user->updated_at->format('d/m/Y H:i') }}</span>
                            </li>
                        </ul>


                    </div>
                </div>

                @if ($user->petitions->count() > 0)
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 bg-white">
                            <h6 class="m-0 font-weight-bold text-danger">Peticiones Creadas Recientemente</h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($user->petitions->take(5) as $petition)
                                <li class="list-group-item d-flex justify-content-between align-items-center ">
                                    <a href="{{ route('petitions.show', $petition->id) }}" class="text-decoration-none text-black">{{ Str::limit($petition->title, 60) }}</a>
                                    <span class="badge bg-secondary">{{ $petition->created_at->diffForHumans() }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>


@endsection
