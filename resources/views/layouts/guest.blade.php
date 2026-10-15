<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<style>
    input:invalid,
    input:focus:invalid,
    select:invalid {
        box-shadow: none;
        border-color: #ced4da;
    }

    .auth-form .form-control.is-invalid,
    .auth-form .form-control.is-invalid:focus {
        border-color: #ced4da;
        background-image: none;
        box-shadow: none;
    }
</style>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="d-flex flex-column justify-content-center align-items-center min-vh-100">
                        <div class="mb-4 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-dark mb-3" style="width: 70px; height: 70px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="white" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                        </svg>
                    </div>
                    <a href="/" class="fs-1 fw-bold text-dark text-decoration-none d-block">
                        Gestion des Étudiants
                    </a>
                </div>

            <div class="w-100" style="max-width: 400px;">
                <div class="card shadow-sm p-4">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>