<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

/*
CF-INFORMER
ADMINISTRADOR DE CONTENIDOS

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
 Script generico de envio de datos via formulario
*/
session_start();

include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/class.rc4crypt.php");
//$db->debug=true;

$rc4 = new rc4crypt();

$redir=trim($_REQUEST['redir']);
$desdesitio=trim($_REQUEST['desdesitio']);


$id=trim($_REQUEST['idx']);
$dsnombre=trim(reemplazar($_REQUEST['dsm']));
$dsapellidos=trim(reemplazar($_REQUEST['dsapellido']));
$dstipoidentificacion=trim($_REQUEST['dstipoidentificacion']);
$dsidentificacion=trim($_REQUEST['dsidentificacion']);
//Reques para la fecha de nacimiento
$dsanio=trim($_REQUEST['dsanio']);
$dsmes=trim($_REQUEST['dsmes']);
$dsdia=trim($_REQUEST['dsdia']);
$dsfechanacimiento=$dsanio."/".$dsmes."/".$dsdia;
$idfechanacimiento=$dsanio.$dsmes.$dsdia;
//Fin Reques para la fecha de nacimiento
$dscorreocliente=trim($_REQUEST['dscorreo']);
$dstelefono2=trim($_REQUEST['tel_ofi']);
$dsmovil=trim($_REQUEST['dsmovil']);
$dsdireccion=trim($_REQUEST['dsdireccion']);
$dsfax=trim($_REQUEST['dsfax']);
$dsempresa=trim(reemplazar($_REQUEST['dsempresa']));
$dscargo=trim(reemplazar($_REQUEST['dscargo']));
$dsdepartamento=trim(reemplazar($_REQUEST['dsdepartamento']));
$dsfacebook=trim($_REQUEST['dsfacebook']);
$dstwitter =trim($_REQUEST['dstwitter']);

$dsciudad =trim($_REQUEST['dsciudad']);
$dstelefono=trim($_REQUEST['dstelefono']);


//exit();
if ($dsnombre<>"" &&  $dscorreocliente<>"" && $dsidentificacion<>"") {





    $sql="select dsnombres,dsapellidos,dsidentificacion,dstelefono,dstelefono2,dscorreocliente from tblclientes where id=$id";
    //echo $sql;
    $resultb= $db->Execute($sql);
    if (!$resultb->EOF) {

$dsnombres=trim($resultb->fields[0]);
$dsapellidos=trim($resultb->fields[1]);
$dsidentificacion=trim($resultb->fields[2]);
$dstelefono=trim($resultb->fields[3]);
$dstelefono2=trim($resultb->fields[4]);
$dscorreocliente=trim($resultb->fields[5]);
      $_SESSION['i_idcliente'] = $id;
      $_SESSION['i_dsnombre'] = $dsnombres." ".$dsapellidos;
      $_SESSION['i_dscorreo'] = $dscorreocliente;
      $_SESSION['i_dstelefono'] = $dstelefono;
      $_SESSION['i_dsciudad'] = $dsciudad;

      $_SESSION['i_solodsnombre'] = $dsnombres;
      $_SESSION['i_solodsapellido'] = $dsapellidos;


    }
   $resultb->Close();



		$sql="select id,dsnombres from tblclientes where id=$id";
		//echo $sql;
		$resultb= $db->Execute($sql);
		if (!$resultb->EOF) {
		//almacenar en base de datos
		$sql=" update tblclientes set ";
		$sql.=" dsnombres='$dsnombre'";
		$sql.=",dsapellidos='$dsapellidos'";
		$sql.=",dstipoidentificacion='$dstipoidentificacion'";
		$sql.=",dsidentificacion='$dsidentificacion'";
		$sql.=",dsfechanacimiento='$dsfechanacimiento'";
		$sql.=",idfechanacimiento='$idfechanacimiento'";
		$sql.=",dscorreocliente='$dscorreocliente'";
		$sql.=",dstelefono='$dstelefono'";
		$sql.=",dstelefono2='$dstelefono2'";
		$sql.=",dsmovil='$dsmovil'";
		$sql.=",dsdireccion='$dsdireccion'";
		$sql.=",dsfax='$dsfax'";
		$sql.=",dsempresa='$dsempresa'";
		$sql.=",dscargo='$dscargo'";
		$sql.=",dsciudad='$dsciudad'";
		$sql.=",dsdepartamento='$dsdepartamento'";
		$sql.=",dsfacebook='$dsfacebook'";
		$sql.=",dstwitter='$dstwitter'";
		$sql.=" where id=".$id;
//		echo $sql;
//		exit;
		if($db->Execute($sql)){

			    $redir="../../gracias.php?registro=1&entrar=".$_REQUEST['entrar'];
				//$redir="../../registro.paso.3.php?idx=$id&entrar=".$_REQUEST['entrar'];
			if ($desdesitio==1) $redir="../../../sitio/servicio_paso3.php?idx=$id";

		}else{

		}
		}

} else {
	$redir="../../registro.php&entrar=".$_REQUEST['entrar'];
	if ($desdesitio==1) $redir="../../../sitio/servicio_paso1.php";
}
//echo $redir;
//exit();
include("../../incluidos_modulos/cerrarconexion.php");
include("../../redir.php");

//exit();//para imprimir
?>
