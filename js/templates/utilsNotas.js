"use strict";


function onvalidation() {
  const id = document.getElementById("id");
  const asignatura_has_alumno_id = document.getElementById("asignatura_has_alumno_id");
  const asignatura_id = document.getElementById("asignaturaId");
  const trimestre = document.getElementById("trimestre");
  const nota = document.getElementById("nota");

  let flagValid = false;

  // VALIDACIONES DE NULOS
  if (asignatura_has_alumno_id.value === null || asignatura_has_alumno_id.value === "") {
    document.getElementById(
      "AsignaturaMessage"
    ).innerText = "El valor no puede ser nulo";
    flagValid = false;
  } else {
    document.getElementById("AsignaturaMessage").innerText = "";
    flagValid = true;
  }
  
  if (trimestre.value === null || trimestre.value === "") {
    document.getElementById(
      "trimestreMessage"
    ).innerText = "El valor no puede ser nulo";
    flagValid = false;
  } else {
    document.getElementById("trimestreMessage").innerText = "";
    flagValid = true;
  }
  if (nota.value === null || nota.value === "") {
    document.getElementById(
      "NotaMessage"
    ).innerText = "El valor no puede ser nulo";
    flagValid = false;
  } else {
    document.getElementById("NotaMessage").innerText = "";
    flagValid = true;
  }

if(flagValid){
    alert("enviand..o");
    var formElement = document.getElementById("frmInsertarNota");
    formElement.submit();
}

}
  