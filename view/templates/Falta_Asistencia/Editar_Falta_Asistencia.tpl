<html>

<head>
    <!-- Bootstrap via jsDelivr-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
    <!-- Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../../js/templates/utilsFaltaAsistencia.js"></script>

    <title>Editar Información</title>
</head>

<body class="container">
    <div>
        <div>
            <h4>
                Editar Información
            </h4>
            <p>
                Por Favor seleccione la información e introduzca lo necesario.
            </p>
            <div>
                <form action="index.php" method="post" id="frmInsercionAusencia" name="frmInsercionAusencia"  onSubmit="submitHanlder()">
                    <div class="from-group">
                        <label>Id </label>
                        <input type="number" name="id" class="form-control" readonly value={$idObjeto}>
                    </div>
                    <div class="from-group">
                        <label>Id de Alumno</label>
                        <input id="alumno_id" type="text" name="alumno_id" list="lista-Estudiantes" class="form-control">
                        <datalist id="lista-Estudiantes">
                            <option>Estudiante</option>
                        </datalist>
                    </div>
                    <div class="from-group">
                        <label>Id de Asignatura </label>
                        <input type="text" name="asignatura_id" list="lista-asignatura" class="form-control">
                        <datalist id="lista-asignatura">
                            <option>Asignatura</option>
                        </datalist>
                    </div>                                        
                    <div class="from-group">
                        <label>Fecha </label>
                        <input type="date" id="fecha"  class="form-control">
                    </div>               
                    <div class="from-group">
                        <label>Justificacion </label>
                        <textarea name="justificada" class="form-control"></textarea>   
                    </div>  
                    <div class="from-group row">
                        <button onclick="" class="col-sm-5 col-md-6 btn-outline-info btn"> Guardar</button>
                        <button onclick="" class="col-sm-5 col-md-6 btn-outline-success btn"> Limpiar</button>
                    </div>   
                </form>
            </div>
        </div>
    </div>

</body>

</html>