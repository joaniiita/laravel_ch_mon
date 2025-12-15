<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .sidebar {
            width: 250px; /* Ancho fijo de la barra lateral */
            background-color: #E83333; /* Color rojo de change.org */
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            color: white; /* Para asegurar que el texto en la barra lateral sea blanco */
        }

        .main-content {
            margin-left: 250px; /* Separación del contenido principal para que no se superponga al sidebar */
            min-height: 100vh;
            background-color: #f8f9fa; /* Color de fondo ligero */
        }

        /* Color para el estado 'pendiente' */
        .badge-pendiente {
            background-color: #ffc107; /* Amarillo de Bootstrap */
            color: #212529;
        }
    </style>
</head>
<body>

<div class="d-flex">

    <div class="sidebar d-flex flex-column p-0">
        <a href="{{route('home')}}" class="p-3 text-center fs-4 fw-bold text-white text-decoration-none" style="background-color: #E83333;">
            change.org
        </a>

        <div class="p-4 border-bottom border-white border-opacity-25 text-center">
            <div
                class="mb-2 d-inline-flex align-items-center justify-content-center text-danger bg-white rounded-circle"
                style="width: 50px; height: 50px;">
                <i class="bi bi-person-fill fs-4"></i>
            </div>
            <div class="text-white">admin</div>
        </div>

        <div class="p-3">
            <div class="text-uppercase text-white-50 fw-semibold small mb-2">Main Menu</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white py-2

                       @if(request()->routeIs('adminpetitions.index'))
                           active
                       @endif"

                       @if(request()->routeIs('adminpetitions.index'))
                           style="background-color: rgba(0,0,0,0.1); border-left: 3px solid white;"
                       @endif

                       href="{{route('adminpetitions.index')}}">
                        <i class="bi bi-file-earmark-text-fill me-2"></i>
                        Peticiones
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white py-2

                       @if(request()->routeIs('admincategories.index'))
                           active
                       @endif"

                       @if(request()->routeIs('admincategories.index'))
                           style="background-color: rgba(0,0,0,0.1); border-left: 3px solid white;"
                       @endif

                       href="{{route('admincategories.index')}}">
                        <i class="bi bi-tags-fill me-2"></i>
                        Categorías

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white py-2

                       @if(request()->routeIs('adminusers.index'))
                           active
                       @endif"

                       @if(request()->routeIs('adminusers.index'))
                           style="background-color: rgba(0,0,0,0.1); border-left: 3px solid white;"
                       @endif

                       href="{{route('adminusers.index')}}">
                        <i class="bi bi-people-fill me-2"></i>
                        Usuarios

                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content flex-grow-1">

        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
            <div class="container-fluid">
                <form class="d-flex ms-3 me-auto" role="search">
                    <input class="form-control rounded-pill" type="search" placeholder="Search Here" aria-label="Search"
                           style="width: 400px;">
                </form>

                <div class="d-flex align-items-center me-3">
                    <button type="button" class="btn position-relative me-3 text-secondary">
                        <i class="bi bi-bell-fill fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                              style="font-size: 0.7em;">
                            3
                            <span class="visually-hidden">notificaciones no leídas</span>
                        </span>
                    </button>

                    <button type="button" class="btn position-relative me-3 text-secondary">
                        <i class="bi bi-envelope-fill fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success"
                              style="font-size: 0.7em;">
                            7
                            <span class="visually-hidden">mensajes no leídos</span>
                        </span>
                    </button>

                    <div class="dropdow">
                        <button class="btn p-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php $user = Auth()->user() ?>

                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/users/' . $user->image) }}"
                                     class="rounded-circle bg-light d-inline-block border border-2 border-secondary me-2"
                                     style="width: 35px; height: 35px;"
                                     alt="Foto de perfil">
                            </div>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                            <li>
                                <h6 class="dropdown-header">
                                    ¡Hola, {{ $user->name }}!
                                </h6>
                            </li>
                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a class="dropdown-item" href="{{ route('adminusers.show', $user->id) }}">
                                    <i class="bi bi-person-circle me-2"></i> Mi Perfil
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
