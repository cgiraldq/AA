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
 Script generico de envio de datos via formulario
*/
session_start();
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/class.rc4crypt.php");
$redir=trim($_REQUEST['redir']);
$rc4 = new rc4crypt();
//
$dscontrasenaant=trim($_REQUEST['dscontrasenaant']);
$dscontrasenanew=trim($_REQUEST['dsclave']);
$dscontrasenacnew=trim($_REQUEST['dsclave2']);
$dscontrasena=trim($_REQUEST['dscontrasena']);
//
$dscontrasenae = $rc4->encrypt($s3m1ll4, $dscontrasena);
$dscontrasena = urlencode($dscontrasenae);
//
$dscontrasenaante = $rc4->encrypt($s3m1ll4, $dscontrasenaant);
$dscontrasenaant = urlencode($dscontrasenaante);


$dscontrasenanewe = $rc4->encrypt($s3m1ll4, $dscontrasenanew);
$dscontrasenanew = urlencode($dscontrasenanewe);
//$db->debug=true;
$dscontrasenacnewe = $rc4->encrypt($s3m1ll4, $dscontrasenacnew);
$dscontrasenacnew = urlencode($dscontrasenacnewe);
if(($dscontrasenaant==$dscontrasena) && ($dscontrasenanew==$dscontrasenacnew)){
				$sql=" update tblclientes set ";
				$sql.=" dsclave='$dscontrasenanew'";
				$sql.=" where id=".$_SESSION['i_idcliente'];
				if ($db->Execute($sql)){
					$redir="../../zona.privada.php?r=1#actualizar_datos";
				}
}else {
	$redir="../../zona.privada.php?r=2#actualizar_datos";
}
include("../../incluidos_modulos/cerrarconexion.php");
include("../../redir.php");
//exit();//para imprimir
?>
