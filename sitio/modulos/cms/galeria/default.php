<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2013
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fern�ndez <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe S�nchez <graficoweb@comprandofacil.com> - Dise�o
  Jos� Fernando Pe�a <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// principal
$db->debug=true;
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

$titulomodulo="Configuracion de banners";
$rutaImagen="../../../contenidos/images/galeria/";
$dsm=$_REQUEST['dsm'];
$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];
$idevento=$_REQUEST['idevento'];
$letra=$_REQUEST['letra'];
$orderby=$_REQUEST['orderby'];
$idactivox=$_REQUEST['idactivox'];
$tabla="tblgaleria";
// eliminacion
include($rutxx."../../incluidos_modulos/modulos.papelera.php");
// insercion
if ($dsm<>"" && $idpos<>"") {
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$dsm' and idevento=$idevento";
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
			$error=1;
		 } else {
		 	// insertar
			$sql="insert into $tabla (dsm,idpos,idactivo,idevento)";
			$sql.=" values ('$dsm',$idpos,$idactivo,'$idevento') ";
			if ($db->Execute($sql))  {
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$error=0;
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro de banner";
				include($rutxx."../../incluidos_modulos/logs.php");
			} else {
				$mensajes=$men[2].".<br><br>$sql";
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
					//$sql.= ",dsruta='".limpieza(strtolower($_REQUEST['dsm_'][$j]))."'";

					if ($_REQUEST['dsfechai_'][$j]<>""){
						$sql.= ",dsfechai='".$_REQUEST['dsfechai_'][$j]."'";
						$idfechai=str_replace("/","",$_REQUEST['dsfechai_'][$j]);
						$sql.= ",idfechai='".$idfechai."'";
					}

					if ($_REQUEST['dsfechaf_'][$j]<>""){
						$sql.= ",dsfechaf='".$_REQUEST['dsfechaf_'][$j]."'";
						$idfechaf=str_replace("/","",$_REQUEST['dsfechaf_'][$j]);
						$sql.= ",idfechaf='".$idfechaf."'";
					}


					$sql.= ",idpos=".$_REQUEST['idpos_'][$j]."";
					$sql.= " where id=".$_REQUEST['id_'][$j].";";
					//echo $sql;
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for
		if ($h>0) $mensajes=$men[4];

?>
<html>
	<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
	 include($rutxx."../../incluidos_modulos/core.mensajes.php");
	?>
<?

// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idpos,a.idactivo,a.dsimg,a.idtipo from $tabla a where idactivo not in(9) ";
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($idactivox<>"") $sql.=" and a.idactivo=$idactivox ";
if ($idevento<>""){
	$sql.=" and a.idevento=$idevento ";
} else{
	$sql.=" and a.idevento='' ";
}
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '%".$_REQUEST['param']."%'";
if ($orderby<>"") {
	$sql.=" order by a.$orderby asc ";
} else {
	$sql.=" order by a.dsm asc ";
}
//echo $sql;

	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsm";
		// 2. los tipo de busqueda
		$paramb="dsm";
		$paramn="Nombre";
		$bannersx=1;
		include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma&orderby=$orderby&idactivox=$idactivox";
	include($rutxx."../../incluidos_modulos/paginar.variables.php");

$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
				$papelera=1;
				$dsrutaPapelera="papelera.php";//ruta de la papelera

		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
		include("entorno.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si
	$result->Close();
	include("entorno.ingreso.php");
	?>

	<?
		include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");
	?>

</body>
</html>