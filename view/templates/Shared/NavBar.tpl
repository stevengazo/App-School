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
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ausencias
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">                        
                        <li>
                            <a class="dropdown-item" href="index.php?action=ListaFaltaAsistencia&Controller=FaltaAsistencia">Lista Ausencias</a>
                        <li>
                            <a class="dropdown-item" href="index.php?action=InsertarAusencia&Controller=FaltaAsistencia">Agregar Ausencia</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Notas
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php?Controller=Notas&action=CrearNota">Agregar nuevo registo de nota</a>                        
                        <!--  <li><hr class="dropdown-divider"></li> -->
                        <li>
                            <a class="dropdown-item" href="index.php?action=listaNotas&Controller=Notas">Listar Notas</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Asignaturas
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php?Controller=Notas&action=CrearNota">Ver Asignaturas</a>                        
                        <!--  <li><hr class="dropdown-divider"></li> -->
                        <li><hr class="dropdown-divider"></li>                        
                        <a class="dropdown-item" href="index.php?Controller=Notas&action=CrearNota">Lista Estudiantes - Asignaturas</a>                        
                        <a class="dropdown-item" href="index.php?Controller=Notas&action=CrearNota">Busqueda Estudiantes - Asignaturas</a>                        
                    </ul>
                </li>                
                <li class="nav-item">
                    <a class="nav-link active" href="#">Profesores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Estudiantes</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Administración
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php?Controller=Notas&action=CrearNota">Matricula Estudiante</a>                        
                        <a class="dropdown-item" href="index.php?Controller=Notas&action=CrearNota">Busqueda Estudiante</a>                        
                        <li><hr class="dropdown-divider"></li>                        
                        <a class="dropdown-item" href="index.php?Controller=Notas&action=CrearNota">Inscripción Profesor</a>                        
                        <a class="dropdown-item" href="index.php?Controller=Notas&action=CrearNota">Busqueda Profesor</a>                                            
                        <li><hr class="dropdown-divider"></li>
                        <a class="dropdown-item" href="index.php?Controller=Notas&action=CrearNota">Creación Horarios</a>                        
                        <a class="dropdown-item" href="index.php?Controller=Notas&action=CrearNota">Consulta Horarios</a>                        
                        <!--  <li><hr class="dropdown-divider"></li> -->
                        <li><hr class="dropdown-divider"></li>
                        <a class="dropdown-item" href="index.php?Controller=Notas&action=CrearNota">Agregar Asignatura</a>                        
                        <a class="dropdown-item" href="index.php?Controller=Notas&action=CrearNota">Ver Asignatura</a>                        
                        <li><hr class="dropdown-divider"></li>
                        <a class="dropdown-item" href="index.php?Controller=AsignaturaHasAlumno&action=PostInsertar">Matricula Estudiante - Asignatura</a>                        
                        <a class="dropdown-item" href="index.php?Controller=Notas&action=CrearNota">Buscar Estudiante - Asignatura</a>   
                        <a class="dropdown-item" href="index.php?Controller=AsignaturaHasAlumno&action=Listar">Ver Estudiante - Asignatura</a>   
                    </ul>
                </li>  
            </ul>
        </div>
    </div>
</nav>