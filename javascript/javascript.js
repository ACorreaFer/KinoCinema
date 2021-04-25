function validar(formulario){
var info=document.getElementById("info");
//condicion de error
if(formulario.login.value.length<4){
    info.innerHTML="login menor de 8 caracteres "
    return false;
}
if(formulario.password.value.length<4){
  info.innerHTML="password menor de 8 caracteres "
  return false;
}
return true;
}
