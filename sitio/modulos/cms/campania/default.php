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

$titulomodulo="Configuraci&oacute;n de noticias";
$dsm=$_REQUEST['dsm'];
$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];

$letra=$_REQUEST['letra'];
$tabla="tblcampania";
$orderby=$_REQUEST['orderby'];
$carpeta="noticias";

$include="include('../../tienda/noticias_detalle.php')";
// eliminacion
include($rutxx."../../incluidos_modulos/modulos.papelera.php");

// insercion
if ($dsm<>"" && $idpos<>"") {
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$dsm' ";
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
			$error=1;

		 } else {
		 	// insertar
			$sql="insert into $tabla (dsm,idpos,idactivo)";
			$sql.=" values ('$dsm',$idpos,$idactivo) ";
			if ($db->Execute($sql))  {
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro";

				include($rutxx."../../incluidos_modulos/logs.php");


			$sqld="select id,dsm from $tabla where dsm='".$dsm."'";
			$resultd = $db->Execute($sqld);
			if (!$resultd->EOF) {
			$idr=$resultd->fields[0];
			$dsmr=$resultd->fields[1];
			}

			$dsarchivo=limpieza(strtolower($dsmr))."";
			$cuerpo='Noticias';
			$ruta=$cuerpo."/".$dsarchivo;
			$idreg=$idr;
			$rutax=1;
//			$include="include('".$rutacomunes."/noticias_detalle.php')";
//			include($rutxx."../../incluidos_modulos/modulos.constructor.php") ;
			$sqlu="update $tabla set dsruta='".$dsarchivo."' where id=$idreg";
			$resultu = $db->Execute($sqlu);
				$error=0;

			} else {
				$mensajes=$men[2].".<br><br>$sql<br>Error:".mysql_error();
				$error=1;

			}
		 }
		 $result->close();
}

// modificacion rapida
		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
					$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";
					$sql.= ",dsruta='".$dsrutaPagina."'";
					//$sql.= ",idtipo=".$_REQUEST['idtipo_'][$j]."";
					$sql.= ",idpos=".$_REQUEST['idpos_'][$j]."";
					$sql.= " where id=".$_REQUEST['id_'][$j];

					if ($db->Execute($sql)){
					$sqlh="select id,dsm from $tabla where id=".$_REQUEST['id_'][$j];
					$resulth = $db->Execute($sqlh);
						if (!$resulth->EOF) {
						   $idr=$resulth->fields[0];
						   $dsmr=$resulth->fields[1];
				       }
					       $dsarchivo=limpieza(strtolower($dsmr))."";
						   $cuerpo='Noticias';
					       $ruta=$cuerpo."/".$dsarchivo;
						   $idreg=$idr;
						   $rutax=1;
						   $sqlk="update $tabla set dsruta='".$dsarchivo."' where id=$idreg";
						   $resultk = $db->Execute($sqlk);
					$h++;
				}
				} // fin si
			} // fin for
		if ($h>0) $mensajes=$men[4];

?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
	include($rutxx."../../incluidos_modulos/core.mensajes.php");

// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idpos,a.dsimg,a.dsruta,a.idactivo,a.idtipo from $tabla a where id>0 and idactivo<>9";
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
if ($orderby<>"") {
	$sql.=" order by a.$orderby asc ";
} else {
	$sql.=" order by a.idpos asc ";
}

	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsm";
		// 2. los tipo de busqueda
		$paramb="dsm";
		$paramn="Nombre";
		include($rutxx."../../incluidos_modulos/modulos.buscador.php");
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
	if (!$result->EOF) {

		include("campania.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si
$result->Close();
	include("campania.ingreso.php");

	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>