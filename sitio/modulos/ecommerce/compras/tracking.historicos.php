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
// tracking historico
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
$idpedido=$_REQUEST['idpedido'];
$idclientepago=$_REQUEST['idclientepago'];
$id=$_REQUEST['id'];
$idestado=$_REQUEST['idestado'];
$dsestado=$_REQUEST['dsestado'];
$r=$_REQUEST['r'];
$rutax="tracking.php";
if ($r==1) $rutax="default.php";

?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<?
// generacion del encabezado de acuerdo a los resultados encontrados

$rutamodulo="<a href='../../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>Compras</a>  /  <span class='text1'>Tracking Historicos para $idpedido </span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
?>
<table width="100%" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td align="center" valign="top" class="fondo"><br />
  <input type=button name=enviar value="REGRESAR"  class="botones" onClick="irAPaginaD('<? echo $rutax?>?idpedido=<? echo $idpedido?>&idclientepago=<? echo $idclientepago?>&id=<? echo $id;?>&idestado=<? echo $idestado;?>&dsestado=<? echo $dsestado;?>')">
    </td>
   </tr> 
</table>

<? include("tracking.historicos.cuerpo.php");?></div>
<br>
<?	include("../../../incluidos_modulos/navegador.principal.cerrar.php"); 
include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>