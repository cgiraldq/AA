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

$titulomodulo="Resultados de la negociacion con cliente seleccionada";
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
$tabla="crmtblnegocios_resultados";
// insercion
if ($dsvalor<>"" && $dsm<>"") {
		$partir=explode("|",$idcliente);
		$idcliente=$partir[1];
		$sql="select id ";
	 	$sql.=" from $tabla WHERE idnegocio='$idcliente' ";
	 	  $sql.=" and  dsvalor='".$dsvalor."'  and dsm='$dsm' ";

		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
			$error=1;
		 } else {
		 	// insertar
			$sql="insert into $tabla (dsm,idactivo,idusuario,dsusuario";
			$sql.=",idnegocio,dsvalor,dsfecharegistro,dsfechai,dsfechaf,idfechai,idfechaf)";
			$sql.=" values ('$dsm',0,$idusuario,'$dsusuario',$idnegocio,'$dsvalor','$fechaBaseLarga' ";
			$sql.=",'$dsfechai','$dsfechaf','$idfechai','$idfechaf') ";
			if ($db->Execute($sql))  {
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$error=0;
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro de resultado de negocio $idnegocio ";
				$dsruta="../cms/negocios/resultados.php?idnegocio=$idnegocio";
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
?>
<html>
	<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
	   include($rutxx."../../incluidos_modulos/core.mensajes.php");
	?>
<?

// generacion del encabezado de acuerdo a los resultados encontrados
$sql="SELECT a.id,a.dsvalor,a.dsfecharegistro";
$sql.=",a.dsm";
$sql.=" FROM  crmtblnegocios_resultados a WHERE ";
$sql.=" a.idnegocio='".$idnegocio;
$sql.="' and a.idactivo not in (9) order by a.id desc ";
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion.="&idnegocio=$idnegocio&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma&orderby=$orderby&idactivox=$idactivox";
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
		$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
		$rutamodulo="<a href='default.php' class='textlink' title='Negociaciones'>Negociaciones</a>  /  ";

		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";

				$papelera=1;
				$dsrutaPapelera="papelera.php";//ruta de la papelera

		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

	if (!$result->EOF) {
		include("resultados.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si
	$result->Close();
	include("resultados.ingreso.php");
	?>

	<?
		include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");
	?>

</body>
</html>
