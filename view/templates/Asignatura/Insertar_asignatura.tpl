
        <div>
            <h4>
                Insertar Asignatura
            </h4>
            <p>
                Por Favor seleccione la información e introduzca lo necesario.
            </p>
            <div>
                <form action="index.php" id="frmInsercionAsignatura" name="frmInsercionAsignatura">
                    <!-- Este input oculto "setea" el acciòn con el value que le demos (dentro del switch asignatos se caso)-->
                    <input type="hidden" name="action" value="frmRegistroAsignatura">
                    <div class="from-group">
                        <label>Id </label>
                        <input type="number" name="txtid" class="form-control" >
                    </div>
                    <div class="from-group">
                        <label>Nivel</label>
                        <input id="usuario" type="text" name="txtnivel" class="form-control">
                    </div>
                    <div class="from-group">
                        <label>Profesor</label>
                        <input type="text" id="pass" name="txtprofe" class="form-control">
                    </div>
                    <div class="from-group">
                        <label>Nombre </label>
                        <input type="text" id="nombre" name="txtnombre" class="form-control">
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
