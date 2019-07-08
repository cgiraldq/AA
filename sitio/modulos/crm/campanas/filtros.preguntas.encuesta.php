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
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
$msn = $_REQUEST['msn'];
$idencuesta=$_REQUEST['idencuesta'];
if($msn==1) {$error=0; $mensajes=$men[1];}
if($msn==2) {$error=1; $mensajes=$men[0];}
if($msn==3) {$error=0; $mensajes=$men[4];}

$titulomodulo="Configuraci&oacute;n de preguntas por encuesta";

$dsm=$_REQUEST['dsm'];
$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];

$idprecio=$_REQUEST['idprecio'];
$idcampo=$_REQUEST['idcampo'];

$letra=$_REQUEST['letra'];
$tabla="crm_preguntas";
$orderby=$_REQUEST['orderby'];
$carpeta="noticias";

$include="include('../../tienda/noticias_detalle.php')";

// eliminacion
include($rutxx."../../incluidos_modulos/modulos.papelera.php");
// modificacion rapida
if($_REQUEST['mod']==1)
{
		$contarx=count($_REQUEST['id_']);
		$h=0;

			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
					$sql.= ",titulo='".$_REQUEST['dsm_'][$j]."'";
					//$sql.= ",dsruta='".$dsrutaPagina."'";
					//$sql.= ",idtipo=".$_REQUEST['idtipo_'][$j]."";
					$sql.= ",posicion=".$_REQUEST['idpos_'][$j]."";
					$sql.= " where id=".$_REQUEST['id_'][$j];

					if ($db->Execute($sql)){
									
					$h++;
				}
				} // fin si
			} // fin for
	}
		if ($h>0) $mensajes=$men[4];


	//insercion
			if($_REQUEST['inn']==1)
			{
					$sql=" insert into $tabla (titulo,posicion,idactivo,encuesta_asociada) values (";
					$sql.= "'".$_REQUEST['dsm']."'";
					$sql.= ",'".$_REQUEST['idpos']."'";
					$sql.= ",'".$_REQUEST['idactivo']."'";
					$sql.= ",'".$_REQUEST['idencuesta']."')";
					
					if ($db->Execute($sql)){				
						$h++;
					}
				} // fin si

?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
	 include($rutxx."../../incluidos_modulos/core.mensajes.php");

	// generacion del encabezado de acuerdo a los resultados encontrados
	 
	$sql="select a.id,a.titulo,a.posicion,a.idactivo from $tabla a where id>0 and idactivo<>9 and encuesta_asociada= $idencuesta ";

	if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
	if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
	if ($orderby<>"") {
		$sql.=" order by a.$orderby asc ";
	} else {
		$sql.=" order by a.dsfecha asc ";
	}

	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="titulo";
		// 2. los tipo de busqueda
		$paramb="titulo";
		$paramn="Titulo";
		//include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' target='_top' title='Principal'>Principal</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
		$papelera=1;
		$dsrutaPapelera="papelera.php";//ruta de la papelera


		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
			$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
			$datos=0;
	if (!$result->EOF) {
		$datos=1;
		include("filtros.preguntas.encuesta.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si

$result->Close();

	include("filtros.preguntas.encuesta.ingreso.php");

	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>