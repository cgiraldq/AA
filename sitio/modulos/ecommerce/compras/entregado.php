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
// pedido desde miami a colombia
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

$titulomodulo="Pedido entregado";
$rr="default.php";
$idclientepago=$_REQUEST['idclientepago'];
$id=$_REQUEST['id'];
$idpedido=$_REQUEST['idpedido'];
$tabla="ecommerce_tblpagos";			

$txtbase="
Apreciado Sr(a) -Nombre-
Cordial Saludo,

El presente mensaje es con fin de notificarle el pedido con referencia -Idpedido- fue entregado en la direccion de destino.

";

// $db->debug=true;
$sql="select a.idpedido,a.dsfechalarga,dscausa_e,dsfecha_e from $tabla a where ";//and idestado<>0";
$sql.=" id=".$id;

  $result=$db->Execute($sql);
  if(!$result->EOF){

  $idpedido=reemplazar($result->fields[0]);
  $dsfechalarga=reemplazar($result->fields[1]);
  $dscausa_r=($result->fields[2]);
  if ($dscausa_r=="") $dscausa_r=$txtbase;
  $dsfechar=($result->fields[3]); // valor venta

} else{

}
$result->Close();				
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

$rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include("../../incluidos_modulos/modulos.subencabezado.php");
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
<form action="default.php" method=post name=u enctype="multipart/form-data">

<tr valign=top bgcolor="#FFFFFF">
<td>Numero de pedido:</td>
<td>
<? echo $idpedido?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Cuerpo del correo</td>
<td>
<? $contadorx="dscausa_r_counter";$valorx="1000";$campox="dsd";$cantidad=strlen($dscausa_r)?>
<textarea name=dscausa_r cols=80  rows="15" class=text1 onKeyPress="ocultar('capa_dscausa_r')" <? include("../../incluidos_modulos/control.evento.php");?>><? echo $dscausa_r?></textarea>
<?
$nombre_capa="capa_dscausa_r";
$mensaje_capa="Debe ingresar la descripci&oacute;n corta destacada";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Fecha de notificacion en bodega:</td>
<td>
<? $contadorx="dsfechar_counter";$valorx="20";$formax="u";$campox="dsfechar";$cantidad=strlen($dsfechar)?>
<input type=text name=dsfechar size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechar')" readonly  value="<? echo $dsfechar?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<img align="absmiddle" SRC="../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechar', this);" language="javaScript">	
<?
$nombre_capa="capa_dsfechar";
$mensaje_capa="Debe ingresar la fecha de despacho";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>



<tr><td align="center" colspan="2" background="../../img_modulos/cf_diseno_r2_c2.jpg">
<?
$forma="u";
$param="dsfechar";
include("../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idclientepago" value="<? echo $idclientepago?>">
<input type="hidden" name="id" value="<? echo $id?>">
<input type="hidden" name="idpedido" value="<? echo $idpedido?>">

<input type="hidden" name="idcliente" value="<? echo $idpago?>">

<input type="hidden" name="miamicolombia" value="1">
</td></tr>
</form>

</table>
<br>

</td>
</tr>
</table>

<br>
<? include("../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>