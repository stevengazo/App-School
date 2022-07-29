<div>
    <h4>
        Insertar Falta de Asistencia
    </h4>
    <p>
        Por Favor seleccione la información e introduzca lo necesario.
    </p>
    <form action="index.php" method="post" id="frmInsertarNota" name="frmInsertarNota">
        <!--En Control redirige al controlador de Notas-->
        <input type="hidden" name="Controller" value="Notas" />        
        <input type="hidden" name="action" value="frmInsertarNota" />        
        <div class="form" >
            <div class="form-group">
                <label>Id Nota</label>
                <input type="text" class="form-control" name="id" id="id" value="{$NuevoId}" readonly />
            </div>
            <div class="form-group">
                <label>Asignatura</label>
                <input type="text" list="listAsigAlum" name="asignatura_has_alumno_id"  class="form-control" id="asignatura_has_alumno_id" placeholder="Alumno - Asignatura" />
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
                <input type="number" class="form-control" name="trimestre"  id="trimestre" placeholder="Numero de Trimestre" />
                <label id="trimestreMessage" class="text-danger"></label>
            </div>
            <div class="form-group">
                <label>Nota</label>
                <input type="number" class="form-control" name="nota"  id="nota" placeholder="Nota" />
                <label id="NotaMessage" class="text-danger"></label>
            </div>                                
        </div>
    </form>
    <div class="d-flex flex-row justify-content-space-around">
        <button type="text" class="btn btn-outline-success" onclick="onvalidation()" >Crear Nota</button>
        <button class="btn btn-outline-info" onclick="">Limpiar</button>
    </div>
</div>