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
//exit();
$rutax=$_REQUEST['rutax'];
$ir=$_REQUEST['ir'];

if($_SESSION['i_idperfil']==2 || $_SESSION['i_idperfil']==3){
$rutax="../../index.php";
 }
session_destroy();
?>
<html>
<head>
<title><? echo $AppNombre;?></title>
<script language="javascript">
<!--
<? if ($rutax<>"") { ?>
	location.href="<? echo $rutax?>";	
<? } else { ?>
location.href="../admon/default.php?mensaje=3";
<? } ?>
//-->
</script>
?>
</head>
<body color=#ffffff  topmargin=10 leftmargin=0 class=text1></body></html>