function validarFormularioEmbarazo(){

    const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;

    let nm = document.getElementById("txt_nombre_madre");
    let np = document.getElementById("txt_nombre_partera")

    if(/\d/.test(nm) || /\d/.test(np) || specialChars.test(np) || specialChars.test(nm)){
        alert('Los campos de texto de nombre no pueden tener numeros');
        return false;
    }

    return true;

}


function validacionNombre(componente){

    let dato = componente.value;

    if(!isNaN(dato)){
        document.getElementById("txt_nombre_madre").value="";
    }

}


function validacionNombre2(componente){

    let dato = componente.value;

    if(!isNaN(dato)){
        document.getElementById("txt_nombre_partera").value="";
    }

}
