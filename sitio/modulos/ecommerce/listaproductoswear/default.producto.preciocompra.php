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
// principal
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
$titulomodulo="Listado de producto con precio de compra";
$dsm=$_REQUEST['dsm'];
$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];
$idtipo=$_REQUEST['idtipo'];
$letra=$_REQUEST['letra'];

$tabla="ecommerce_tblproductos";
$orderby=$_REQUEST['orderby'];
$carpeta="producto";
$include="include('../../beta/producto_detalle.php')";
$rutaImagen="../../../../contenidos/images/productos/";
$db->debug=true;
// modificacion rapida
//$db->debug=true;
		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$sql=" update $tabla set ";
					$sql.= "preciocompra='".$_REQUEST['preciocompra_'][$j]."'";
					$sql.= ",precio1='".$_REQUEST['precio1_'][$j]."'";
					$sql.= ",precio2='".$_REQUEST['precio2_'][$j]."'";
					$sql.= ",precio3='".$_REQUEST['precio3_'][$j]."'";
					$sql.= ",precio4='".$_REQUEST['precio4_'][$j]."'";
					$sql.= ",precio5='".$_REQUEST['precio5_'][$j]."'";
					$sql.= ",iva='".$_REQUEST['iva_'][$j]."'";
					$sql.= ",dsflete='".$_REQUEST['dsflete_'][$j]."'";
					$sql.= " where id=".$_REQUEST['id_'][$j];
//					echo $sql;
//					exit();
					if ($db->Execute($sql)){
					 $h++;
					}
				} // fin si
			} // fin for	
		if ($h>0) $mensajes=$men[4];

?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.dsimg1,a.dsreferencia,a.preciocompra,a.precio1,a.precio2,a.precio3,a.precio4,a.precio5,a.iva,a.dsflete from $tabla a where id>0 and idactivo<>9";
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '%".$_REQUEST['param']."%'";
$sql.=" order by a.dsm asc ";

	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsm";
		// 2. los tipo de busqueda
		$paramb="preciocompra,dsproveedor";
		$paramn="Precio de compra,Proveedor";
		include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	$rutamodulo="<a href='../productos/default.producto.php' class='textlink' title='Principal'>Administracion de Productos</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
		$papelera=1;
		$dsrutaPapelera="papelera.php";//ruta de la papelera

		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		
		include("producto.preciocompra.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si 
$result->Close();
	//include("producto.ingreso.php");
include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>