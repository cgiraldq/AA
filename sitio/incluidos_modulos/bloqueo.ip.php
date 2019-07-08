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
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- | 
Bloque general por ip
*/
// 1. 
$ipbase=$remoto;
//2.
$rc5 = new rc4crypt();
$ipbaseenc=$rc5->encrypt($s3m1ll4, $ipbase);
$ipbaseenc= urlencode($ipbaseenc);

//3.
/*$sql="select id from tblbloqip where dsm='$ipbaseenc' and idactivo=1";
//4.
$result = $db->Execute($sql);
///echo $sql;
if (!$result->EOF) {
} else {
	die ("La ip desde donde hace esta accediendo no puede ejecutar el administrador.<br>IP: $ipbase<br>");	
	exit();
}
$result->close();*/
?>
