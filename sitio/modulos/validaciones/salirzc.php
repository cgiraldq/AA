<?
/*
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
 Salida Generica
*/
session_start();
session_destroy();
//exit();
$rutax="../../index.php";
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