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

$titulomodulo="Listado de paginas del sitio";
$dsm=$_REQUEST['dsm'];
$dsmalterna=$_REQUEST['dsmalterna'];

$dstit=$_REQUEST['dstit'];
$dstitin=$_REQUEST['dstitin'];
$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];
$letra=$_REQUEST['letra'];
$idtienda=$_REQUEST['idtienda'];

$tabla=$prefix."tblpaginas";
// insercion
if ($dsm<>"" && $idpos<>"") {
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$dsm' ";
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
			$error=0;

		 } else {
		 	// insertar
			$sql="insert into $tabla (dsm,dstit,idpos,idactivo,dsmalterna)";
			$sql.=" values ('$dsm','$dstit',$idpos,$idactivo,'$dsmalterna') ";
			//echo $sql;
			if ($db->Execute($sql))  {
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro";
				$dsruta="../cms/paginas/default.php";
				include($rutxx."../../incluidos_modulos/logs.php");
				$error=0;

			} else {
				$mensajes=$men[2].".<br><br>$sql";
				$error=1;

			}
		 }
		 $result->close();
}
// eliminacion
include($rutxx."../../incluidos_modulos/modulos.papelera.php");

// modificacion rapida
		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
					$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";
					//$sql.= ",dsmalterna='".$_REQUEST['dsmalterna_'][$j]."'";
					//$sql.= ",idsitemap='".$_REQUEST['idsitemap_'][$j]."'";
					$sql.= ",dstit='".$_REQUEST['dstit_'][$j]."'";
					$sql.= ",idpos=".$_REQUEST['idpos_'][$j]."";
					$sql.= ",idvista='".$_REQUEST['idvista_'][$j]."' ";
					//$sql.= ",idtienda=".$_REQUEST['idtienda_'][$j]."";
					$sql.= " where id=".$_REQUEST['id_'][$j];
					//	echo $sql;
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
$sql="select a.id,a.dsm,a.dstit,a.idpos,a.idactivo,a.idvista from $tabla a where id>0 ";
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
if ($_REQUEST['idtiendax']<>"") $sql.=" and a.idtienda='".$_REQUEST['idtiendax']."%'";

$sql.=" order by a.dsm asc, a.dsm asc ";
//echo $sql;
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsm";
		// 2. los tipo de busqueda
		$paramb="dsm,dsd,dstit";
		$paramn="Nombre,Descripcion,Titulo";
		$tienda=0; // mostrare tiendas o no
		include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra']."&idtiendax=".$_REQUEST['idtiendax'];
	$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";
	include($rutxx."../../incluidos_modulos/paginar.variables.php");

$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' target='_top' title='Principal'>Principal</a>  /  <span class='text1'>".$titulomodulo."</span>";
		$papelera=1;
		$dsrutaPapelera="papelera.php";//ruta de la papelera
		$dsrutap="../paginas/default.php";
		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
		include("paginas.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si
$result->Close();


	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>