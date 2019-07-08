<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- | 
Botoneria generica de modificacion
*/
$validacion="valU('$forma','$param')";
?>
<input type=button name=enviar value="<? echo $tituloboton?>"  class="botones" onClick="<? echo $validacion;?>">
<input type=button name=enviar value="Regresar"  class="botones" onClick="irAPaginaD('<? echo $rr?>')">



