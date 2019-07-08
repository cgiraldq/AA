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
  Juan Fernando Fernandez <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sanchez <graficoweb@comprandofacil.com> - Diseno
  Jose Fernando Pena <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- | 
*/
// procesos de cambios de estos en un pedido
$idclientepago=$_REQUEST['idclientepago'];
$id=$_REQUEST['id'];
$idpedido=$_REQUEST['idpedido'];

if($_REQUEST['idconfirmar']==1){
	// actualizar a 1 el estado de ecommerce_tblpagos
	$sql="update ecommerce_tblpagos set idestado=2 where id=".$id;//el de la tabla
	//echo $sql;
	//exit;
		$db->Execute($sql);
	// cuerpo del correo
	$titulo="SU PEDIDO HA SIDO CONFIRMADO";
	include ("proceso.pago.formatocorreo.compras.php");
  $asuntocf="Se ha generado una confirmacion compra desde  ".$autorizado;
  $asuntocorreocliente="Su pedido ha sido confirmado desde  ".$autorizado;
  $mensajes=" <strong>Pedido $idpedido Confirmado</strong>";

}

if($_REQUEST['despachar']==1){
	$dsfechat=$_REQUEST['dsfechat'];
	$dsfechad=$_REQUEST['dsfechad'];
	$dsd=$_REQUEST['dsd'];
	$dsnum_guia=$_REQUEST['dsnum_guia'];
	
	$sql=" update ecommerce_tblpagos set ";
	$sql.=" idestado=3";
	$sql.=" ,dsfechat='$dsfechat'";	
	$sql.=" ,dsfechad='$dsfechad'";
	$sql.=" ,dsd='$dsd'";
	$sql.=" ,dsnum_guia='$dsnum_guia'";

	$sql.=" where id=".$id;
	//
	//echo $sql;
	//exit;
		$db->Execute($sql);
    $mensajes=" <strong>Pedido $idpedido Hacia direccion de entrega</strong>";

	// cuerpo del correo
  $titulo="SU PEDIDO SE ENCUENTRA EN TRANSITO HACIA LA DIRECCION DE ENTREGA";
  include ("proceso.pago.formatocorreo.despacho.php");
  $asuntocf="Se ha generado un  correo de aviso de despacho pedido $idpedido hacia direccion de entrega desde  ".$autorizado;
  $asuntocorreocliente="Notificacion de transito hacia su direccion de entrega de su pedido $idpedido desde  ".$autorizado;
}
//rechazar
if($_REQUEST['Rechazar']==1){
  $dscausa_r=$_REQUEST['dscausa_r'];
  $dscausa_r=preg_replace("/\n/", "<br>",$dscausa_r);
  $dsfechar=$_REQUEST['dsfechar'];
  //
  $sql=" update ecommerce_tblpagos set ";
  $sql.=" idestado=4";
  $sql.=" ,dscausa_r='$dscausa_r'"; 
  $sql.=" ,dsfechar='$dsfechar'";
  $sql.=" where id=".$id;
  //echo $sql;
   $db->Execute($sql);
   $mensajes=" <strong>Pedido $idpedido Rechazado</strong>";

  // cuerpo del correo
  $titulo="SU PEDIDO HA SIDO RECHAZADO";
  include ("proceso.pago.formatocorreo.rechazado.php");
  $asuntocf="Se ha generado un rechazo de compra desde  ".$autorizado;
  $asuntocorreocliente="Su pedido ha sido rechazado desde  ".$autorizado;
}

if($_REQUEST['Bodega']==1){
//  exit;
  // actualizar a 1 el estado de ecommerce_tblpagos
  $dscausa_r=$_REQUEST['dscausa_r'];
  $dscausa_r=preg_replace("/\n/", "<br>",$dscausa_r);
  $dsfechar=$_REQUEST['dsfechar'];
  
  // cuerpo del correo
  $titulo="SU PEDIDO SE ENCUENTRA EN NUESTRAS BODEGAS DE MIAMI";
  include ("proceso.pago.formatocorreo.bodega.php");

  $sql=" update ecommerce_tblpagos set ";
  $sql.=" idestado=6";
  $sql.=" ,dscausa_b='$dscausa_r'"; 
  $sql.=" ,dsfecha_b='$dsfechar'";
  $sql.=" where id=".$id;
  $db->Execute($sql);
  $mensajes=" <strong>Pedido $idpedido en bodega de miami</strong>";

  $asuntocf="Se ha generado un correo de aviso de llegada a bodega miami de pedido $idpedido en ".$autorizado;
  $asuntocorreocliente="Notificacion de arribo su pedido $idpedido a nuestras bodegas en miami ".$autorizado;
}

