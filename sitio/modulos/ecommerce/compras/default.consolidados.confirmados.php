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
  Juan Fernando Fernandez <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sanchez <graficoweb@comprandofacil.com> - Diseno
  Jose Fernando Pena <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- | 
*/
// principal de productos consolidados confirmados 
$rutx=1;
$rutxx="../";
include("../../../incluidos_modulos/modulos.globales.php");
$rc4 = new rc4crypt();
$titulomodulo="Consolidados productos confirmados ";
$letra=$_REQUEST['letra'];
$tabla="ecommerce_tblpagos";
?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");

// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select sum(idcant) as total,a.idproducto,a.idprecio,a.dsdescuento  ";
$sql.=" from ecommerce_tblpagos b, ecommerce_tblcompras a where b.idpedido=a.idpedido";
$sql.=" and b.idestado<>3 ";
$sql.=" group by a.idproducto,a.idprecio,a.dsdescuento";
$sql.=" order by total desc  ";//and idestado<>0";
//echo $sql; 
//exit();
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsnombre";
		// 2. los tipo de busqueda
		$paramb="dsnombre";
		$paramn="Nombre";
		$info="vencimiento";
//		include($rutxx."../../incluidos_modulos/modulos.buscador.compras.php");
	// fin modulo buscador
	
	$rutaPaginacion="param=".$_REQUEST['param']."&dsfechasel=$dsfechasel&campo=".$_REQUEST['campo']."&letra=".	$_REQUEST['letra']."&idafiliado=".$_REQUEST['idafiliado'];
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	$rutamodulo="<a href='../../core/default.php' class='textlink' title='Principal'>Principal</a>   ";
	$rutamodulo.=" / <a href='../compras/default.php' class='textlink' title='Compras'>Compras</a>  /  ";

  $papelera=2;
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

	if (!$result->EOF) {
		
		include("default.consolidados.confirmados.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si 
$result->Close();
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>