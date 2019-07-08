<?
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
 Recomendar un contenido
*/
session_start();

include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/varconexion.php");


//$c=$_REQUEST['dsrutax'];//dsrutax;
//

$idencuesta=$_REQUEST['idencuesta'];//nombredesde;
$idrespuesta=$_REQUEST['idrespuesta'];

	$dscliente=session_id();
	$dsfecha=date('Y/m/d');
	$remoto=$_SERVER["REMOTE_ADDR"];
	$sql="select * from tblencuestaxip where idencuesta=".$idencuesta." and dsessionid='$dscliente' and dsfecha='$dsfecha' and dsip='$remoto' ";
	$result=$db->Execute($sql);
	if(!$result->EOF){
		$data=0;
	}else{
		$sql="update tblencuestarespuesta set idhits=('idhits'+1) where id='$idrespuesta' ";
		//echo $sql;
		$db->Execute($sql);

		$sql=" insert into tblencuestaxip(idencuesta,idrespuesta,dsessionid,dsfecha,dsip)";
		$sql.=" values($idencuesta,$idrespuesta,'$dscliente','$dsfecha','$remoto')";
		$db->Execute($sql);
		$data=1;
	}

	/*$sqlc="select sum(idhits) from tblencuestarespuesta where idc=$idencuesta";
	$result=$db->Execute($sqlc);
	if(!$result->EOF){
		$data=$result->fields[0];
		//$_SESSION['on']=$idregistro.$idtipo;
	}$result->Close();
	$sqlc="select id,idhits from tblencuestarespuesta a ";
	$sqlc.=" where a.idc=$idencuesta ";
	$result=$db->Execute($sqlc);
	if(!$result->EOF){
		while(!$result->EOF){
			$data.="|".$result->fields[0]."-".$result->fields[1];
		$result->MoveNext();
		}
		//$_SESSION['on']=$idregistro.$idtipo;
	}$result->Close();*/
	echo $data;
?>

