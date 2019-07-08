
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
// edicion de datos
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

//$rc4 = new rc4crypt();
//$db->debug=true;
$rr="default.php";
$titulomodulo="Configuraci&oacute;n de p&aacute;ginas x formularios";
$tablarelaciones="tblpaginasxtblformularios";
$tablaorigen=" framecf_tbltiposformularios";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla=" framecf_tbltiposformularios";
include($rutxx."../relaciones/relaciones.operaciones.php");
?>
<html>
 <?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

  <? include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm";
$sql.=" from $tabla a ";
$sql.=" where a.idpublicar=1 ";

//echo $sql;

$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
	$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.="  <a href='default.php' target='_top' class='textlink'>Listado de p&aacute;ginas </a>  /  <span class='text1'>$titulomodulo</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];

?>
<br>
<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


  <table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>?idx=<? echo $idx;?>" method=post name=u enctype="multipart/form-data">

<tr valign=top bgcolor="#FFFFFF">
<td colspan="2">
<strong>RELACIONES.</strong> Asocie el formularios a las p&aacute;ginas:
<br><strong>*Para algunas p&aacute;ginas no aplican los formularios</strong><br>
<?
$validar=" where idpublicar=1 and idactivo=1";
include($rutxx."../relaciones/default.php");?>
</td>
</tr>


<tr><td align="center" colspan="2" background="../../img_modulos/cf_diseno_r2_c2.jpg">
<?
$forma="u";
$param="id";
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idx" value="<? echo $idx?>">

</td></tr>
</form>

</table>
<br>

</td>
</tr>
</table>
<?
} // fin si
$result->Close();
?>
<br>
<?
 include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>