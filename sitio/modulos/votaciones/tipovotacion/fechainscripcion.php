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
include($rutxx."../../incluidos_modulos/modulos.calendario.php");

$titulomodulo="Fechas de inscripci&oacute;n";
$idtv=$_REQUEST['idtv'];
$dsfechainicial=$_REQUEST['dsfechainicial'];
$dsfechafinal=$_REQUEST['dsfechafinal'];
$dshorainicial=$_REQUEST['dshorainicial'];
if (strlen($dshorainicial)<2) $dshorainicial="0".$dshorainicial;
$dshorafinal=$_REQUEST['dshorafinal'];
if (strlen($dshorafinal)<2) $dshorafinal="0".$dshorafinal;


$dsrequisitos=$_REQUEST['dsrequisitos'];
$idactivo=$_REQUEST['idactivo'];


$letra=$_REQUEST['letra'];
$orderby=$_REQUEST['orderby'];
$dstelefono=$_REQUEST['dstelefono'];
$tabla="tblvotacionfechainscripcion";
// insercion
$dsruta="../tipovotacion/default.php";
if ($dsfechainicial<>"" && $dsfechafinal<>"") {

		$dsfecha=explode("/",$dsfechainicial);
		$idfechai=$dsfecha[0]."".$dsfecha[1]."".$dsfecha[2];
		$dsfecha2=explode("/",$dsfechafinal);
		$idfechaf=$dsfecha2[0]."".$dsfecha2[1]."".$dsfecha2[2];

		$minutosini=$_REQUEST['minutosini'];
		if (strlen($minutosini)<2) $minutosini="0".$minutosini;

		$minutosfin=$_REQUEST['minutosfin'];
		if (strlen($minutosfin)<2) $minutosfin="0".$minutosfin;

		$idhorai=$dshorainicial.$minutosini;
		$idhoraf=$dshorafinal.$minutosfin;

		$idfechaini=$idfechai.$idhorai;
		$idfechafin=$idfechaf.$idhoraf;



		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsfechainicial='$dsfechainicial' and dsfechafinal='$dsfechafinal'  and idtv=$idtv ";
		$sql.=" and  dshorainicial='$dshorainicial' and dshorafinal='$dshorafinal' ";


		//echo $sql;
		//exit();
		$error=0;
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
		 } else {
		 	// insertar
			$sql="insert into $tabla (dsfechainicial,dsfechafinal,dshorainicial,dshorafinal,dsrequisitos,idactivo,idtv";
			$sql.=",idfechai,idfechaf,idhorai,idhoraf,idfechaini,idfechafin)";
			$sql.=" values ('$dsfechainicial','$dsfechafinal','$dshorainicial','$dshorafinal','$dsrequisitos',$idactivo,$idtv";
			$sql.=",$idfechai,$idfechaf,$idhorai,$idhoraf,$idfechaini,$idfechafin) ";
			//echo $sql;
			//exit();
			if ($db->Execute($sql))  {
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro";
				include($rutxx."../../incluidos_modulos/logs.php");
			} else {
				$mensajes=$men[2].".<br><br>$sql";
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


		$dsfecha=explode("/",$_REQUEST['dsfechainicial_'][$j]);
		$idfechai=$dsfecha[0]."".$dsfecha[1]."".$dsfecha[2];
		$dsfecha2=explode("/",$_REQUEST['dsfechafinal_'][$j]);
		$idfechaf=$dsfecha2[0]."".$dsfecha2[1]."".$dsfecha2[2];

		$dshorainicial=$_REQUEST['dshorainicial_'][$j];
		if (strlen($dshorainicial)<2) $dshorainicial="0".$dshorainicial;

		$dshorafinal=$_REQUEST['dshorafinal_'][$j];
		if (strlen($dshorafinal)<2) $dshorafinal="0".$dshorafinal;


		$minutosini=$_REQUEST['minutosini_'][$j];
		if (strlen($minutosini)<2) $minutosini="0".$minutosini;

		$minutosfin=$_REQUEST['minutosfin_'][$j];
		if (strlen($minutosfin)<2) $minutosfin="0".$minutosfin;

		$idhorai=$dshorainicial.$minutosini;
		$idhoraf=$dshorafinal.$minutosfin;

		$idfechaini=$idfechai.$idhorai;
		$idfechafin=$idfechaf.$idhoraf;


					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
					$sql.= ",dsfechainicial='".$_REQUEST['dsfechainicial_'][$j]."'";
					$sql.= ",dsfechafinal='".$_REQUEST['dsfechafinal_'][$j]."'";
					$sql.= ",dshorainicial='".$_REQUEST['dshorainicial_'][$j]."'";
					$sql.= ",dshorafinal='".$_REQUEST['dshorafinal_'][$j]."'";

					$sql.= ",idfechai='".$idfechai."'";
					$sql.= ",idfechaf='".$idfechaf."'";
					$sql.= ",idhorai='".$idhorai."'";
					$sql.= ",idhoraf='".$idhoraf."'";

					$sql.= ",idfechaini='".$idfechaini."'";
					$sql.= ",idfechafin='".$idfechafin."'";

					$sql.= ",dsrequisitos='".$_REQUEST['dsrequisitos_'][$j]."'";
					$sql.= " where id=".$_REQUEST['id_'][$j];
					//echo $sql;
					//exit();
					if ($db->Execute($sql)) $h++;
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
$sql="select a.id,a.dsfechainicial,dshorainicial,dsfechafinal,dshorafinal,dsrequisitos,a.idactivo,a.idhorai,a.idhoraf from $tabla a where idactivo not in(9) and idtv=".$idtv;
$sql.="  and a.idactivo<>999 ";
//echo $sql;
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";

if ($orderby<>"") {
	$sql.=" order by a.$orderby asc ";
} else {
	$sql.=" order by a.id asc ";
}
//echo $sql;
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsm";
		// 2. los tipo de busqueda
		$paramb="dsm";
		$paramn="Nombre";
		//include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	//$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	//$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.="<a href='default.php' class='textlink' title='Tipo de votacion'>Tipo de votaci&oacute;n</a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";

	$dsrutap="../votaciones/tipovotacion/fechainscripcion.php";
	$rutavotaciones="../";
	$idy=$_REQUEST['idtv'];
	$papelera=1;
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {

		include("fechainscripcion.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si
$result->Close();
	include("fechainscripcion.ingreso.php");


	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>