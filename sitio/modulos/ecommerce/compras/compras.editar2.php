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
// edicion de datos
include("../../incluidos_modulos/version.php");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/sessiones.php");
include("../../incluidos_modulos/varmensajes.php");
include ("../../incluidos_modulos/modulos.calendario.php");
include("../../incluidos_modulos/class.rc4crypt.php");
include("../../incluidos_modulos/bloqueo.ip.php");

$titulomodulo="Configuracion de Compras";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="ecommerce_tblcompras";

if($_REQUEST['paso']==1){
 $sql="update ecommerce_tblcompras set idestado=2 where id=".$idx;
 $db->Execute($sql);
}			

					
?>
<html>
<head>
	<title><? echo $AppNombre;?></title>
<? include("../../incluidos_modulos/sub.encabezado.php");?>
</head>
<body color=#ffffff  topmargin=0 leftmargin=0>
<?
include("../../incluidos_modulos/modulos.encabezado.php");
include("../../incluidos_modulos/modulos.mensajes.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.idproducto,a.idcolor,a.dstamanio,a.dstipo,a.campo1,a.campo2,a.campo3,a.campo4,a.campo5,a.campo6,a.idestado,a.idtipocomp,";
$sql.="idciudad,idprecio from $tabla a ";
$sql.=" where a.id=$idx ";
//echo $sql;

$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include("../../incluidos_modulos/modulos.subencabezado.php");
$idproducto=$result->fields[0];
$idcolor=$result->fields[1];
$dstamanio=$result->fields[2];
$dsversion=$result->fields[3];
$campo1=$result->fields[4];
$campo2=$result->fields[5];
$campo3=$result->fields[6];
$campo4=$result->fields[7];
$campo5=$result->fields[8];
$campo6=$result->fields[9];
$idestado=$result->fields[10];
$tipocomp=$result->fields[11];
$idciudad=$result->fields[12];
$precio=$result->fields[13];
?>

<br>

<table width="100%" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td align="center" valign="top" class="fondo"><br />


<table width="70%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="6" align="left" valign="top"><img src="../../img_modulos/modulos/titulo_r1_c1.jpg" width="6" height="22" /></td>
          <td width="615" align="left" valign="middle" background="../../img_modulos/modulos/franja_grisoscuro_r1_c2.jpg" class="titulo_negro">Edicion del registro seleccionado</td>
        </tr></table> 

<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="text1" bgcolor="#CCCCCC">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">


<tr valign=top bgcolor="#FFFFFF">
<td>Producto</td>
<td>
<?
if($tipocomp==1){ 
$query="select dsm from tblproductos where id=".$idproducto;
}else{
$query="select dsm from tblaccesorios where id=".$idproducto;
}
$result1=$db->Execute($query);
 if(!$result1->EOF){
?>
<span><? echo $result1->fields[0];?></span>
<? }?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Color</td>
<td>
<?
if($idcolor=="")$idcolor=0;
if($tipocomp==1){
$query1="select dsm from tblcoloresprod where id=".$idcolor;
}else{
$query1="select dsm from tblcoloresacc where id=".$idcolor;
}
$result2=$db->Execute($query1);
 if(!$result2->EOF){
?>
<span><? echo $result2->fields[0];?></span>
<? }?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Tama&ntilde;o</td>
<td>
<span><? echo $dstamanio?></span>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Versi&oacute;n</td>
<td>
<span><? echo $dsversion?></span>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Ciudad</td>
<?
$query="select dsciudad,idvalor from tblfletes where id=".$idciudad;
  $resultq=$db->Execute($query);
   if(!$resultq->EOF){
    $ciudad=$resultq->fields[0];
    $valorfl=$resultq->fields[1];
?>
<td>
<span><? echo $ciudad?></span>
</td>
<?
}$resultq->Close();
?>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Valor flete:</td>
<td>
<span><? echo number_format($valorfl)?></span>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Precio:</td>
<td>
<span><? echo number_format($precio)?></span>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Precio Total:</td>
<td>
<span><? echo number_format($precio+$valorfl)?></span>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td colspan="2" align="center"><strong>Campos para asignar a la manilla</strong></td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Campo 1</td>
<td>
<span><? echo $campo1?></span>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Campo 2</td>
<td>
<span><? echo $campo2?></span>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Campo 3</td>
<td>
<span><? echo $campo3?></span>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Campo 4</td>
<td>
<span><? echo $campo4?></span>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Campo 5</td>
<td>
<span><? echo $campo5?></span>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Campo 6</td>
<td>
<span><? echo $campo6?></span>
</td>
</tr>

<tr><td align="center" colspan="2" background="../../img_modulos/cf_diseno_r2_c2.jpg">
<?
$forma="u";
$param="idx";
if($idestado==1)$modif=2;
else $modif=3;
include("../../incluidos_modulos/botones.modificar.php");?>
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
<? include("../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>