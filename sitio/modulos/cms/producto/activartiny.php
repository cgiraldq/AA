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
  Juan Fernando Fern�ndez <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe S�nchez <graficoweb@comprandofacil.com> - Dise�o
  Jos� Fernando Pe�a <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// exportar pero con formato de importacion para verificacion de cargas

$tiny="Activar editor de texto";



if($_REQUEST["tiny"]=="Activar editor de texto") {
include("../../tiny/tinymce.php");
$tiny="Desactivar editor de texto";

}else{

}


?>


<input type="submit" name=tiny value="<? echo $tiny;?>"  class="botones" >
