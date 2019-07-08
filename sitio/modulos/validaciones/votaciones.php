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
 Validacion de acceso al sistema de votaciones
*/
session_start();
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/class.rc4crypt.php");
include("../../incluidos_modulos/sql.injection.php");
$login=trim($_REQUEST['dsusuario']);
$clave=trim($_REQUEST['dsclave']);
$clave = sha1($clave);
		// ACCESO SUPER ROOT
		// cargar el super root
		$sql="select dscodigo,dsnombre,idnits,dszonaelectoral,dsemail ";
	 	$sql.=" from tblvotacionasociados_temp WHERE (dscodigo='$login' or idnits='$login' or dscodigoasociado='$login' ) and dsclave='$clave' ";
//		echo $sql;
	 	//exit();
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		  	$dscodigo=$result->fields[0];
			$dsnombre=$result->fields[1];
			$idnits=$result->fields[2];
			$dszonaelectoral=$result->fields[3];
			$dsemail=$result->fields[4];



			$_SESSION['i_dscodigo']= $dscodigo;
			$_SESSION['i_dsnombre'] = $dsnombre;
			$_SESSION['i_idnits'] = $idnits;
			$_SESSION['i_dszonaelectoral'] = $dszonaelectoral;
			$_SESSION['i_dsemail'] = $dsemail;
			$_SESSION['i_cedula']= $dscodigo;

			$mensaje="mensaje=";

		} else {
			// demo
			$mensaje="mensaje=1";
		}
		 $result->close();
$ruta.="../../votaciones.php?".$mensaje;
//echo $ruta;
include("../../incluidos_modulos/cerrarconexion.php");
//exit();
?>
<html>
<head>
<title><? echo $AppNombre;?></title>
<script language="javascript">
<!--
location.href="<? echo $ruta?>";
//-->
</script>
?>
</head>
<body color=#ffffff  topmargin=10 leftmargin=0 class=text1></body></html>