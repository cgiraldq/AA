<?
/*
| ----------------------------------------------------------------- |
Sender version 3.5
Un Producto de Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2007
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fern�ndez <consultorweb@comprandofacil.net>
  Juan Felipe S�nchez <graficoweb@comprandofacil.net>
  Jos� Fernando Pe�a <soporteweb@comprandofacil.net>
=====================================================================
| ----------------------------------------------------------------- |
 Este archivo permite cargar el ultimo de los newsletter
 en caso que el cliente lo posea. En caso que
 se carga una plantilla en blanco generica con un mensaje
*/

	$strSQL="select dsc from tblcontenidos ";
if ($_SESSION['i_idperfil']==2 || $_SESSION['i_idperfil']==3){
	$strSQL.=" where idempresa=".$_SESSION['i_idempresa'];
}
	$strSQL.=" order by idc DESC Limit 0,1 ";
	// echo $strSQL;
$result = $db->Execute($sql);
if (!$result->EOF) {

	} else {
		$resultado=$ed[24];
}
	echo $resultado;
?>
