<div>
    <div>
        <h4>
            Información de la Nota
        </h4>
        <p>
            A continuación se muestra la información de la nota
        </p>
    </div>
</div>
<hr />

<table class="table">
    <tbody>
        <tr>
            <th>
                N° de Registro
            </th>
            <!--id-->
            <td>
            {$NotaObjecto['id']}
            </td>
        </tr>
        <tr>
            <th>
                Estudiante
            </th>
            <!--Estudiante-->
            <td>
            {$NotaObjecto['nombre']}
            {$NotaObjecto['apellidos']}                        
            </td>
        </tr>
        <tr>
            <th>
                Asignatura
            </th>
            <!--Asignatura-->
            <td>
            {$NotaObjecto['asignaturaNombre']}                            
            </td>
        </tr>
        <tr>
            <th>
                Trimestre
            </th>
            <!--Trimestre-->
            <td>
            {$NotaObjecto['trimestre']}                        
            </td>
        </tr>
        <tr>
            <th>
                Nota
            </th>
            <!--Nota-->
            <td>
            {$NotaObjecto['nota']}                        
            </td>
        </tr>
    </tbody>
</table>


</body>