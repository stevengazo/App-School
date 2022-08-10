

function Home(){
    const htmlRender = `
    <!--temporal-->
    <div class="d-flex flex-column justify-content-around">
        <div class="d-flex flex-row justify-content-around">
            <h4>
                Bienvenido a Escuelita Hispanoamericana
            </h4>
            <h6>
                Sistema de Administraciòn
                <br />
            </h6>
        </div>
        <p>
            Sistema administración academico, para el uso de la comunidad estudiantil, docentes y padres.
            <br />
            En este podrá encontrar:
        <ul>
            <li>Gestión de Notas</li>
            <li>Horarios de Clases</li>
            <li>Asignaturas Matriculadas</li>
            <li>Niveles Academicos</li>            
            <li>Personal Docente registrado</li>            
        </ul>
        <p>
    </div>
    `;
    $("#renderbody").empty();
    $("#renderbody").html(htmlRender);
}