function envioFormulario(){
    let enviar=false;
    //enviar=validacionUsuario();
    //enviar=validacionNombre();
    enviar=validacioncontraseña();
    return enviar;
}


function validacionUsuario(){
    let nombre=document.getElementById("caja_usuario").value;
    let validado=false;
    if(! nombre == "" && /[a-zA-Z]+(\^[a-zA-Z]+)*$/g.test(nombre)){
        validado = true;
    }else{
        alert("Campo usuario contiene caracteres invalidos solo acepta letras");
        validado=false;
    }
    alert("El validado es: "+validado)
    return validado;
}

function validacionNombre(){
    let nombre=document.getElementById("caja_nombre").value;
    let validado=false;
    if(! nombre == "" && /[a-zA-Z]+(\^[a-zA-Z]+)*$/g.test(nombre)){
        //alert("Nombre correcto");
        validado = true;
    }else{
        alert("Campo Nombre contiene caracteres invalidos solo acepta letras");
        return false;
    }
    return validado;
}

function validacioncontraseña(){
    let contra=document.getElementById("caja_contraseña").value;
    let validado=false;
    if(contra.length>=8){
        validado=true;
    }else{
        alert("La contraseña debe de tener por lo menos 8 caracteres");
        return false;
    }
    return validado;
}