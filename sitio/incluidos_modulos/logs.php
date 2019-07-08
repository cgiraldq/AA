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
Proceso de almaceniento de los procesos realizados en eladministrador de contenidos
*/
$sqlx="insert into tbl_logs";
$sqlx.=" (dsnombre,dsusuario,dsmodulo,dstitulo,dsdesc,dsruta,dsfecha,idfecha,dsip)";
$sqlx.=" values ( ";
$sqlx.=" '".$_SESSION['i_dsnombre']."','".$_SESSION['i_dslogin']."'";
$sqlx.=" ,'".$titulomodulo."','".$dstitulo."'";
$sqlx.=" ,'".$dsdesc."','".$dsruta."'";
$sqlx.=" ,'".$fechaBaseLarga."',".$fechaBaseNum.",'".$remoto."'";
$sqlx.=" ) ";

if (!$db->Execute($sqlx)) {
	  die ("Problemas al insertar el log de transacci&oacute;n. Contacte al administrador") ;
	  exit();
}

?>
