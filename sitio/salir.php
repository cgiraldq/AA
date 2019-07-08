<?
/*
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
 Salida Generica
*/

session_start();

if ($_REQUEST['salir']==""){
	$_SESSION['idcomprador']="";
	$_SESSION['dsfechacompra']="";
	$_SESSION['ipremota']="";

}
if ($_REQUEST['salir']=="1") session_destroy();
	if($_REQUEST['rr']<>"1"){
	header("Location: index.php");}
	else{
		if($_SESSION['i_idcodigodis']<>""){
		header("Location: zona.distribuidor.php#historial");
		}else{
		header("Location: zona.privada.php");
		}


	}

?>
