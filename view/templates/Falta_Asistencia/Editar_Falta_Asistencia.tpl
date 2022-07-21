    <div>
        <div>
            <h4>
                Editar Información
            </h4>
            <p>
                Por Favor seleccione la información e introduzca lo necesario.
            </p>
            <div>
                <form action="index.php" method="post" id="frmEdicionAusencia">
                    <input type="hidden" name="action" value="EditandoFaltas" />
                    <div class="from-group">
                        <label>Id </label>
                        <input type="number" name="idFalta" class="form-control" readonly value={$ObjetoFaltaAsistencia.id}>
                    </div>
                    <div class="from-group">
                    <label>Id de Alumno</label>
                    <input id="alumno_id" type="text" name="alumno_id" list="lista-Estudiantes" class="form-control" value={$ObjetoFaltaAsistencia.alumno_id} >
                    <datalist id="lista-Estudiantes">
                        <option>Estudiante</option>
                    </datalist>
                    <label id="alumnoMessage" class="text-danger"></label>
                </div>
                <div class="from-group">
                    <label>Id de Asignatura </label>
                    <input type="text" id="asignatura_id" name="asignatura_id" list="lista-asignatura"
                        class="form-control"
                        value={$ObjetoFaltaAsistencia.asignatura_id}
                        >
                    <datalist id="lista-asignatura">
                        <option>Asignatura</option>
                    </datalist>
                    <label id="asignaturaMessage" class="text-danger"></label>
                </div>
                <div class="from-group">
                    <label>Fecha </label>
                    <input type="text" id="fecha" name="fecha" class="form-control" value={$ObjetoFaltaAsistencia.fecha}>
                    <label id="FechaMessage" class="text-danger"></label>
                </div>
                <div class="from-group">
                    <label>Justificacion </label>
                    <input type="text" id="justificada" name="justificada" class="form-control" value={$ObjetoFaltaAsistencia.justificada} />
                    <label id="JustificadaMessage" class="text-danger"></label>
                </div>               
                </form>
                <div class="from-group row">
                        <button type="text" onclick="editData()" class="col-sm-5 col-md-6 btn-outline-info btn">Editar</button>
                        <button type="text onclick="" class="col-sm-5 col-md-6 btn-outline-success btn"> Limpiar</button>
                </div>
            </div>
        </div>
    </div>

</body>
