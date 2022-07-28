<div>
    <h4>
        Insertar Falta de Asistencia
    </h4>
    <p>
        Por Favor seleccione la información e introduzca lo necesario.
    </p>
    <div class="form">
        <div class="form-group">
            <label>Id Nota</label>
            <input type="text" class="form-control" id="Etiqueta1" value="{$NuevoId}" readonly />
        </div>
        <div class="form-group">
            <label>Asignatura</label>
            <input type="text" list="listAsignaturas" class="form-control" id="Etiqueta1" placeholder="Numero de Asignatura" />
            <datalist id="listAsignaturas">
                <option value="0">No Determinado</option>
            </datalist>
        </div>
        <div class="form-group">
            <label>Alumno</label>
            <input type="text" list="listAlumnos" class="form-control" id="Etiqueta1" placeholder="Identificación" />
            <datalist id="listAlumnos">
                <option value="0">No Determinado</option>
            </datalist>
        </div>
        <div class="form-group">
            <label>Trimestre</label>
            <input type="number" class="form-control" id="Etiqueta1" placeholder="Numero de Trimestre" />
        </div>
        <div class="form-group">
            <label>Nota</label>
            <input type="number" class="form-control" id="Etiqueta1" placeholder="Nota" />
        </div>                                
    </div>
    <div class="d-flex flex-row justify-content-space-around">
        <button class="btn btn-outline-success" onclick="">Crear Nota</button>
        <button class="btn btn-outline-info" onclick="">Limpiar</button>
    </div>
</div>