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
  Juan Fernando Fernï¿½ndez <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sï¿½nchez <graficoweb@comprandofacil.com> - Diseï¿½o
  Josï¿½ Fernando Peï¿½a <soporteweb@comprandofacil.com> - Mercadeo
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
echo $idclientepago=$_REQUEST['idclientepago'];
$id=$_REQUEST['id'];
$idpedido=$_REQUEST['idpedido'];$tabla="ecommerce_tblpagos";			

if($_REQUEST['paso']==1){
 $dsd=$_REQUEST['dsd'];
 $dsde=$_REQUEST['dsde'];

 $sql="update ecommerce_tblcompras set idestado=3 where id=".$idx;
 echo $sql;
 exit;
 $db->Execute($sql);
  /*
  $correo=$_REQUEST['dscorreo'];		
 		if($correo<>""){
 		 
 		 $sql="select a.id,a.idproducto,a.idcolor,a.dsfecha,a.dstamanio,a.dsnombre,a.dstelefono,a.dscorreo,a.dsdireccion,a.dstipo,a.idestado";
		 $sql.=" from $tabla a where a.id=".$idx;
		 $result=$db->Execute($sql);
		
		if(!$result->EOF){
		 $dsnombre=$result->fields[5];
		 $dstelefono=$result->fields[6];
		 $dsemail=$result->fields[7];
		 $dsdireccion=$result->fields[8];
		 $producto=$_REQUEST['producto'];
		 $color=$_REQUEST['color'];
		 $dstamanio=$result->fields[4];
		 $dsversion=$result->fields[9];
		 $fechaped=$result->fields[3];
		 $fechaenvio=date("Y/m/d h:i:s");
		 		
 		$headers= "From: info@movilid.com\n";
		$headers.= "Organization: $autorizado\n";
		$headers.= "MIME-Version: 1.0\n";
		$headers.= "Content-Type: text/html; charset=iso-8859-1\n";
		//dirección de respuesta, si queremos que sea distinta que la del remitente
		$headers .= "Reply-To: $dscorreorem\r\n";

		//ruta del mensaje desde origen a destino
		$headers .= "Return-path: $dscorreorem\r\n";

 		
 		$asunto="Despacho de manilla con ".$autorizado;
		$cuerpo.="<font face='Arial' size=-1>Apreciado <strong>Cliente</strong>:<br><br>";	
		$cuerpo.="La manilla que usted ha comprado fue despachada, estos son los datos:<br>";	
		$cuerpo.="Nombre: $dsnombre<br>";
		$cuerpo.="Teléfono: $dstelefono<br>";
		$cuerpo.="Direccion: $dsdireccion<br>";
		$cuerpo.="Correo electrónico: <u>$dsemail</u><br>";
		$cuerpo.="Producto: $producto<br>";
		$cuerpo.="Color: $color<br>";
		$cuerpo.="Tamaño: $dstamanio<br>";
		$cuerpo.="Version: $dsversion<br>";
		$cuerpo.="Fecha Pedido: $fechaped<br>";
		$cuerpo.="Fecha Envio: $fechaenvio<br>";
		$cuerpo.="Observaciones: $dsd<br>";
		$cuerpo.="==============================================================<br>";	
		$cuerpo.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
		$cuerpo.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";
				
		mail($correo,$asunto,$cuerpo,$headers);
		}
	 }
	*/	
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
<td>Observaciones de envio de compra</td>
<td>
<? $contadorx="dsd_counter";$valorx="1000";$campox="dsd";$cantidad=strlen($dsd)?>
<textarea name=dsd cols=80  rows="5" class=text1 onKeyPress="ocultar('capa_dsd')" <? include("../../incluidos_modulos/control.evento.php");?>><? echo $dsd?></textarea>
<?
$nombre_capa="capa_dsd";
$mensaje_capa="Debe ingresar la descripci&oacute;n corta destacada";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Fecha de despacho:</td>
<td>
<? $contadorx="dsfechad_counter";$valorx="20";$formax="u";$campox="dsfechad";$cantidad=strlen($dsfechad)?>
<input type=text name=dsfechad size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechad')" readonly  value="<? echo $dsfechad?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<img align="absmiddle" SRC="../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechad', this);" language="javaScript">	
<?
$nombre_capa="capa_dsfechad";
$mensaje_capa="Debe ingresar la fecha de despacho";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Fecha tentativa:</td>
<td>
<? $contadorx="dsfechat_counter";$valorx="20";$formax="u";$campox="dsfechat";$cantidad=strlen($dsfechat)?>
<input type=text name=dsfechat size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechat')" readonly  value="<? echo $dsfechat?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<img align="absmiddle" SRC="../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechat', this);" language="javaScript">	
<?
$nombre_capa="capa_dsfechat";
$mensaje_capa="Debe ingresar la fecha de despacho";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Numero de guia</td>
<td>
<? $contadorx="dsnum_guia_counter";$valorx="255";$formax="u";$campox="dsnum_guia";?>
<input type=text name=dsnum_guia size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsnum_guia')" value="<? echo $dsnum_guia?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsnum_guia";
$mensaje_capa="Debe ingresar el titulo";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr><td align="center" colspan="2" background="../../img_modulos/cf_diseno_r2_c2.jpg">
<?
$forma="u";
$param="dsfechad";
include("../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idclientepago" value="<? echo $idclientepago?>">
<input type="hidden" name="id" value="<? echo $id?>">
<input type="hidden" name="idpedido" value="<? echo $idpedido?>">

<input type="hidden" name="idcliente" value="<? echo $idpago?>">

<input type="hidden" name="despachar" value="1">
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