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
$idpedido=$_REQUEST['idpedido'];
$titulomodulo="Novedades para el pedido $idpedido";
$rr="default.php";
$idclientepago=$_REQUEST['idclientepago'];
$id=$_REQUEST['id'];
$tabla="ecommerce_tblpagos_novedades";			
if ($_REQUEST['paso']=="1") {
    $dscausa_b=$_REQUEST['dscausa_r'];
    $dsfecha_b=$_REQUEST['dsfechar'];

    $sql="select id ";
    $sql.=" from $tabla WHERE dscausa_b='$dscausa_b' ";
     $result = $db->Execute($sql);
     if (!$result->EOF) {
      // no insertar
      $mensajes=$men[0];
     } else { 

      // insertar
      $idcategoria=0;
      $sql="insert into $tabla (idpedido,idclientepago,dsfecha,dscausa_b,dsfecha_b)";
      $sql.=" values ($idpedido,$idclientepago,'$fechaBaseLarga','$dscausa_b','$dsfecha_b') ";
      //echo $sql;
      //exit();
      if ($db->Execute($sql))  { 
        $mensajes="<strong>".$men[1]."</strong>";
        // cargar auditoria
        $dstitulo="Insercion $titulomodulo";
        $dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro";
        $dsruta="../productos/novedades.php";
        include("../../incluidos_modulos/logs.php");
        
      } else { 
        $mensajes=$men[2].".<br><br>$sql<br>Error:".mysql_error();
      } 
     }
     $result->close();


}
  $idx=$_REQUEST['idx'];
  if ($idx<>"") { 
    $sql=" delete from $tabla WHERE id='$idx' ";
    if ($db->Execute($sql))  { 
      $mensajes="<strong>".$men[3]."</strong>";
      $dstitulo="Eliminacion $titulomodulo2";
      $dsdesc=" El usuario ".$_SESSION['i_dslogin']." elimino un registro";
      include("../../incluidos_modulos/logs.php");
    } 
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
$rutamodulo.="  <a href='default.php' class='textlink'>Compras</a>  /  <span class='text1'>$titulomodulo</span>";
include("../../incluidos_modulos/modulos.subencabezado.php");

$sql="select id,idpedido,idclientepago,dsfecha,dscausa_b,dsfecha_b from $tabla where idpedido=$idpedido and idclientepago=$idclientepago";
$sql.=" order by id desc ";
$result= $db->Execute($sql);
  if (!$result->EOF) {

include("novedades.tabla.php");
  } // fin si 
$result->Close();

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
<form action="novedades.php" method=post name=u enctype="multipart/form-data">

<tr valign=top bgcolor="#FFFFFF">
<td>Numero de pedido:</td>
<td>
<? echo $idpedido?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Novedad</td>
<td>
<? $contadorx="dscausa_r_counter";$valorx="1000";$campox="dsd";$cantidad=strlen($dscausa_r)?>
<textarea name=dscausa_r cols=80  rows="6" class=text1 onKeyPress="ocultar('capa_dscausa_r')" <? include("../../incluidos_modulos/control.evento.php");?>><? echo $dscausa_r?></textarea>
<?
$nombre_capa="capa_dscausa_r";
$mensaje_capa="Debe ingresar la descripci&oacute;n";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Fecha de novedad:</td>
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
include("../../incluidos_modulos/botones.ingresar.php");?>
<input type="hidden" name="idclientepago" value="<? echo $idclientepago?>">
<input type="hidden" name="id" value="<? echo $id?>">
<input type="hidden" name="idpedido" value="<? echo $idpedido?>">

<input type="hidden" name="paso" value="1">
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