<div>
    <h4>
        Editar Nota
    </h4>
    <p>
        Por Favor seleccione la información e introduzca lo necesario.
    </p>
    <form action="index.php" method="post" id="frmEditarNota" name="frmEditarNota">
        <!--En Control redirige al controlador de Notas-->
        <input type="hidden" name="Controller" value="Notas" />
        <input type="hidden" name="action" value="frmEditarNota" />
        <div class="form">
            <div class="form-group">
                <label>Id Nota</label>
                <input type="text" class="form-control" name="id" id="id" value="{$ObjetoNota.id}" readonly />
            </div>
            <div class="form-group">
                <label>Asignatura</label>
                <p>
                    <i>La asignatura actual es: {$ObjetoNota.asignaturaNombre}</i><br/>
                    <i>El alumno actual es: {$ObjetoNota.nombre}</i>
                </p>
                <input type="text" list="listAsigAlum" name="asignatura_has_alumno_id" class="form-control"
                   value="{$ObjetoNota.asignatura_has_alumno_id}" id="asignatura_has_alumno_id" placeholder="Alumno - Asignatura" />
                <datalist id="listAsigAlum">
                    {assign var='counter' value={0}}
                    {section name=item loop=$ListAsigAlum}
                    <option value="{$ListAsigAlum[$counter].id}">
                        {$ListAsigAlum[$counter].alumnoNombre}
                        {$ListAsigAlum[$counter].alumnoApellidos}
                        -
                        {$ListAsigAlum[$counter].asignaturaNombre}
                    </option>
                    {assign var='counter' value=$counter+1}
                    {/section}
                </datalist>
                <label id="AsignaturaMessage" class="text-danger"></label>
            </div>
            <div class="form-group">
                <label>Trimestre</label>
                <select type="number" class="form-control" value="{$ObjetoNota.trimestre}"  name="trimestre" id="trimestre"
                    placeholder="Numero de Trimestre">
                    <option value="1">Primer Trimestre</option>
                    <option value="2">Segundo Trimestre</option>
                    <option value="2">Tercer Trimestre</option>
                </select>
                <label id="trimestreMessage" class="text-danger"></label>
            </div>
            <div class="form-group">
                <label>Nota</label>
                <input type="number" class="form-control" name="nota" value="{$ObjetoNota.nota}" id="nota" placeholder="Nota" />
                <label id="NotaMessage" class="text-danger"></label>
            </div>
        </div>
    </form>
    <div class="d-flex flex-row justify-content-space-around">
        <button type="text" class="btn btn-outline-success" onclick="onEdit()">Actualizar</button>
        <button class="btn btn-outline-info" onclick="">Limpiar</button>
    </div>
</div>