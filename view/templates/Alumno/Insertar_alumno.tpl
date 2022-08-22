    <div>
        <div class=" bg-light border border-primary rounded mt-3 p-3 border-secondary d-flex flex-column">
            <h4>
                Insertar Estudiante
            </h4>
            <p>
                Por Favor seleccione la información e introduzca lo necesario.
            </p>
            <div>
                <form action="index.php" id="frmInsercionEstudiante" name="frmInsercionEstudiante">
                    <!-- Este input oculto "setea" el acciòn con el value que le demos (dentro del switch asignatos se caso)-->
                    <input type="hidden" name="action" value="frmRegistroAlumno">
                    <div class="from-group">
                        <label>Cedula </label>
                        <input type="number" name="txtid" class="form-control" >
                    </div>
                    <div class="from-group">
                        <label>Nivel</label>
                        <input id="nivel" type="text" name="txtnivel" class="form-control">
                    </div>
                    <div class="from-group">
                        <label>Usuario </label>
                        <input type="text" id="usuario" name="txtusuario" class="form-control">
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
