<div>
    <div>
        <h4>
            Lista de Alumnos y Asignaturas
        </h4>
        <p>
            A continuación se muestran los alumnos matriculados en las asignaturas existentes.
        </p>        
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th>
                N° Registro
            </th>
            <th>
                Asignatura
            </th>
            <th>
                Estudiante
            </th>
            <th>
                Accion
            </th>
        </tr>
    </thead>
    <tbody>
        {assign var='counter' value={0}}
        {section name=item loop=$ArreglosObjetos}
        <tr>
            <!--N° Registro-->
            <td>
                {$ArreglosObjetos[$counter].id}
            </td>
            <!--Asignatura-->
            <td>
                {$ArreglosObjetos[$counter].asignaturaNombre}
            </td>
            <!--Estudiante-->            
            <td>
                {$ArreglosObjetos[$counter].alumnoNombre}
                {$ArreglosObjetos[$counter].alumnoApellidos}
            </td>         
            <td>
                <button class="btn btn-primary">
                    <a class="text-light nav-link active"
                    href="#">
                        Ver
                    </a>
                </button>
                <button class="btn btn-success">
                    <a class="text-light nav-link active"
                    href="#">
                        Editar
                    </a>
                </button>
                <button class="btn btn-danger">
                    <a class="text-light nav-link active"
                    href="#">
                        Eliminar
                    </a>
                </button>
            </td>                    
        </tr>
        {assign var='counter' value=$counter+1}
        {/section}
    </tbody>
</table>
</body>