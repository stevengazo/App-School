<!--SIMPLE NAV VAR-->

<body class="container " style="background-color:#ff4800;">
        <h6 class="h6 text-light mb-0">Modo Alumno</h6>
    <nav class="border-primary navbar navbar-expand-lg navbar-light bg-light rounded mt-3 ">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?action=index">
                <img src="images/logo.png" style="width:8rem;height:4rem;" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">        
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Personal
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">                    
                            <li class="dropdown-item" onclick="miInformación()">
                                Datos
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Estudiantes
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="dropdown-item" onclick="fn_listar_alumnos()">
                                Ver Estudiantes
                            <li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Horarios
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">                            
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="dropdown-item" onclick="VerListaHorarios()">
                                Ver Horarios
                            <li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Profesores
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">                          
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="dropdown-item" onclick="fn_listar_profesor()">
                                Ver Profesores
                            <li>
                        </ul>
                    </li>                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Asignaturas
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">                                                                                  
                            <li class="dropdown-item" onclick="fn_listar_asig()">
                                Ver Asignaturas existentes
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Usuario
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="dropdown-item">
                                <a href="index.php?action=cerrar_sesion" class="nav-link text-danger">
                                    Cerrar Sesión
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>