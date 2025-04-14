<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sistema de Empréstimos') }}</title>

    <!-- Fontes -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            padding-bottom: 60px;
            font-family: 'Inter', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px;
            background-color: #003366;
            padding-top: 60px;
            transition: 0.3s ease-in-out;
            z-index: 200;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar a {
            padding: 16px 24px;
            text-decoration: none;
            font-size: 16px;
            color: white;
            display: block;
            transition: 0.3s ease;
            font-weight: 500;
            margin-bottom: 5px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: #005f99;
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .sidebar.active {
            left: 0;
        }

        .submenu {
            display: none;
            padding-left: 20px;
        }

        .submenu.active {
            display: block;
        }

        /* Hamburger */
        #menu-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            font-size: 28px;
            color: white;
            background: none;
            border: none;
            z-index: 300;
            cursor: pointer;
            transition: 0.3s ease;
        }

        #menu-btn:hover {
            color: #00aaff;
            transform: scale(1.1);
        }

        #menu-btn.active i {
            color: black;
        }

        /* Top header */
        .top-header {
            background-color: #003366;
            color: white;
            padding: 20px 0;
            text-align: center;
            position: relative;
            z-index: 100;
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom: 2px solid #00aaff;
        }

        .top-header img {
            height: 70px;
            margin-right: 20px;
        }

        .titulo-centralizado {
            font-size: 32px;
            font-weight: 600;
            color: white;
        }

        /* Conteúdo */
        .content-wrapper {
            padding: 30px 20px;
            margin-left: 0;
            transition: margin-left 0.3s ease-in-out;
            margin-top: 90px;
            text-align: center;
            min-height: 100vh;
            overflow-y: auto;
        }

        .sidebar.active ~ .content-wrapper {
            margin-left: 250px;
        }

        /* Rodapé fixo */
        footer {
            background-color: #003366;
            color: white;
            padding: 15px 0;
            text-align: center;

            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 100;
            font-size: 14px;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }


        /* Tabelas */
        table {
            width: 80%;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        table td {
            text-align: center;
        }

        table thead {
            background-color: #003366;
            color: white;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #003366;
            border: 1px solid #003366;
            background: none;
            border-radius: 5px;
            padding: 5px 10px;
            margin: 0 3px;
            font-weight: 600;
            transition: background-color 0.3s, color 0.3s;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #003366;
            color: white;
        }

        /* Loading Spinner */
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-size: 24px;
            font-weight: bold;
            color: #003366;
        }

        .page-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Gráficos */
        .chart-container {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .chart-container canvas {
            max-width: 400px;
            width: 100%;
        }

        /* Media Queries */
        @media (max-width: 992px) {
            .sidebar {
                width: 230px;
            }

            .top-header {
                flex-direction: column;
                padding: 10px 0;
            }

            .titulo-centralizado {
                font-size: 28px;
            }

            .content-wrapper {
                margin-top: 70px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 250px;
                left: -250px;
                position: absolute;
                transition: left 0.3s ease-in-out;
            }

            .sidebar.active {
                left: 0;
            }

            #menu-btn {
                display: block;
            }

            .content-wrapper {
                margin-left: 0;
                margin-top: 60px;
            }

            table {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .sidebar a {
                font-size: 14px;
            }

            .titulo-centralizado {
                font-size: 20px;
            }
        }

        /* Estilos para o botão do menu */
        #menu-btn i {
            transition: color 0.3s ease;
            color: white; /* Cor inicial do ícone */
        }
    </style>
</head>

