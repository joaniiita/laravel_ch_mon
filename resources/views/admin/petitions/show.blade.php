@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h3 mb-0 ">Detalles de la Petición</h2>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-white">
                        <h6 class="m-0 font-weight-bold text-danger">Detalles de la Petición</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <img src="{{ asset('assets/images/petitions/' . optional($petition->files->first())->file_path) }}"
                                     class="img-fluid rounded shadow-sm w-100"
                                     style="object-fit: cover; max-height: 400px;"
                                     alt="Imagen de la petición">
                            </div>

                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-uppercase small text-muted">Título:</label>
                                    <p class="fs-5">{{$petition->title}}</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold text-uppercase small text-muted">Descripción:</label>
                                    <p>{{$petition->description}}</p>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label fw-bold text-uppercase small text-muted">Destinatario:</label>
                                        <p>{{$petition->destinatary}}</p>
                                    </div>
                                    <div class="col-sm-3 mb-3">
                                        <label class="form-label fw-bold text-uppercase small text-muted">Firmantes:</label>
                                        <p><i class="fas fa-users me-1"></i> {{$petition->signers}}</p>
                                    </div>
                                    <div class="col-sm-3 mb-3">
                                        <label class="form-label fw-bold text-uppercase small text-muted">Estatus:</label>
                                        <div>
                                            @if($petition->status === 'accepted')
                                                <span class="badge bg-success">Aceptada</span>
                                            @elseif($petition->status === 'pending')
                                                <span class="badge bg-warning text-dark">Pendiente</span>
                                            @else
                                                <span class="badge bg-secondary">{{$petition->status}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="d-flex justify-content-end">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
