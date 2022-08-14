<div>
    <div>
        <h4>
            Insertar Falta de Asistencia
        </h4>
        <p>
            Por Favor seleccione la información e introduzca lo necesario.
        </p>
        <div>
            <form action="index.php" method="post" id="frmInsercionAusencia" name="frmInsercionAusencia">
                <!-- Este input oculto "setea" el acciòn con el value que le demos (dentro del switch asignatos se caso)-->
                <input type="hidden" name="action" value="frmRegistroAusencia">
                <div class="from-group">
                    <label>Id </label>
                    <input type="number" name="id" class="form-control" readonly value={$idObjeto}>
                    <label id="idMessage" class="text-danger"></label>
                </div>
                <div class="from-group">
                    <label>Id de Alumno</label>
                    <input id="alumno_id" type="text" name="alumno_id" list="lista-Estudiantes" class="form-control">
                    <datalist id="lista-Estudiantes">
                    <option value="0">Seleccione</option>
                        {assign var='counter' value={0}}
                        {section name=item loop=$ListaAlumnos}
                        <option value="{$ListaAlumnos[$counter].id}">{$ListaAlumnos[$counter].nombre}</option>
                        {assign var='counter' value=$counter+1}
                        {/section}
                    </datalist>
                    <label id="alumnoMessage" class="text-danger"></label>
                </div>
                <div class="from-group">
                    <label>Id de Asignatura </label>
                    <input type="text" id="asignatura_id" name="asignatura_id" list="lista-asignatura"
                        class="form-control">
                    <datalist id="lista-asignatura">
                        {assign var='counter' value={0}}
                        {section name=item loop=$listaAsignatura}
                        <option value="{$listaAsignatura[$counter].id}">{$listaAsignatura[$counter].nombre}</option>
                        {assign var='counter' value=$counter+1}
                        {/section}
                    </datalist>
                    <label id="asignaturaMessage" class="text-danger"></label>
                </div>
                <div class="from-group">
                    <label>Fecha </label>
                    <input type="text" id="fecha" name="fecha" class="form-control">
                    <label id="FechaMessage" class="text-danger"></label>
                </div>
                <div class="from-group">
                    <label>Justificacion </label>
                    <textarea id="justificada" name="justificada" class="form-control"></textarea>
                    <label id="JustificadaMessage" class="text-danger"></label>
                </div>
                <div class="from-group row">
                    <button type="button" onclick="onvalid()" class="col-sm-5 col-md-6 btn-outline-info btn">
                        Agregar</button>
                    <button type="button" onclick="onclickClean()" class="col-sm-5 col-md-6 btn-outline-success btn">
                        Limpiar</button>
                </div>
            </form>
        </div>
    </div>
</div>