<head>

    <!-- Bootstrap via jsDelivr-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
            crossorigin="anonymous"></script> 
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">            

        <script src="https://unpkg.com/feather-icons"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

        <!-- Jquery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text"></script>

        <script
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
        <!--- Scripts para las acciones -->
        <script src="js/templates/Home.js"  ></script>
        <script src="js/templates/Generals.js" ></script>
        <script src="js/templates/Administradores.js"  ></script>
        <script src="js/templates/Alumno.js"  ></script>
        <script src="js/templates/AsignaturaHasAlumno.js"  ></script>        
        <script src="js/templates/Asignatura.js"  ></script>
        <script src="js/templates/FaltaAsistencia.js"  ></script>
        <script src="js/templates/Horarios.js"  ></script>
        <script src="js/templates/Nivel.js"  ></script>
        <script src="js/templates/Nota.js"  ></script>
        <script src="js/templates/Padre.js"  ></script>
        <script src="js/templates/Padre_has_alumno.js"  ></script>        
        <script src="js/templates/Profesor.js"  ></script>
        <!--ICONS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic.min.css" rel="stylesheet">
        <!--Script con datos basicos de sesion -->
        {$scriptStorage}                
    
    <!-- Title-->
    <title>{$titulo}</title>
</head>