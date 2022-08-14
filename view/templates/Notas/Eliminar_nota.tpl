<div>
    <div>
        <h4>
            Eliminar Nota Registrada
        </h4>
        <p>
            A continuación se muestra la información de la nota a borrar
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
<div class="d-flex flex-row">
   <button class="btn btn-danger">
    <a class="text-light nav-link active"
        href="index.php?action=EliminarNotaPost&Controller=Notas&idNota={$NotaObjecto['id']}">                    
            Eliminar Usuario
        </a>
   </button>
   <button class="btn btn-info">
<a class="dropdown-item" href="index.php?action=listaNotas&Controller=Notas">Regresar</a>
</button>   
</div>

</body>