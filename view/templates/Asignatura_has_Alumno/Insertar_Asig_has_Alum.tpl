<div>
    <div>
        <h4>
            Matricular Alumno en Asignatura
        </h4>
        <p>
            Por favor seleccione el alumno especificado y la asignatura deseada
        </p>
        <div>
            <form action="index.php" method="post" id="PostInsertar" name="PostInsertar">
                <!-- Este input oculto "setea" el acciòn con el value que le demos (dentro del switch asignatos se caso)-->                            
                <input type="hidden" name="action" value="PostInsertar">
                <input type="hidden" name="Controller" value="AsignaturaHasAlumno">
                <div class="from-group">
                    <label>Id </label>
                    <input type="number" name="id" class="form-control" readonly value="{$id}">
                </div>
                <div class="from-group">
                    <label>Asignatura </label>
                    <select name="id" name="asignatura_id" class="form-control">
                        {assign var='counter' value={0}}
                        {section name=item loop=$ArregloAsignaturas}
                        <option value="{$ArregloAsignaturas[$counter].id}">
                            {$ArregloAsignaturas[$counter].nombre}
                        </option>
                        {assign var='counter' value=$counter+1}
                        {/section}
                    </select>
                    <label id="AsignaturaMessage" class="text-danger"></label>
                </div>
                <div class="from-group">
                    <label>Alumno </label>
                    <select name="id" name="alumno_id" class="form-control">
                        {assign var='counter' value={0}}
                        {section name=item loop=$arregloAlumnos}
                        <option value="{$arregloAlumnos[$counter].id}">
                            {$arregloAlumnos[$counter].nombre}
                        </option>
                        {assign var='counter' value=$counter+1}
                        {/section}
                    </select>
                    <label id="AlumnoMessage" class="text-danger"></label>
                </div>

                <div class="from-group row">
                    <button type="button" onclick="onValidationAsigHasAlumn()" class="col-sm-5 col-md-6 btn-outline-info btn">
                        Agregar</button>
                    <button type="button" onclick="" class="col-sm-5 col-md-6 btn-outline-success btn">
                        Limpiar</button>
                </div>
            </form>
        </div>
    </div>
</div>