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
$rr="formularios.campos.agrupar.php?idxx=".$_REQUEST["idxx"];
$idx=$_REQUEST['idx'];
$dsagupamiento=seldato("dsm","id"," framecf_tbltiposformulariosxcamposxagrupamiento",$idx,2);
$titulomodulo="Agrupamiento ( $dsagupamiento )";


$tablarelaciones="tblagrupamientoxtblformularios";
$tablaorigen=" framecf_tbltiposformulariosxcampo";
$tablarelacionesxtemas="tblagrupamientoxtblformulariosxtemasxagrupados";


$idxx=$_REQUEST['idxx'];
$posicion=1;
include($rutxx."../relaciones/relaciones.operaciones.agrupamiento.php");
?>
<html>
 <?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

  <? include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados

$totalregistros=$result->RecordCount();
	$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.="  <a href='$rutxx../crm/formularios/default.php' target='_top' class='textlink'>Listado de formularios </a>  /  ";
	$rutamodulo.="<a href='$rutxx../crm/formularios/formularios.campos.agrupar.php?idxx=$idxx' class='textlink' target='_top' title='Agrupamiento de campos del fomulario'>Agrupamiento de campos del fomulario</a>";
	$rutamodulo.=" / <span class='text1'>$titulomodulo</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");


?>
<br>
<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


  <table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>?idx=<? echo $idx;?>" method=post name=u enctype="multipart/form-data">

<tr valign=top bgcolor="#FFFFFF">
<td colspan="2">
<strong>RELACIONES.</strong> Agrupe los campos a el formulario:

<?
$idposx=1;
if($idxx==104){
$validar=" where idactivo=1 and dscampo!='dscampo2' and idtipoformulario=".$_REQUEST["idxx"];
}else{
  $validar=" where idactivo=1 and idtipoformulario=".$_REQUEST["idxx"];
}


include($rutxx."../relaciones/default.agrupamiento.php");?>
</td>
</tr>


<tr><td align="center" colspan="2" background="../../img_modulos/cf_diseno_r2_c2.jpg">
<?
$forma="u";
$param="id";
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idx" value="<? echo $idx?>">
<input type="hidden" name="idxx" value="<? echo $_REQUEST['idxx']?>">

</td></tr>
</form>

</table>
<br>

</td>
</tr>
</table>

<br>
<?
 include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>