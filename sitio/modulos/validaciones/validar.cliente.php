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
 Validar acceso cliente
*/
session_start();
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/class.rc4crypt.php");
$rc4 = new rc4crypt();
//$db->debug=true;
$entrar=trim($_REQUEST['entrar']);
$dsclave=trim($_REQUEST['clave']);
$dsusuario=trim($_REQUEST['email']);
$clavee = $rc4->encrypt($s3m1ll4, $dsclave);
$clave = urlencode($clavee);
if ($dsusuario=="' or '1'='1") {
	$redir="../../inicio.sesion.php?entrar=$entrar&msg=3";
} else {
		$sql="select id,dsnombres,dsapellidos,idtextozona,dsidentificacion,idtipocliente,dscodigodis from tblclientes where dscorreocliente='$dsusuario' and dsclave='$clave' and idtienda=$idtienda";
		//echo $sql;
		//exit;
		$result = $db->Execute($sql);
		 if (!$result->EOF) {
					$idcliente=$result->fields[0];
					$dsnombres=$result->fields[1];
					$dsapellidos=$result->fields[2];
					$idtextozona=$result->fields[3];
					$dsidentificacion=$result->fields[4];
					$idtipocliente=$result->fields[5];
					$idcodigodis=$result->fields[6];
					$_SESSION['i_idcliente'] = $idcliente;
					$_SESSION['i_dsnombre'] = $dsnombres." ".$dsapellidos;
					$_SESSION['i_dscorreo'] = $dsusuario;
					$_SESSION['i_textozona'] = $idtextozona;
					$_SESSION['i_dsidentificacion'] = $dsidentificacion;
					if($idtipocliente==2)$_SESSION['i_idcodigodis'] = $idcodigodis;
					$sqlx="insert into tblhistorialingresocliente";
					$sqlx.=" (idcliente,dsfecha,idfecha,dsip)";
					$sqlx.=" values ( ";
					$sqlx.=" ".$idcliente." ";
					$sqlx.=" ,'".$fechaBaseLarga."',".$fechaBaseNum.",'".$remoto."'";
					$sqlx.=" ) ";
					$db->Execute($sqlx);
					//echo $sqlx;
					//exit();
					$redir="../../proceso.pago.1.php";

						if($idtipocliente==2){
						$rutax="../../zona.distribuidor.php";
						}else{
						if($_SESSION['idcomprador']<>""){
						$rutax="../../proceso.pago.1.php";
						}else{
						$rutax="../../zona.privada.php#cont_zona";
						}
						}



					if ($entrar=="") $redir=$rutax;
		} else {
			$redir="../../inicio.sesion.php?entrar=$entrar&msg=2";
		}
		$result->Close();

}
//exit();
include("../../incluidos_modulos/cerrarconexion.php");
include("../../redir.php");
?>
