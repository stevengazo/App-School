"use strict";

/**
 * Use it to Validate the data in the creating form 
 */
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

function onEdit() {
  const idInput = document.getElementById("id").value;
  const asignatura_has_alumnoInput = document.getElementById(
    "asignatura_has_alumno_id"
  ).value;
  const trimestreInput = document.getElementById("trimestre").value;
  const notaInput = document.getElementById("nota").value;
  let flagValid = true;
  if (
    asignatura_has_alumnoInput === null ||
    asignatura_has_alumnoInput === ""
  ) {
    document.getElementById(
      "AsignaturaMessage"
    ).innerText = `Verifica el valor`;
    flagValid = false;
  } else {
    document.getElementById("AsignaturaMessage").innerText = ``;
    flagValid = true;
  }
  if (trimestreInput === null || trimestreInput === "") {
    document.getElementById("trimestreMessage").innerText = `Verifica el valor`;
    flagValid = false;
  } else {
    document.getElementById("trimestreMessage").innerText = ``;
    flagValid = true;
  }
  if (notaInput === null || notaInput === 0) {
    document.getElementById(
      "NotaMessage"
    ).innerText = `Verifique el valor existente`;
    flagValid = false;
  } else {
    document.getElementById("NotaMessage").innerText = ``;
    flagValid = true;
  }
  // send the data to the controller
  if(flagValid){
    const formGroup = document.getElementById("frmEditarNota");
    formGroup.submit();
    alert("enviando");
  }
}