<body>

    <!-- Botão hamburger -->
    <button id="menu-btn">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <a href="{{ route('home.index') }}"><i class="fas fa-home me-2"></i>Início</a>

        <a href="#" class="toggle-submenu" id="equipamentosMenu"><i class="fas fa-cogs me-2"></i> Equipamentos <i class="fas fa-chevron-down ms-2"></i></a>
        <div class="submenu" id="equipamentosSubmenu">
            <a href="{{ route('equipamentos.create') }}"><i class="fas fa-plus me-2"></i>Cadastrar Equipamento</a>
            <a href="{{ route('equipamentos.index') }}"><i class="fas fa-list me-2"></i>Listar Equipamentos</a>
        </div>

        <a href="#" class="toggle-submenu" id="usuariosMenu"><i class="fas fa-users me-2"></i> Usuários <i class="fas fa-chevron-down ms-2"></i></a>
        <div class="submenu" id="usuariosSubmenu">
            <a href="{{ route('usuarios.create') }}"><i class="fas fa-plus me-2"></i>Cadastrar Usuário</a>
            <a href="{{ route('usuarios.index') }}"><i class="fas fa-list me-2"></i>Listar Usuários</a>
        </div>

        <a href="#" class="toggle-submenu" id="emprestimosMenu"><i class="fas fa-tools me-2"></i> Empréstimos <i class="fas fa-chevron-down ms-2"></i></a>
        <div class="submenu" id="emprestimosSubmenu">
            <a href="{{ route('emprestimos.create') }}"><i class="fas fa-plus me-2"></i>Cadastrar Empréstimo</a>
            <a href="{{ route('emprestimos.index') }}"><i class="fas fa-list me-2"></i>Listar Empréstimos</a>
        </div>

        <a href="#" class="toggle-submenu" id="manutencaoMenu"><i class="fas fa-wrench me-2"></i> Manutenção <i class="fas fa-chevron-down ms-2"></i></a>
        <div class="submenu" id="manutencaoSubmenu">
            <a href="{{ route('manutencao.create') }}"><i class="fas fa-plus me-2"></i>Cadastrar Manutenção</a>
            <a href="{{ route('manutencao.index') }}"><i class="fas fa-list me-2"></i>Listar Manutenções</a>
        </div>

        <a href="{{ route('relatorio.index') }}"><i class="fas fa-chart-line me-2"></i>Ver Relatório</a>

        <form action="{{ route('logout') }}" method="POST" class="px-3 mt-3">
            @csrf
            <button type="submit" class="btn btn-danger w-100">Sair</button>
        </form>
    </div>

    <!-- Top header -->
    <div class="top-header">
        <img src="{{ asset('storage/imagem/logo2.png') }}" alt="Logo">
        <div class="titulo-centralizado">
            Sistema de Empréstimos de Equipamentos
        </div>
    </div>

    <!-- Conteúdo -->
    <div class="content-wrapper">
        <div class="container page-content">
            @yield('content')

            <div class="chart-container">
                <canvas id="emprestimosChart"></canvas>
                <canvas id="equipamentosChart"></canvas>
                <canvas id="usuariosChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        &copy; {{ date('Y') }} Sistema de Empréstimos
    </footer>


    <!-- Scripts -->
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');
        const toggleSubmenus = document.querySelectorAll('.toggle-submenu');
        const icon = menuBtn.querySelector('i');

        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            menuBtn.classList.toggle('active');
        });

        toggleSubmenus.forEach(menu => {
            menu.addEventListener('click', function () {
                const submenu = this.nextElementSibling;
                submenu.classList.toggle('active');
            });
        });

        document.addEventListener('click', function (e) {
            if (!sidebar.contains(e.target) && !menuBtn.contains(e.target)) {
                sidebar.classList.remove('active');
                menuBtn.classList.remove('active');
            }
        });

        // Scroll color change
        window.addEventListener('scroll', () => {
            if (window.scrollY > 0) {
                icon.style.color = 'black';  // Quando rolar, muda pra preto
            } else {
                icon.style.color = 'white';  // No topo, branco de novo
            }
        });

        $(document).ready(function () {
            $('table').DataTable({
                pageLength: 10,
                language: {
                    search: "Buscar:",
                    lengthMenu: "Mostrar _MENU_ itens por página",
                    zeroRecords: "Nenhum item encontrado",
                    info: "Página _PAGE_ de _PAGES_",
                    infoEmpty: "Nenhum item disponível",
                    infoFiltered: "(filtrado de _MAX_ itens totais)"
                }
            });
        });
    </script>

    @yield('scripts')
</body>

</html>
