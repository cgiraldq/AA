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

$titulomodulo="Configuracion de negociaciones y presupuestos";
$rutaImagen="../../../contenidos/images/banners/";
$dsm=$_REQUEST['dsm'];
$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];
$letra=$_REQUEST['letra'];
$orderby=$_REQUEST['orderby'];
$idactivox=$_REQUEST['idactivox'];
$idusuario=$_SESSION['i_idusuario'];
$dsusuario=$_SESSION['i_dslogin'];

$idcliente=$_REQUEST['idcliente'];

$dsvalor=$_REQUEST['dsvalor'];

$dsfechai=$_REQUEST['dsfechai'];
$idfechai=str_replace("/","",$_REQUEST['dsfechai']);

$dsfechaf=$_REQUEST['dsfechaf'];
$idfechaf=str_replace("/","",$_REQUEST['dsfechaf']);


$tabla="crmtblnegocios";
// insercion
if ($dsvalor<>"" && $idcliente<>"0|0") {
		$partir=explode("|",$idcliente);
		$idcliente=$partir[1];
		$sql="select id ";
	 	$sql.=" from $tabla WHERE idcliente='$idcliente' ";
	 	  $sql.=" and  idusuario='".$_SESSION['i_idusuario']."' ";
	 	  $sql.=" and  dsfechai='".$dsfechai."' ";

	 	  $sql.=" and  dsfechaf='".$dsfechaf."' ";

		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
			$error=1;
		 } else {
		 	// insertar
			$sql="insert into $tabla (dsm,idactivo,idusuario,dsusuario";
			$sql.=",idcliente,dsvalor,dsfecharegistro,dsfechai,dsfechaf,idfechai,idfechaf)";
			$sql.=" values ('$dsm',$idactivo,$idusuario,'$dsusuario',$idcliente,'$dsvalor','$fechaBaseLarga' ";
			$sql.=",'$dsfechai','$dsfechaf','$idfechai','$idfechaf') ";
//echo $sql;

			if ($db->Execute($sql))  {
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$error=0;
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro de presupuesto o negociaciones";
				$dsruta="../cms/negocios/default.php";
				include($rutxx."../../incluidos_modulos/logs.php");
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
					$sql.= ",dsvalor='".$_REQUEST['dsvalor_'][$j]."'";
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


					$sql.= " where id=".$_REQUEST['id_'][$j];
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
	?>
<?

// generacion del encabezado de acuerdo a los resultados encontrados
$sql="SELECT a.id,a.idcliente,a.dsm,a.dsfecharegistro,b.dscampo3,b.dscampo15,a.dsvalor";
$sql.=",a.dsfechai,a.dsfechaf,a.idactivo";

$sql.=" FROM  crmtblnegocios a, framecf_tblregistro_formularios b WHERE ";
$sql.=" a.idusuario='".$_SESSION['i_idusuario'];
if ($_REQUEST['param']<>"") $sql.=" and ".$_REQUEST['campo']." like '%".$_REQUEST['param']."%'";

$sql.="' and b.id=a.idcliente and a.idactivo not in (9) order by a.id desc ";

	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="b.dscampo3,b.dscampo15";
		// 2. los tipo de busqueda
		$paramb="dsm";
		$paramn="Nombre Cliente,Apellidos Cliente";
		$bannersx=1;
$separador="|";
	$ocultar=1;
	$listar=1;
		$paramb="dscampo3|dscampo15|dscampo2|dscampo8|dscampo9|dscampo10";
	//echo "<br><br><br>";
	$paramn="Nombres|Apellidos|Identificaci&oacute;n|Tel&eacute;fono|Celular|Email";

		include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma&orderby=$orderby&idactivox=$idactivox";
	include($rutxx."../../incluidos_modulos/paginar.variables.php");

$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
		$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
				$papelera=1;
				$dsrutaPapelera="papelera.php";//ruta de la papelera

		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

	if (!$result->EOF) {
		include("tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si
	$result->Close();
	include("ingreso.php");
	?>

	<?
		include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");
	?>

</body>
</html>
