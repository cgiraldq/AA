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
// Proceso generico de garantias y devoluciones
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");

$idpedido=$_REQUEST['idpedido'];
$idclientepago=$_REQUEST['idclientepago'];
$id=$_REQUEST['id'];
$tabla="ecommerce_tblpagos_gdev";

$titulomodulo="Garantias / Devoluciones para pedido $idpedido  ";
if ($_REQUEST['paso']=="1") include("tracking.gdev.proceso.php"); // proceso de envio de correo


$idx=$_REQUEST['idx'];
  if ($idx<>"") { 
    $sql=" delete from $tabla WHERE id='$idx' ";
    if ($db->Execute($sql))  { 
      $mensajes="<strong>".$men[3]."</strong>";
      $dstitulo="Eliminacion $titulomodulo2";
      $dsdesc=" El usuario ".$_SESSION['i_dslogin']." elimino un registro";
      include($rutxx."../../incluidos_modulos/logs.php");
    } 
  }



//$db->debug=true;

?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<?
// generacion del encabezado de acuerdo a los resultados encontrados

$rutamodulo="<a href='../../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Editar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
?>


<table width="100%" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td align="center" valign="top" class="fondo"><br />
  <input type=button name=enviar value="DETALLE DEL PEDIDO"  class="botones" onClick="irAPaginaDN('../../../proceso.pago.impresion.php?mostrarenlace=1&dscampo1=$dscampo1&idpedido=<? echo $idpedido; ?>&idclientepago=<? echo $idclientepago?>');">
  <input type=button name=enviar value="HISTORICOS"  class="botones" onClick="irAPaginaD('tracking.historicos.php?idpedido=<? echo $idpedido?>&idclientepago=<? echo $idclientepago?>&id=<? echo $id;?>&idestado=<? echo $idestado;?>&dsestado=<? echo $dsestado;?>')">

    </td>
   </tr> 
</table>


<?
//$db->debug=true;

$sql="select id,idpedido,idclientepago,dsfecha,dscausa_r,dsfecha_r,idestado,dstitulo_r,dsfechaenviocorreo from ecommerce_tblpagos_gdev where idpedido=$idpedido";
$sql.=" and idclientepago=$idclientepago ";
$sql.=" order by id desc ";
$result= $db->Execute($sql);
  if (!$result->EOF) {
  include("tracking.gdev.tabla.php");
}
$result->Close();

?>
<? include("tracking.gdev.ingreso.php");?>


<br>
<?
// datos del cliente
$sql="select a.id,a.dscodigousa,a.dscodigouk,a.dsnombres,a.dsapellidos";
$sql.=",a.dstelefono,a.dstelefono2,a.dsdireccion,a.dsmovil,a.dsciudad,a.dsdepartamento,a.dspais,a.dscorreocliente";
$sql.=",dstipoidentificacion,a.dsidentificacion,a.dsfechanacimiento,a.dsfecha,a.dsclave ";
$sql.=" from tblclientes a where id=$idclientepago ";

$resultx=$db->Execute($sql);
if(!$resultx->EOF){
$dscodigousa=reemplazar($resultx->fields[1]);
$dscodigouk=reemplazar($resultx->fields[2]);


$dsnombres=reemplazar($resultx->fields[3]);
$dsapellidos=reemplazar($resultx->fields[4]);
$dstelefono=reemplazar($resultx->fields[5]);
$dstelefono2=reemplazar($resultx->fields[6]);
$dsdireccion=reemplazar($resultx->fields[7]);
$dsmovil=reemplazar($resultx->fields[8]);

$dsciudad=reemplazar($resultx->fields[9]);
$dsdepartamento=reemplazar($resultx->fields[10]);

$dspais=reemplazar($resultx->fields[11]);

$dscorreocliente=reemplazar($resultx->fields[12]);
$dsidentificacion=reemplazar($resultx->fields[13]);
?>
<table width="100%" cellpadding="0" cellspacing="0" align="center"  class="cont_general">
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">


<table width="70%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
        <tr>
          <td width="615" align="left" valign="middle">
            <img src="../../../img_modulos/modulos/edicion.png">
            <h1>Datos del Cliente</h1>
          </td>
        </tr>
</table>

<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="text1" bgcolor="#CCCCCC">

<tr valign=top bgcolor="#FFFFFF">
<td>Codigo USA:</td>
<td><? echo $dscodigousa?></td>
</tr>
<tr valign=top bgcolor="#FFFFFF">
<td>Codigo UK:</td>
<td><? echo $dscodigouk?></td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Identificacion:</td>
<td><? echo $dsidentificacion?></td>
</tr>
<tr valign=top bgcolor="#FFFFFF">
<td>Nombres:</td>
<td><? echo $dsnombres?></td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Apellidos:</td>
<td><? echo $dsapellidos?></td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Telefono 1:</td>
<td><? echo $dstelefono?></td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Telefono 2:</td>
<td><? echo $dstelefono2?></td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Email:</td>
<td><? echo $dscorreocliente?></td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Nombres:</td>
<td><? echo $dsnombres?></td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Celular:</td>
<td><? echo $dsmovil?></td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Direccion:</td>
<td><? echo $dsdireccion?></td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Pais:</td>
<td><? echo $dspais?></td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Departamento:</td>
<td><? echo $dsdepartamento?></td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>ciudad:</td>
<td><? echo $dsciudad?></td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td colspan=2 align=center>
<A HREF="javascript:irAPaginaDN('../../crm/clientesregistrados/default.php?enca=1&idclientepago=<? echo $idclientepago;?>',100,100)">Editar este cliente</A>
<br>
<strong>
  (DESPUES DE EDITAR, CIERRE LA VENTANA EMERGENTE Y PRESIONE F5 O ACTUALIZAR EN ESTA PANTALLA)
</strong>
</td>
</tr>









</table>
<br>

</td>
</tr>
</table>
<br>
<?
}
$resultx->Close();


?>

<br>
<?  include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
  include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>