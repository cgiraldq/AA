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
  Juan Fernando Fern�ndez <consultorweb@comprandofacil.com>
  Juan Felipe S�nchez <graficoweb@comprandofacil.com>
  Jos� Fernando Pe�a <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
 Script generico de envio de datos via formulario
*/

session_start();
$apagarsql=1;

include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/class.rc4crypt.php");

$rc4 = new rc4crypt();
//$db->debug=true;
foreach($_POST as $nombre_campo => $valor){ 
$asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
eval($asignacion); 
}
if($email<>"" && $dsnombrex<>""){ 

$sql="select * from tblreferidos where dscorreo='$email' ";

$resultbx= $db->Execute($sql);
if ($resultbx->EOF) {
$sql="insert into tblreferidos ( ";
$sql.="dsm,dscorreo,dstelefono,iddistribuidor";
$sql.=") values (";
$sql.="'$dsnombrex','$email','$telefono','".$_SESSION['i_idcliente']."')";
if($db->Execute($sql)){
$redir="../../zona.distribuidor.php#referidos";	
}else{
$redir="../../zona.distribuidor.php?error=1#referidos";	
}
} else {
$redir="../../zona.distribuidor.php#referidos";

}$resultbx->Close();

} else {
$redir="../../zona.distribuidor.php?error=1#referidos";
}
//exit();
include("../../incluidos_modulos/cerrarconexion.php");
include("../../redir.php");
?>