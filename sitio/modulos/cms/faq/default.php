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
include("../../../incluidos_modulos/modulos.globales.php");

$titulomodulo="Configuracion de Preguntas Frecuentes";
$dsm=$_REQUEST['dsm'];
$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];
$letra=$_REQUEST['letra'];
$tabla="tblfaqs";
$orderby=$_REQUEST['orderby'];
//$carpeta="qsomos";

//$include="include('../../beta/qsomos.php')";
// insercion
if ($dsm<>"" && $idpos<>"") { 
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$dsm' ";
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
		 	$error=1;
			$mensajes=$men[0];
		 } else { 
		 	// insertar
			$sql="insert into $tabla (dsm,idpos,idactivo)";
			$sql.=" values ('$dsm',$idpos,$idactivo) ";
			if ($db->Execute($sql))  { 
				$error=0;
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro";
				$dsruta="../qsomos/default.php";
				include($rutxx."../../incluidos_modulos/logs.php");
				
			} else { 
				$error=1;
				$mensajes=$men[2].".<br><br>$sql<br>Error:".mysql_error();
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
					$sql.= ",dsruta='".$dsrutaPagina."'";
					$sql.= ",idpos=".$_REQUEST['idpos_'][$j]."";
					$sql.= " where id=".$_REQUEST['id_'][$j];
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for	
		if ($h>0) $mensajes=$men[4];

?>

<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<?
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idpos,a.dsimg,a.dsruta,a.idactivo from $tabla a where id>0 and idactivo<>9";
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
	$rutamodulo="<a href='../../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
		$papelera=1;
		$dsrutaPapelera="papelera.php";//ruta de la papelera
		$dsrutap="../cms/faq/default.php";
		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		
		include("ayuda.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si 
$result->Close();
	include("ayuda.ingreso.php");
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>