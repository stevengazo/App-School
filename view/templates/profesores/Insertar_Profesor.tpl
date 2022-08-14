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
    <script src="js/templates/utilsFaltaAsistencia.js"></script>

    <title>Profesores</title>
</head>

<body class="container">
    <div>
        <div>
            <h4>
                Insertar Profesor
            </h4>
            <p>
                Por Favor seleccione la información e introduzca lo necesario.
            </p>
            <div>
                <form action="index.php" id="frmInsercionAusencia" name="frmInsercionAusencia">
                    <!-- Este input oculto "setea" el acciòn con el value que le demos (dentro del switch asignatos se caso)-->
                    <input type="hidden" name="action" value="frmRegistroProfesor">
                    <div class="from-group">
                        <label>Id </label>
                        <input type="number" name="txtid" class="form-control" >
                    </div>
                    <div class="from-group">
                        <label>Usuario</label>
                        <input id="usuario" type="text" name="txtusuario" class="form-control">
                    </div>
                    <div class="from-group">
                        <label>Contraseña </label>
                        <input type="password" id="pass" name="txtpass" class="form-control">
                    </div>
                    <div class="from-group">
                        <label>Nombre </label>
                        <input type="text" id="nombre" name="txtnombre" class="form-control">
                    </div>
                    <div class="from-group">
                        <label>Apellidos </label>
                        <input type="text" id="apellidos" name="txtapellidos" class="form-control">
                    </div>
                    <div class="from-group">
                        <label>Email </label>
                        <input type="text" id="email" name="txtemail" class="form-control">
                    </div>
                    <div class="from-group">
                      <label>Especialista</label>
                      <select class="form-control" name="cbo_especialista">
                        <option>Si</option>
                        <option>No</option>
                      </select>
                    </div>
                    <div class="from-group row">
                        <input type="submit" class="col-sm-5 col-md-6 btn-outline-info btn" value="Agregar">

                        <button type="button" onclick="onclickClean()"
                            class="col-sm-5 col-md-6 btn-outline-success btn"> Limpiar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
