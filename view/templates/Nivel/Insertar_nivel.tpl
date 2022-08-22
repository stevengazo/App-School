
<body class="container">
    <div class=" bg-light border border-primary rounded mt-3 p-3 border-secondary d-flex flex-column">
        <div>
            <h4>
                Insertar Nivel
            </h4>
            <p>
                Por Favor seleccione la información e introduzca lo necesario.
            </p>            
            <div>
                <form action="index.php" id="frmInsercionNivel" name="frmInsercionNivel">
                    <!-- Este input oculto "setea" el acciòn con el value que le demos (dentro del switch asignatos se caso)-->
                    <input type="hidden" name="action" value="frmRegistroNivel">
                    <div class="from-group">
                        <label>Id </label>
                        <input type="number" name="txtid" class="form-control" >
                    </div>
                    <div class="from-group">
                        <label>Nivel</label>
                        <input id="nivel" type="text" name="txtnivel" class="form-control">
                    </div>
                    <div class="from-group">
                        <label>Curso</label>
                        <input type="text" id="curso" name="txtcurso" class="form-control">
                    </div>
                    <div class="from-group">
                        <label>Aula</label>
                        <input type="text" id="aula" name="txtaula" class="form-control">
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
