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
 Validacion de datos al ingresar y manejo de perfiles 
*/
session_start();
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/class.rc4crypt.php");
$login=trim($_REQUEST['dsusuario']);
$clave=trim($_REQUEST['dsclave']);
$rc4 = new rc4crypt();
$clavee = $rc4->encrypt($s3m1ll4, $clave);
$clave = urlencode($clavee);
		// ACCESO SUPER ROOT
		// cargar el super root
		$sql="select id,dsnombre,dsapellidos";
	 	$sql.=" from tblpacientes WHERE dsusuario='$login' and dsclave='$clave' ";
		//echo $sql;	
	 	//exit();
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		  	$idadmon=$result->fields[0];
			$dsnombre=$result->fields[1];
			$dsapellidos=$result->fields[2];
			$idactualizar=$result->fields[3];
			$_SESSION['i_idusuario']= $idadmon;
			$_SESSION['i_dsnombre'] = $dsnombre;
			$_SESSION['i_dsapellidos'] = $dsapellidos;
			$_SESSION['i_dsusuario'] = $login;
			$_SESSION['i_dsclave'] = $clave;
			$ruta="../../principal_afiliados.php";
		}else{
			$ruta="../../gracias.php?id=4";
		}
?>
<html>
<head>
<title><? echo $AppNombre;?></title>
<script language="javascript">
<!--
location.href="<? echo $ruta?>";
//-->
</script>
</head>
<body color=#ffffff  topmargin=10 leftmargin=0 class=text1></body></html>