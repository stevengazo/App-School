<!--SIMPLE NAV VAR-->

<body class="container " style="background-color:#D4E6F1;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded mt-3 ">

        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?action=index">
                <img src="images/logo.png"  style="width:8rem;height:4rem;" alt="logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">

                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Ausencias
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="dropdown-item" onclick="GetInsertFaltaAsistencia()">
                                Agregar Ausencia
                            <li class="dropdown-item" onclick="ViewListaAusencia()">
                                Lista Ausencias
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Estudiantes
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="index.php?Controller=Profesor&action=CrearProfe">Agregar
                                Estudiante</a>
                            <!--  <li><hr class="dropdown-divider"></li> -->
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="dropdown-item" onclick="fn_listar_alumnos()">
                                Ver Estudiantes
                            <li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Niveles
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" onclick="fn_mostrar_form_reg()" >Agregar Nivel</a>
                            <!--  <li><hr class="dropdown-divider"></li> -->
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="dropdown-item" onclick="fn_listar_nivel()">
                                Ver Niveles
                            <li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Profesores
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="">Agregar Profesor</a>
                            <!--  <li><hr class="dropdown-divider"></li> -->
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
                            Notas
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="dropdown-item" onclick="GetInsertNota()">
                                Registrar Nota
                            </li>
                            <!--  <li><hr class="dropdown-divider"></li> -->
                            <li class="dropdown-item" onclick="ViewListaNotas()">
                                Ver Notas
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Asignaturas
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" >Ver
                                Asignaturas</a>
                            <!--  <li><hr class="dropdown-divider"></li> -->
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="dropdown-item" onclick="fn_listar_asig()">
                                Ver Asignaturas
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Administración
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="dropdown-item">
                                Matricular Estudiante
                            </li>
                            <li class="dropdown-item">
                                Listar Estudiantes
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="dropdown-item">
                                Inscripción Profesor
                            </li>
                            <li class="dropdown-item">
                                Busqueda Profesor
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="dropdown-item">
                                Creación Horarios
                            </li>
                            <li class="dropdown-item">
                                Consultar Horarios
                            </li>
                            <!--  <li><hr class="dropdown-divider"></li> -->
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="dropdown-item" onclick="GetInsertAsignaturaHasAlumno()">
                                Matricular Estudiantes - Asignatura
                            </li>
                            <li class="dropdown-item" onclick="ViewListaAsigHasAlum()">
                                Estudiantes - Asignatura
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