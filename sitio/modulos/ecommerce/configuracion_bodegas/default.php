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
$titulomodulo="Configuracion de Bodegas";
$dsciudad=$_REQUEST['dsciudad'];
$dsdep=$_REQUEST['dsdep'];
$dsdir=$_REQUEST['dsdir'];
$dspais=$_REQUEST['dspais'];
$dsm=$_REQUEST['dsm'];
$idactivo=$_REQUEST['idactivo'];
$dstel=$_REQUEST['dstel'];

if ($idactivo=="") $idactivo=1;
$letra=$_REQUEST['letra'];
$tabla="tblbodegas";
$orderby=$_REQUEST['orderby'];
//$carpeta="qsomos";

//$include="include('../../beta/qsomos.php')";
// insercion
if ($dsciudad<>"" && $dspais<>"") { 
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsciudad='$dsciudad'";
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	$error=0;
			$mensajes=$men[0];
		 } else { 
		 	// insertar
			$sql="insert into $tabla (dsm,dsciudad,dsdep,dsdir,dspais,idactivo,dstel)";
			$sql.=" values ('$dsm','$dsciudad','$dsdep','$dsdir','$dspais',$idactivo,'$dstel') ";
			if ($db->Execute($sql))  { 
				$error=0;
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro";
				$dsruta="../bodegas/default.php";
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
					//$dsarchivo=limpieza(strtolower($_REQUEST['dsm_'][$j])).".php";
					//$dsrutaPagina=generarPagina($dsarchivo,$carpeta,$_REQUEST['dsm_'][$j],$_REQUEST['id_'][$j],$include);


					$sql=" update $tabla set ";
					$sql.= "dsciudad='".$_REQUEST['dsciudad_'][$j]."'";
					$sql.= ",dsdir='".$_REQUEST['dsdir_'][$j]."'";
					$sql.= ",dsdep='".$_REQUEST['dsdep_'][$j]."'";
					$sql.= ",dspais='".$_REQUEST['dspais_'][$j]."'";
					$sql.= ",dstel='".$_REQUEST['dstel_'][$j]."'";
					$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";
					$sql.= ",idactivo='".$_REQUEST['idactivo_'][$j]."'";

					$sql.= " where id=".$_REQUEST['id_'][$j];
					//echo $sql;
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
$sql="select a.id,a.dsciudad,a.dsdep,a.dsdir,a.idactivo,a.dspais,a.dstel,a.dsm from $tabla a where id>0 and a.idactivo<>9 ";
//echo $sql;
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
if ($orderby<>"") { 
	$sql.=" order by a.$orderby asc ";
} else { 
	$sql.=" order by a.dspais asc,a.dsdep asc,a.dsciudad asc,a.idpos asc ";
}
//echo $sql;
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsciudad";
		// 2. los tipo de busqueda
		$paramb="dsciudad,dspais,dsdep";
		$paramn="Nombre,Pais,Departamento";
		include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";
	$maxregistros=200;
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	$rutamodulo="<a href='../../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
		$papelera=2;
		$dscampo="dsciudad";
		$dsrutap="../ecommerce/bodegas/default.php";
		$dsrutaPapelera="papelera.php";//ruta de la papelera


		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		
		include("bodegas.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si 
$result->Close();
	include("bodegas.ingreso.php");
		include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>