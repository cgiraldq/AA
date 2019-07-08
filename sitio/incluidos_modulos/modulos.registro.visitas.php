<?
/*
| ----------------------------------------------------------------- |
http://www.comprandofacil.com/
Copyright (c) 2005 - 2008
Medellin - Colombia
Un Producto Usando GNU GLP
=====================================================================
  Autores: 
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>

=====================================================================
| ----------------------------------------------------------------- | 
ALMACENAMIENTO DE LAS VISITAS EN  LOGS DE CONSULTA
*/
$sqlx="insert into tbl_visitas_tienda ";
$sqlx.=" (dscliente,idcliente,dspagina,idproducto,idcategoria,dsdesc,dsruta,dsfecha,idfecha,dsip,session_id)";
$sqlx.=" values ( ";
$sqlx.=" '".$_SESSION['i_dsnombre']."','".$_SESSION['i_idcliente']."'";
$sqlx.=" ,'".$pagina."','".$_REQUEST['idproducto']."','".$_REQUEST['idcat']."'";
$sqlx.=" ,'".$search."','".$dsruta."'";
$sqlx.=" ,'".$fechaBaseLarga."',".$fechaBaseNum.",'".$remoto."','".session_id()."'";
$sqlx.=" ) ";
//echo $sqlx;
//$db->debug=true;
//exit();
if (!$db->Execute($sqlx)) {
//	  die ("Problemas al insertar el log de transacci&oacute;n. Contacte al administrador") ; 
//	  exit();
}	  
	  
?>
