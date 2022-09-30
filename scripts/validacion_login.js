function validarFormulario(){
    let enviar=false;
    enviar=validacionUsuario();
    if(enviar==false){
        return false;
    }
    enviar=validacioncontraseña();
    return enviar;
    //Validacion pendiente para ver si existe el usuario
}

function validacionUsuario(){
    let nombre=document.getElementById("caja_usuario").value;
    let validado=false;
    if(! nombre == "" && /[a-zA-Z]+(\^[a-zA-Z]+)*$/g.test(nombre)){
        //alert("Nombre correcto");
        validado = true;
    }else{
        if(nombre.length==0){
            alert("Campo Nombre esta vacio por favor llenalo");
            validado=false;
        }else{
        alert("Campo Nombre contiene caracteres invalidos solo acepta letras");
        validado=false;
        }
    }
    return validado;
}

function validacioncontraseña(){
    let contra=document.getElementById("caja_contra").value;
    let validado=false;
    if(contra.length>=8){
        validado=true;
    }else{
        alert("La contraseña debe de tener por lo menos 8 caracteres");
        return false;
    }
    return validado;
}