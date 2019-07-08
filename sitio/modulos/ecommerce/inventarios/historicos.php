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
*/
// principal de productos con cantidades
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");


$titulomodulo="Inventarios - Salida y entrada de productos";
$tabla="ecommerce_tblinventarios";
$letra=$_REQUEST['letra'];

?><html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsproducto,a.dsfechalarga,a.dscom,a.idcant,a.dsusuario,a.idfactura,a.idordenpedido from $tabla a where a.id>0 ";
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '%".$_REQUEST['param']."%'";
if ($_REQUEST['idproducto']<>"") $sql.=" and a.idproducto=".$_REQUEST['idproducto'];

$sql.=" order by a.id desc ";

	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsproducto";
		// 2. los tipo de busqueda
		$paramb="dsproducto,dsusuario";
		$paramn="Nombre o Referencia,Responsable";
		include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma&idproducto=".$_REQUEST['idproducto']."&enca=".$_REQUEST['enca'];
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	$rutamodulo="<a href='../administrativos/default.php' class='textlink' title='Principal'>Modulos Administrativos</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
		$exportar=1;
		$dsrutaPapelera="papelera.php";//ruta de la papelera

		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		
		include("historicos.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si 
$result->Close();
	//include("producto.ingreso.php");
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>
</body>
</html>