if($_REQUEST['BodegaCol']==1){
//  exit;
  // actualizar a 1 el estado de ecommerce_tblpagos
  $dscausa_r=$_REQUEST['dscausa_r'];
  $dscausa_r=preg_replace("/\n/", "<br>",$dscausa_r);
  $dsfechar=$_REQUEST['dsfechar'];
  
  // cuerpo del correo
  $titulo="SU PEDIDO SE ENCUENTRA EN NUESTRAS BODEGAS DE COLOMBIA";
  include ("proceso.pago.formatocorreo.bodega.php");

  $sql=" update ecommerce_tblpagos set ";
  $sql.=" idestado=9";
  $sql.=" ,dscausa_bc='$dscausa_r'"; 
  $sql.=" ,dsfecha_bc='$dsfechar'";
  $sql.=" where id=".$id;
  $db->Execute($sql);
  $mensajes=" <strong>Pedido $idpedido en bodega de colombia</strong>";

  $asuntocf="Se ha generado un correo de aviso de llegada a bodega colombia de pedido $idpedido en ".$autorizado;
  $asuntocorreocliente="Notificacion de arribo su pedido $idpedido a nuestras bodegas en colombia ".$autorizado;
}


if($_REQUEST['tiendamiami']==1){
//  exit;
  // actualizar a 1 el estado de ecommerce_tblpagos
  $dscausa_r=$_REQUEST['dscausa_r'];
  $dscausa_r=preg_replace("/\n/", "<br>",$dscausa_r);
  $dsfechar=$_REQUEST['dsfechar'];
  
  // cuerpo del correo
  $titulo="SU PEDIDO SE ENCUENTRA EN TRANSITO DESDE LA TIENDA HACIA NUESTRAS BODEGAS EN MIAMI";
  include ("proceso.pago.formatocorreo.bodega.php");

  $sql=" update ecommerce_tblpagos set ";
  $sql.=" idestado=7 ";
  $sql.=" ,dscausa_tm='$dscausa_r'"; 
  $sql.=" ,dsfecha_tm='$dsfechar'";
  $sql.=" where id=".$id;
  $db->Execute($sql);
  $mensajes=" <strong>Pedido $idpedido desde tienda hacia bodega de miami</strong>";

  $asuntocf="Se ha generado un correo de aviso transito de tienda hacia bodega en miami de pedido $idpedido en ".$autorizado;
  $asuntocorreocliente="Notificacion de transito desde tienda hacia bodega en miami de su pedido $idpedido  ".$autorizado;
}
if($_REQUEST['miamicolombia']==1){
//  exit;
  // actualizar a 1 el estado de ecommerce_tblpagos
  $dscausa_r=$_REQUEST['dscausa_r'];
  $dscausa_r=preg_replace("/\n/", "<br>",$dscausa_r);
  $dsfechar=$_REQUEST['dsfechar'];
  
  // cuerpo del correo
  $titulo="SU PEDIDO SE ENCUENTRA EN TRANSITO NUESTRAS BODEGAS EN MIAMI HACIA COLOMBIA";
  include ("proceso.pago.formatocorreo.bodega.php");

  $sql=" update ecommerce_tblpagos set ";
  $sql.=" idestado=8 ";
  $sql.=" ,dscausa_mc='$dscausa_r'"; 
  $sql.=" ,dsfecha_mc='$dsfechar'";
  $sql.=" where id=".$id;
  $db->Execute($sql);
  $mensajes=" <strong>Pedido $idpedido desde bodega de miami a colombia</strong>";

  $asuntocf="Se ha generado un correo de aviso transito de bodega en miami hacia bodega de pedido $idpedido en ".$autorizado;
  $asuntocorreocliente="Notificacion de transito desde bodega en miami hacia colombia de su pedido $idpedido  ".$autorizado;
}


if($_REQUEST['entregado']==1){
//  exit;
  // actualizar a 1 el estado de ecommerce_tblpagos
  $dscausa_r=$_REQUEST['dscausa_r'];
  $dscausa_r=preg_replace("/\n/", "<br>",$dscausa_r);
  $dsfechar=$_REQUEST['dsfechar'];
  
  // cuerpo del correo
  $titulo="SU PEDIDO FUE ENTREGADO";
  include ("proceso.pago.formatocorreo.bodega.php");

  $sql=" update ecommerce_tblpagos set ";
  $sql.=" idestado=10 ";
  $sql.=" ,dscausa_e='$dscausa_r'"; 
  $sql.=" ,dsfecha_e='$dsfechar'";
  $sql.=" where id=".$id;
  $db->Execute($sql);
  $mensajes=" <strong>Pedido $idpedido entregado</strong>";

  $asuntocf="Se ha generado un correo de aviso de entrega de pedido $idpedido en ".$autorizado;
  $asuntocorreocliente="Notificacion de entrega de su pedido $idpedido  ".$autorizado;
}

// eliminacion
$idx=$_REQUEST['idx'];

if ($idx<>"") { 
  $idpedidox=$_REQUEST['idpedidox'];

	$sql=" delete from $tabla WHERE id='$idx' ";
	if ($db->Execute($sql))  { 
		$mensajes="<strong>".$men[3]."</strong>";
    $sql=" delete from ecommerce_tblcompras WHERE idpedido='$idpedidox' ";
		$db->Execute($sql);
    $dstitulo="Eliminacion $titulomodulo";
		$dsdesc=" El usuario ".$_SESSION['i_dslogin']." elimino registro de $titulomodulo";
		$dsruta="../compras/default.php";
		include("../../incluidos_modulos/logs.php");
		
	}	
}
// envio generico de correos
    include("default.procesos.enviocorreo.php");
// fin envio generico de correos
?>