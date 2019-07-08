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
// principal de productos con fechas
include("../../incluidos_modulos/version.php");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/modulos.funciones.php");
//include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/sessiones.php");
include("../../incluidos_modulos/varmensajes.php");
include("../../incluidos_modulos/class.rc4crypt.php");
include("../../incluidos_modulos/bloqueo.ip.php");
include ("../../incluidos_modulos/modulos.calendario.php");


$titulomodulo="Listado de productos con fechas";
$dsm=$_REQUEST['dsm'];
$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];
$idtipo=$_REQUEST['idtipo'];
$letra=$_REQUEST['letra'];

$tabla="tblbeneficiosn";
$orderby=$_REQUEST['orderby'];
$carpeta="producto";
$include="include('../../beta/producto_detalle.php')";
$rutaImagen="../../../contenidos/images/producto/";

// modificacion rapida
//$db->debug=true;
		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){

					$dsfechainicial=$_REQUEST['dsfechainicial_'][$j];
					$dsfechafinal=$_REQUEST['dsfechafinal_'][$j];
					if ($dsfechainicial<>"") $idfechainicial=preg_replace("/\//","",$dsfechainicial);
					if ($dsfechafinal<>"") $idfechafinal=preg_replace("/\//","",$dsfechafinal);


					$sql=" update $tabla set ";

					$sql.= "dsfechainicial='".$dsfechainicial."'";
					$sql.= ",dsfechafinal='".$dsfechafinal."'";
					$sql.= ",idfechainicial='".$idfechainicial."'";
					$sql.= ",idfechafinal='".$idfechafinal."'";

					$sql.= " where id=".$_REQUEST['id_'][$j];
					if ($db->Execute($sql)){
					 $h++;
					}
				} // fin si
			} // fin for	
		if ($h>0) $mensajes=$men[4];

?><html>
<head>
<title><? echo $AppNombre;?></title>
<? include("../../incluidos_modulos/sub.encabezado.php");?>
</head>
<body color=#ffffff  topmargin=0 leftmargin=0>
<?
include("../../incluidos_modulos/modulos.encabezado.php");
include("../../incluidos_modulos/modulos.mensajes.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.dsfechainicial,a.dsfechafinal,a.dsimg1 from $tabla a where id>0 and idactivo<>9";
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '%".$_REQUEST['param']."%'";
$sql.=" order by a.dsfechafinal desc,a.dsm asc ";

	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsm";
		// 2. los tipo de busqueda
		$paramb="dsm";
		$paramn="Nombre";
		include("../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";
	include("../../incluidos_modulos/paginar.variables.php");
	$rutamodulo="<a href='../beneficios/default.beneficios.php' class='textlink' title='Principal'>Administracion de Productos</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
		$papelera=1;
		$dsrutaPapelera="papelera.php";//ruta de la papelera

		include("../../incluidos_modulos/modulos.subencabezado.php");
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		
		include("producto.fechas.tabla.php");
		include("../../incluidos_modulos/paginar.php");
	} // fin si 
$result->Close();
	//include("producto.ingreso.php");
	include("../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>