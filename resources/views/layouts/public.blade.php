@php
    use Illuminate\Support\Facades\Auth;
@endphp

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Commissioner:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg border-bottom py-3">
        <div class="container-xl d-flex flex-wrap">

            <a class="navbar-brand fs-3 fw-bold text-danger" href="{{ route('home') }}">change.org</a>

            <a href="iniciarPeticion.html" class="btn btn-outline-dark d-lg-none border-dark fw-bold py-2 px-2 ms-auto me-2">
                Iniciar una petición
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon border rounded"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item me-3">
                        <a class="nav-link text-dark" href="#">Mis peticiones</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link text-dark" href="#">Programa de socios/as</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link text-dark" href="search.html">
                            <span class="d-inline-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search me-1" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                </svg>
                                Buscar
                            </span>
                        </a>
                    </li>

                    <li class="nav-item d-lg-none mt-2">
                        <a class="nav-link text-dark" href="#">Entrar o regístrate</a>
                    </li>
                </ul>

                <ul class="navbar-nav d-none d-lg-flex align-items-center">
                    <li class="nav-item me-3">
                        <a class="btn btn-outline-dark  border-dark fw-bold py-2 px-3" href="iniciarPeticion.html">Iniciar una petición</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Entrar</a>
                    </li>
                </ul>

            </div>

        </div>
    </nav>
</header>

@yield('content')

<footer class=" pt-5 pb-3 border-top">
    <div class="container ">
        <div class="row mb-5 border-bottom ">

            <div class="col-6 col-md-3">
                <h5 class="fw-bold mb-3 text-dark">Acerca de</h5>
                <ul class="list-unstyled fw-normal">
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Sobre Change.org</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Impacto</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Empleo</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Equipo</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-3">
                <h5 class="fw-bold mb-3 text-dark">Comunidad</h5>
                <ul class="list-unstyled fw-normal">
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Prensa</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Normas de la Comunidad</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-3 mt-4 mt-md-0">
                <h5 class="fw-bold mb-3 text-dark">Ayuda</h5>
                <ul class="list-unstyled fw-normal">
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Ayuda</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Guías</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Privacidad</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Términos</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Declaración de accesibilidad</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Política de cookies</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Gestionar cookies</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-3 mt-4 mt-md-0">
                <h5 class="fw-bold mb-3 text-dark">Redes sociales</h5>
                <ul class="list-unstyled fw-normal">
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">X</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Facebook</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Instagram</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">TikTok</a></li>
                </ul>
            </div>
        </div>

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">

            <div class="text-secondary small mb-3 mb-md-0">
                <p class="mb-1 text-dark">© 2025, Change.org, PBC</p>
                <p class="fw-normal">Esta web está protegida por reCAPTCHA y por Google
                    <a href="#" class="text-decoration-none text-primary">Política de privacidad</a> y
                    <a href="#" class="text-decoration-none text-primary">Normas de uso.</a>
                </p>
            </div>

            <div class="mb-3 mb-md-0">
                <select class="form-select form-select-sm" aria-label="Selector de idioma">
                    <option selected>Español (España)</option>
                    <option value="en">English (US)</option>
                    <option value="fr">Français</option>
                </select>
            </div>
        </div>

    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>
