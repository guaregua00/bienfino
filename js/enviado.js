  var cuenta=0;

function enviado()
{ 
  if (cuenta == 0)
  {
    cuenta++;
    return true;
  }
  else 
  {
    alert("El formulario ya está siendo enviado, por favor espere un momento.");
    return false;
  }
}