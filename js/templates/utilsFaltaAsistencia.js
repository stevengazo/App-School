"use strict";
/*
  Descripciòn: limpia los valores en el formulario
 */
function onclickClean() {
  document.getElementById("alumno_id").value = "";
  document.getElementById("asignatura_id").value = "";
  document.getElementById("fecha").value = "";
  document.getElementById("justificada").value = "";
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
    // envia el formulario al servidor
    frm.submit();
  }
}
