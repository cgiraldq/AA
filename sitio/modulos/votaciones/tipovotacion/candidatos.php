<?
if ($_REQUEST['enviar']=="Exportar") {
header("Content-type: application/octet-stream");
$nombre="candidatos_".date("Ymdhis").".xls";
header("Content-Disposition: attachment; filename=$nombre");
header("Pragma: no-cache");
header("Expires: 0");

}
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

$titulomodulo="Candidatos";
$dsm=$_REQUEST['dsm'];
$idtv=$_REQUEST['idtv'];
$idactivo=$_REQUEST['idactivo'];

$letra=$_REQUEST['letra'];
$orderby=$_REQUEST['orderby'];
$dstelefono=$_REQUEST['dstelefono'];
$tabla="tblcandidatos";
// insercion
$rutaImagen=$rutxx."../../../contenidos/images/fichatecnica/";
if ($dsm<>"") {
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsasociado='$dsm' and idtv=$idtv ";
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
		 } else {
		 	// insertar
			$sql="insert into $tabla (dsm,idactivo,idtv)";
			$sql.=" values ('$dsm',$idactivo,$idtv) ";
			if ($db->Execute($sql))  {
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro";
				$dsruta="../votaciones/tipovotacion/candidatos.php";
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
if ($_REQUEST['enviar']=="Modificar datos") {
		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
		//			//$sql.= ",idtv=".$_REQUEST['idtv_'][$j];
		//			$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";
					$sql.= " where id=".$_REQUEST['id_'][$j];
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for
		if ($h>0) $mensajes=$men[4];
}
if ($_REQUEST['enviar']<>"Exportar") {

?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
	   include($rutxx."../../incluidos_modulos/core.mensajes.php");
}
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id, a.idasociado, a.idactivo, a.idtipov, a.idzona, a.dsasociado, a.dscedula, a.dscodigo, a.fecharegistro, a.idficha,a.foto,a.idzona ";
$sql.=" from $tabla a inner join tbltipovotacion b on b.id=a.idtipov where a.dsasociado<>'' and a.idactivo not in(9) and a.idtipov=".$idtv;
//echo $sql;
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
if ($_REQUEST['idzona']<>"") $sql.=" and a.idzona='".$_REQUEST['idzona']."'";

if ($orderby<>"") {
	$sql.=" order by a.$orderby asc ";
} else {
	$sql.=" order by a.id desc ";
}
//echo $sql;
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsasociado";
		// 2. los tipo de busqueda
		$paramb="dsasociado";
		$paramn="Nombre";
//		include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador

	if ($_REQUEST['enviar']<>"Exportar") {
		include($rutxx."../../incluidos_modulos/paginar.variables.php");

		$rutaPaginacion="idzona=".$_REQUEST['idzona']."&idtv=".$_REQUEST['idtv']."&letra=".$_REQUEST['letra'];
		$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";


		$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
		$rutamodulo.="<a href='default.php' class='textlink' title='Tipo de votacion'>Tipo de votaci&oacute;n</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";

		$dsrutap="../votaciones/tipovotacion/candidatos.php";
		$rutavotaciones="../";
		$idy=$_REQUEST['idtv'];
		$papelera=1;
		 include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
		 include("tipovotacion.buscador.php");


		$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
		if (!$result->EOF) {

			include("candidatos.tabla.php");
			include($rutxx."../../incluidos_modulos/paginar.php");
			} // fin si
		$result->Close();



	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");

	} else {
		$result=$db->Execute($sql);
		if (!$result->EOF) {

			include("candidatos.tabla.exportar.php");
		} // fin si
		$result->Close();


	}
if ($_REQUEST['enviar']<>"Exportar") {

	?>

</body>
</html>
<?
}
?>