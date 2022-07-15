<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">


    <title>Document</title>
</head>

<body>

    <body style="background-color: #c5c5c5; ">
        <header>
            <nav class="navbar navbar-expand-sm navbar-toggleable-sm  border-bottom box-shadow" style="background: #070429;">
                <div class="container">

                    <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-collapse collapse d-sm-inline-flex justify-content-between">
                        <ul class="navbar-nav flex-grow-1">
                            <li class="nav-item navbar-collapse collapse d-sm-inline-flex justify-content-between">
                                <h5 class="navbar h5 text-light" asp-area="" asp-controller="Home" asp-action="Index">Gestion de Escuela</h5>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link d text-light" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Estudiantes
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Profesores
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" asp-area="" asp-controller="Projects" asp-action="Search">Ver Cursos</a>

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" asp-area="" asp-controller="Reports" asp-action="Search">Ver</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="dropdown">
                                    <button type="button" class="nav-link d text-light " data-bs-toggle="dropdown">
                                        Dropdown button
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Link 1</a></li>
                                        <li><a class="dropdown-item" href="#">Link 2</a></li>
                                        <li><a class="dropdown-item" href="#">Link 3</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                        Dropdown button
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Link 1</a></li>
                                        <li><a class="dropdown-item" href="#">Link 2</a></li>
                                        <li><a class="dropdown-item" href="#">Link 3</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <partial name="_LoginPartial" />
                    </div>
                </div>
            </nav>
        </header>
        <div class="container  ">
            <main role="main" class="pb-3">
                <h5 class="text-danger">
                    {$saludo}
                </h5>
            </main>
        </div>

        <footer class="border-top footer text-muted">
            <div class="container">
                &copy; 2021 - Control de Proyectos - <a asp-area="" asp-controller="Home" asp-action="Privacy">Privacidad</a>
            </div>
        </footer>



        <!-- Bootstrap via jsDelivr-->



        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <!-- Jquery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </body>

</html>