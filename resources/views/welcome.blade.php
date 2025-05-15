<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Equipia</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Animate.css for animations -->
    <link href="https://cdn.jsdelivr.net/npm/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            padding-bottom: 80px; /* Para garantir que o rodapé não sobreponha o conteúdo */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Define a altura da tela */
            margin: 0;
        }
        .logo-container {
            text-align: center;
        }
        .login-btn {
            font-weight: bold;
            font-size: 1.2rem;
        }
        .logo-container img {
            max-width: 50%;
            height: auto;
        }
        .navbar-custom {
            background-color: #003366;
        }
        .navbar-custom .navbar-brand, .navbar-custom .nav-link {
            color: white !important;
        }
        .navbar-custom .nav-link:hover {
            color: #f8f9fa !important;
        }
        .btn-custom {
            background-color: #003366;
            color: white;
            border-radius: 30px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #003366;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #003366;
            color: white;
            text-align: center;
            padding: 20px 0;
            font-size: 1rem;
            font-family: 'Instrument Sans', sans-serif;
        }
        .footer a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>

</head>
<body class="d-flex flex-column align-items-center min-vh-100">

    <!-- Navbar com o botão de login no canto superior direito -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top w-100">
        <div class="container-fluid">
            <a class="navbar-brand ms-3" href="#">My Platform</a>
            <div class="d-flex">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline-light rounded-3 px-4 py-2">
                            Dashboard
                        </a>
                    @else
                        <!-- Botão de Login -->
                        <a href="{{ route('login') }}" class="btn btn-custom px-4 py-2 login-btn">
                            Login
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Conteúdo principal -->
    <div class="logo-container">
        <!-- Logo -->
        <div class="mb-4 animate__animated animate__fadeIn">
            <img src="{{ asset('storage/imagem/logo.png') }}" alt="Logo" class="img-fluid">
        </div>
    </div>

    <!-- Rodapé -->
    <div class="footer">
        <p>&copy; 2025 <a href="#">My Platform</a>. Todos os direitos reservados.</p>
    </div>

    <!-- Bootstrap JS, Popper.js e jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <!-- JavaScript personalizado -->
    <script>
        window.onload = function() {
            const loginBtn = document.querySelector('.login-btn');
            loginBtn.classList.add('animate__animated', 'animate__fadeIn');
        };
    </script>
</body>
</html>
