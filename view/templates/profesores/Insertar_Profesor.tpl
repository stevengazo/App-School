<body class="container">
    <div class=" bg-light border border-primary rounded mt-3 p-3 border-secondary d-flex flex-column">
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
