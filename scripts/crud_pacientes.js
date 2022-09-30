function validarFormulario(){

    let nom = document.getElementById("txt_nom");
    let am = document.getElementById("txt_ap_materno");
    let ap = document.getElementById("txt_ap_paterno");
    let nt = document.getElementById("txt_nom_tel");
    let se = document.getElementById("txt_sexo");
    let dir = document.getElementById("txt_dir");

    if(nom.value=='' || am.value=='' || ap.value=='' || nt.value=='' || se.value=='' || dir.value==''){
        alert('No puede haber campos vacios');
        return false;
    }

    if(/\d/.test(nom) || /\d/.test(am) || /\d/.test(ap)){
        alert('Los campos de texto nombre y apellidos no pueden tener numeros o caracteres especiales');
        return false;
    }

    return true;

}

function validacionApMaterno(componente){

    let dato = componente.value;

    if(!isNaN(dato)){
        document.getElementById("txt_ap_materno").value="";
        alert("No puedes incluir numeros el campo de apellido materno");
    }

}

function validacionSexo(componente){

    let dato = componente.value;

    if(!isNaN(dato)){
        document.getElementById("txt_sexo").value="";
        alert("No puedes incluir numeros el campo de nombre");
    }

}

function validacionNombre(componente){

    let dato = componente.value;

    if(!isNaN(dato)){
        document.getElementById("txt_nom").value="";
        alert("No puedes incluir numeros el campo de nombre");
    }

}


function validacionApPaterno(componente){

    let dato = componente.value;

    if(!isNaN(dato)){
        document.getElementById("txt_ap_paterno").value="";
        alert("No puedes incluir numeros el campo de apellido paterno");
    }
}


function validacionNoTel(componente){

    let dato = componente.value;

    if(isNaN(dato)){
        document.getElementById("txt_num_tel").value="";
        alert("No puedes incluir numeros el campo de apellido paterno");
    }
}
