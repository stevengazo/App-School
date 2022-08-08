<!--SIMPLE NAV VAR-->

<body class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?">App_School</a>
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
                            <li class="dropdown-item" onclick="ViewListaAusencia()" >
                                Lista Ausencias 
                            </li>
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
                            <li class="dropdown-item" onclick="ViewListaNotas()" >
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
                            <a class="dropdown-item" href="index.php?Controller=Notas&action=CrearNota">Ver
                                Asignaturas</a>
                            <!--  <li><hr class="dropdown-divider"></li> -->
                            <li>
                                <hr class="dropdown-divider">
                            </li>                            
                            <li class="dropdown-item">
                                Ver Asignaturas
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Profesores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Estudiantes</a>
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
                            <li class="dropdown-item">
                                Agregar Asignatura
                            </li>
                            <li class="dropdown-item">
                                Matricular Estudiante - Asignatura
                            </li>                        
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>