<div>
    <div>
        <h4>
            Lista de Notas Regitradas
        </h4>
        <p>
            A continuación se muestra las notas registradas
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
            <td>
                <button class="btn btn-primary">
                    <a class="text-light nav-link active"
                    href="index.php?action=VerNota&Controller=Notas&idNota={$ListaNotas[$counter].id}">
                        Ver
                    </a>
                </button>
                <button class="btn btn-success">
                    <a class="text-light nav-link active"
                    href="index.php?action=EditarNotaGet&Controller=Notas&idNota={$ListaNotas[$counter].id}">
                        Editar
                    </a>
                </button>
                <button class="btn btn-danger">
                    <a class="text-light nav-link active"
                    href="index.php?action=EliminarNota&Controller=Notas&idNota={$ListaNotas[$counter].id}">                    
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