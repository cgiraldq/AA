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
// procesos de envio de correos hacia el cliente
$titulo=$_REQUEST['dstitulo_b'];
$dsobs=$_REQUEST['dscausa_b'];
$fechanotificacion=$_REQUEST['dsfecha_b'];
//
$dsdiasorigen=$_REQUEST['dsdiasorigen'];
$dsdiasdestino=$_REQUEST['dsdiasdestino'];
//
$dsaprobo=$_REQUEST['dsaprobo'];
$dsnacionalizacion=$_REQUEST['dsnacionalizacion'];
//
$dsorigen=$_REQUEST['dsorigen'];
if ($dsorigen=="") $dsorigen=" Origen ";
$dsdestino=$_REQUEST['dsdestino'];
if ($dsdestino=="") $dsdestino=" Destino ";
//
$dsobs=formateo_texto($dsobs);
//
$asuntocf="Aviso de la tienda: ".$titulo;
$asuntocorreocliente=$titulo;
$mensajes=" <strong>Envio de correo hacia el cliente para el estado  $dsestado del pedido $idpedido </strong>";
include ("tracking.envio.correo.formato.php");
// envio generico de correos
include("tracking.envio.correo.procesos.php");
// fin envio generico de correos
// insercion en la tabla
$sql="select id from $tabla  where ";//and idestado<>0";
$sql.=" idpedido=".$idpedido." and idclientepago=".$idclientepago." and idestado=".$idestado;
//
  $result=$db->Execute($sql);
  if($result->EOF){
//
    $sql=" insert into $tabla ";
    $sql.="(";
    $sql.="idestado,dsestado";
    $sql.=",dsorigen,dsdestino";
    $sql.=",dsaprobo,dsnacionalizacion";
  
    $sql.=",idpedido,idclientepago";
    $sql.=",dsfechalarga,dstitulo_b";
    $sql.=",dscausa_b,dsfecha_b";
    $sql.=",idenviaralcliente";
    $sql.=",dsdiasorigen";
    $sql.=",dsdiasdestino";
    $sql.=")";
    $sql.=" values ";
    $sql.="(";
    $sql.="'$idestado','$dsestado'";
    $sql.=",'$dsorigen','$dsdestino'";
    $sql.=",'$dsaprobo','$dsnacionalizacion'";
    $sql.=",'$idpedido','$idclientepago'";
    $sql.=",'$fechaBaseLarga','$titulo'";
    $sql.=",'$dsobs','$fechanotificacion'";
    $sql.=",'$idenviaralcliente'";
    $sql.=",'$dsdiasorigen'";
    $sql.=",'$dsdiasdestino'";
    $sql.=")";
    //echo $sql;
    //exit();
    $db->Execute($sql);
    // actualizar el pedido
    $sql=" update ecommerce_tblpagos set ";
    $sql.=" idestado=$idestado";
    $sql.=" ,dscausa_b='$dsobs'"; 
    $sql.=" ,dsfecha_b='$fechanotificacion'";
    //
    $sql.=" where id=".$id;
    $db->Execute($sql);
    //
}
$result->Close();       
?>