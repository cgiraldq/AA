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
	// proceso de carga del sitemap
	// borrado de existencia de ruta
	if ($dsm<>"") {
	if ($dsrutasitemap=="") $dsrutasitemap=limpieza($dsm);
			$sql="delete from tbl_logssitemap where dsrutasitemap=".$dsrutasitemap;
			$db->Execute($sqlx);
			$sqlx="insert into tbl_logssitemap";
			$sqlx.=" (dsnombre,dsusuario,dsmodulo,dstitulo,dsdesc,dsruta,dsfecha,idfecha,dsip,dsrutasitemap)";
			$sqlx.=" values ( ";
			$sqlx.=" '".$_SESSION['i_dsnombre']."','".$_SESSION['i_dslogin']."'";
			$sqlx.=" ,'".$titulomodulo."','".$dstitulo."'";
			$sqlx.=" ,'".$dsdesc."','".$dsruta."'";
			$sqlx.=" ,'".$fechaBaseLarga."',".$fechaBaseNum.",'".$remoto."','$dsrutasitemap'";
			$sqlx.=" ) ";
			echo $sql;
			if (!$db->Execute($sqlx)) {
			  die ("Problemas al general el log de sitemap. Contacte al administrador") ; 
			  exit();
			 } 
	 }
	// insercion de ruta
?>
