<div>
    <div>
        <h4>
            Lista de Notas Regitradas
        </h4>
        <p>
            A continuación se muestra las notas registradas
        </p>
        <a href="index.php?Controller=Notas&action=CrearNota">Agregar nuevo registo de nota</a>
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
                Trimestre
            </th>
            <th>
                Nota
            </th>
            <th>
                Accion
            </th>
        </tr>
    </thead>
    <tbody>
        {assign var='counter' value={0}}
        {section name=item loop=$ListaNotas}
        <tr>
            <!--N° Registro-->
            <td>
                {$ListaNotas[$counter].id}
            </td>
            <!--Asignatura-->
            <td>
                {$ListaNotas[$counter].asignaturaNombre}
            </td>
            <!--Estudiante-->            
            <td>
                {$ListaNotas[$counter].apellidos}
                {$ListaNotas[$counter].nombre}
            </td>         
            <!--Trimestre-->            
            <td>
                {$ListaNotas[$counter].trimestre}
            </td>                        
            <!--Nota-->            
            <td>
                {$ListaNotas[$counter].nota}
            </td>                    
        </tr>
        {assign var='counter' value=$counter+1}
        {/section}

    </tbody>
</table>
</body>