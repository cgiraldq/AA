<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Area Investigacion y Desarrollo
  Area Diseno y Maquetacion
  Area Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// principal
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

$titulomodulo="Listado de comentarios respuestas del blog";
$letra=$_REQUEST['letra'];
$idtema=$_REQUEST['idtema'];
$idrespuesta=$_REQUEST['idrespuesta'];

$tabla="blogtblrespuestas";
// insercion
// eliminacion
$idx=$_REQUEST['idx'];
if ($idx<>"") {
	$sql=" delete from $tabla WHERE id='$idx' ";
	if ($db->Execute($sql))  {
		$mensajes="<strong>".$men[3]."</strong>";
		$dstitulo="Eliminacion $titulomodulo";
		$dsdesc=" El usuario ".$_SESSION['i_dslogin']." elimino registro de $titulomodulo";
		$dsruta="../comentarios_blog/default.php";
		include($rutxx."../../incluidos_modulos/logs.php");

	}
}
		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
					//$sql.= ",dscom='".$_REQUEST['dscom_'][$j]." ' ";
					$sql.= " where id=".$_REQUEST['id_'][$j];
					//echo $sql;
					if ($db->Execute($sql)) $h++;


				} // fin si
			} // fin for
		if ($h>0) $mensajes=$men[4];

?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados


$sql="select a.id,a.dsm";
$sql.=",a.dscorreocliente,a.dscom,a.dsfecha,a.dsciudad,a.idr,a.idactivo";
$sql.=" from $tabla a  where a.idc=$idrespuesta";

if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";

if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
$sql.=" order by a.id desc  ";
//echo $sql;
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsm";
		// 2. los tipo de busqueda
		$paramb="dsm,dsapellidos,dscorreocliente";
		$paramn="Nombre,Apellidos,Email";
		include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra']."&idtema=".$_REQUEST['idtema'];
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /
				 <a href='../comentariosblog/default.php?idtema=$idtema' class='textlink' title='Principal'>Listado de comentarios del blog</a> /  ";

	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	$exportar=1; // permite exportar la tabla
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
	$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {

		include("correos.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
		echo "<br>";
	}else{
		echo "<h3>No hay registros a mostar</h3>";
	} // fin si
$result->Close();
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>