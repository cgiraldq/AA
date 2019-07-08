<?
/*
| ----------------------------------------------------------------- |
MEGAPINTURAS LTDA
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
 guardar los datos del cliene y retornar el id 
*/
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
$rc4 = new rc4crypt();
$tabla="tblclientes";

	$dstiponuevo=strtoupper($_REQUEST['dstiponuevo']);
	$dsnitnuevo=strtoupper($_REQUEST['dsnitnuevo']);
	$dsapellidosnuevo=strtoupper($_REQUEST['dsapellidosnuevo']);
	$dsnombrenuevo=strtoupper($_REQUEST['dsnombrenuevo']);
	$dstelnuevo=strtoupper($_REQUEST['dstelnuevo']);
	$dsdirnuevo=strtoupper($_REQUEST['dsdirnuevo']);
	$dsdirnuevo=strtoupper($_REQUEST['dsdirnuevo']);
	$idactivo=strtoupper($_REQUEST['idactivo']);
	$email=$_REQUEST['email'];
	if($email=="") $email=$dsnitnuevo;
	//echo $email;
	$dsclave=date('Ymdis');
	$clavee = $rc4->encrypt($s3m1ll4, $dsclave);
	$dsclave = urlencode($clavee);
	$sql="select id,dsnombres from tblclientes where dsidentificacion='$dsnitnuevo'  ";
	$resultb= $db->Execute($sql);
	if ($resultb->EOF) {
		$sql="insert into tblclientes ( ";
		$sql.="dsnombres,dsapellidos,dscorreocliente,dsclave";
		$sql.=",dsfecha,dstelefono,idtipocliente,idactivo,dsdireccion,dsidentificacion,dstipoidentificacion";
		$sql.=" ,dsacepto";	
		$sql.=") values (";
		$sql.="'$dsnombrenuevo','$dsapellidosnuevo','$email','$dsclave',";
		$sql.="'".$fechaBase."','$dstelnuevo',1,1,'$dsdireccion'";
		$sql.=" ,'$dsnitnuevo','$dstiponuevo','SI')";
		if ($db->Execute($sql)) { 
		$strSQL=" select id from ".$tabla." where dsidentificacion='$dsnitnuevo' ";
		$resultc= $db->Execute($strSQL);
		if (!$resultc->EOF) {
		$data=$resultc->fields[0];
		} else { 
		$data="-2";
		}
		$resultc->Close();	
		} else { 
		$data="-3";
		}
	}else{
	$data="-1";
	}
	$resultb->close();
include ($rutxx."../../incluidos_modulos/cerrarconexion.php");
echo $data;
?>