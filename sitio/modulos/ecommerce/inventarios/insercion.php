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
  Juan Fernando Fern�ndez <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe S�nchez <graficoweb@comprandofacil.com> - Dise�o
  Jos� Fernando Pe�a <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// procesos general de insercion de daatos de inventario
			$tablai="ecommerce_tblinventarios";
			$strSQLi="insert into ".$tablai;
			$strSQLi.="  (";
			$strSQLi.=" dsproducto,dsfecha,idfecha,dsfechalarga,dscom,idcant,idtipo,idordenpedido";	
			$strSQLi.=" ,idfactura,dsusuario,idproducto,idordenremision)";
			$strSQLi.="  values (";
			$strSQLi.="'".$dsproductoi."','".$fechaBase."'";
			$strSQLi.=",'".$fechaBaseNum."','".$fechaBaseLarga."','".$dscomi."','".$idcanti."'";					
			$strSQLi.=" ,'".$idtipoi."','$idordenpedidoi','$idfacturai','".$_SESSION['i_dslogin']."','$idproductoi','$idordenremision')";
			$db->Execute($strSQLi);
			


?>