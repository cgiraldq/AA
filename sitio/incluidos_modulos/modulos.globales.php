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
*/
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/sessiones.php");
include($rutxx."../../incluidos_modulos/version.php");
include($rutxx."../../incluidos_modulos/comunes.php");
include($rutxx."../../incluidos_modulos/varconexion.php");
//include($rutxx."../../incluidos_modulos/sql.injection.modulos.php");
include($rutxx."../../incluidos_modulos/varmensajes.php");
include($rutxx."../../incluidos_modulos/modulos.funciones.php");
include($rutxx."../../incluidos_modulos/class.rc4crypt.php");
include($rutxx."../../incluidos_modulos/bloqueo.ip.php");
include($rutxx."../../incluidos_modulos/modulos.calendario.php");
include($rutxx."../../incluidos_modulos/validacion.campos.php");
$partipag=explode("/",$_SERVER['SCRIPT_FILENAME']);
$total=count($partipag);
if($partipag[$total-3]=="crm" || $partipag[$total-3]=="gestor"){
include($rutxx."../../incluidos_modulos/validacion.campos.php");
$prefix="framecf_";
}
$funciones=new FuncionesGenerales();
$pagina=$_SERVER["PHP_SELF"];
?>
