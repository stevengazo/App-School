/*
  Descripciòn: limpia los valores en el formulario
 */
function onclickClean() {
  document.getElementById("alumno_id").value = "";
  document.getElementById("asignatura_id").value = "";
  document.getElementById("fecha").value = "";
  document.getElementById("justificada").value = "";
}


function Prueba(){
  alert("sample");
  console.log("sample");
}

/*
  Descripciòn: Valida la informaciòn en los inputs 
  y envia el formulario al servidor.
*/
function onvalid() {
  const id = document.getElementById("id");
  const alumno = document.getElementById("alumno_id");
  const asignatura = document.getElementById("asignatura_id");
  const fecha = document.getElementById("fecha");
  const justificada = document.getElementById("justificada");

  let flag = false;

  console.log(
    ` - ${alumno.value} -${asignatura.value} -${fecha.value} - ${justificada.value}`
  );

  /* valudaciones de nulos */
  if (alumno.value == "" || alumno.value == null) {
    document.getElementById("alumnoMessage").innerText =
      "El valor no puede ser nulo";
    flag = true;
  }
  if (asignatura.value == "" || asignatura.value == null) {
    document.getElementById("asignaturaMessage").innerText =
      "El valor no puede ser nulo";
    flag = true;
  } else {
    document.getElementById("asignaturaMessage").innerText = "";
  }
  if (alumno.value == "" || alumno.value == null) {
    document.getElementById("alumnoMessage").innerText =
      "El valor no puede ser nulo";
    flag = true;
  } else {
    document.getElementById("alumnoMessage").innerText = "";
  }
  if (fecha.value == "" || fecha.value == null) {
    document.getElementById("FechaMessage").innerText =
      "El valor no puede ser nulo";
    flag = true;
  }
  /* llama al servidor */
  if (!flag) {
    // Setea una variable para obtener el formulario
    const frm = document.getElementById("frmInsercionAusencia");

    const valueController = document.createElement("input");
    valueController.name="Controller";
    valueController.type="hidden";
    valueController.value = "FaltaAsistencia";

    frm.appendChild(valueController);

    // envia el formulario al servidor
    frm.submit();
  }
}

function onDeleteElement(event) {
  // creación de formulario
  const frm = document.createElement("form");
  frm.action = "index.php";
 
  const intPutmp1 = document.createElement("input");
  intPutmp1.name = "action";
  intPutmp1.value = "setBorrarFaltas";
 
  const inputId = document.createElement("input");
  inputId.name = "id";
 
  const valueId = document.getElementById("objId").innerText;
  console.log(`id ausencia: ${valueId}`);
  inputId.value = valueId;
 
  const valueController = document.createElement("input");
  valueController.name="Controller";
  valueController.type="hidden";
  valueController.value = "FaltaAsistencia";

  frm.appendChild(valueController);
  frm.appendChild(intPutmp1);
  frm.appendChild(inputId);
  frm.style.display = "none";
  document.body.appendChild(frm);
  frm.submit();
}


function editData() {  
  const id = document.getElementById("id");
  const alumno = document.getElementById("alumno_id");
  const asignatura = document.getElementById("asignatura_id");
  const fecha = document.getElementById("fecha");
  const justificada = document.getElementById("justificada");

  let flag = false;

  console.log(
    ` - ${alumno.value} -${asignatura.value} -${fecha.value} - ${justificada.value}`
  );

  /* valudaciones de nulos */
  if (alumno.value == "" || alumno.value == null) {
    document.getElementById("alumnoMessage").innerText =
      "El valor no puede ser nulo";
    flag = true;
  }
  if (asignatura.value == "" || asignatura.value == null) {
    document.getElementById("asignaturaMessage").innerText =
      "El valor no puede ser nulo";
    flag = true;
  } else {
    document.getElementById("asignaturaMessage").innerText = "";
  }
  if (alumno.value == "" || alumno.value == null) {
    document.getElementById("alumnoMessage").innerText =
      "El valor no puede ser nulo";
    flag = true;
  } else {
    document.getElementById("alumnoMessage").innerText = "";
  }
  if (fecha.value == "" || fecha.value == null) {
    document.getElementById("FechaMessage").innerText =
      "El valor no puede ser nulo";
    flag = true;
  }
  /* llama al servidor */
  if (!flag) {
    const frm = document.getElementById("frmEdicionAusencia");

    const valueController = document.createElement("input");
    valueController.name="Controller";
    valueController.type="hidden";
    valueController.value = "FaltaAsistencia";

    frm.appendChild(valueController);

    frm.submit();
  }
}
