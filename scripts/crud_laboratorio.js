function validacionNumero(componente){

    let dato = componente.value;

    if(isNaN(dato)){
        document.getElementById("txt_id_paciente").value="";
        alert("No puedes incluir letras en el campo de ID");
    }

}

function validacionEdad(componente){

    let dato = componente.value;

    if(isNaN(dato)){
        document.getElementById("txt_id_paciente").value="";
        alert("No puedes incluir letras en el campo de ID");
    }

}


function validacionAnalisis(componente){

    let dato = componente.value;

    if(!isNaN(dato)){
        document.getElementById("txt_tipo_analisis").value="";
        alert("No puedes incluir numeros el campo de analisis");
    }

}

function validacionFormulario(){

    let tipo_analisis = document.getElementById("txt_tipo_analisis");
    let id_paciente = document.getElementById("txt_id_paciente");

    if(tipo_analisis.value=='' || id_paciente.value==''){
        alert('No pueden haber campos vacios');
        return false;
    }else{
        return true;
    }

}
