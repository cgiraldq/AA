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
// root / modulos
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

$rc4 = new rc4crypt();
$titulomodulo="Bloqueo IP";
$dsm=$_REQUEST['dsm'];
$idactivo=$_REQUEST['idactivo'];
$dsautorizado=$_REQUEST['dsautorizado'];
$letra=$_REQUEST['letra'];
$tabla="tblbloqueoip";
$dir = $rc4->encrypt($s3m1ll4, $dsm);
$dire = urlencode($dir);
// insercion
if ($dsm<>"") {
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$dire' ";
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
		 } else {
		 	$clavee = $rc4->encrypt($s3m1ll4, $dsm);
			$clave = urlencode($clavee);
		 	// insertar
			$sql="insert into $tabla (dsm,idactivo,dsautorizado)";
			$sql.=" values ('$clave',$idactivo,'$dsautorizado') ";
			//echo $sql;
			if ($db->Execute($sql))  {
				$mensajes="<strong>".$men[1]."</strong>";
			} else {
				$mensajes=$men[2].".<br><br>$sql";
			}
		 }
		 $result->close();
}
// eliminacion
$idx=$_REQUEST['idx'];
if ($idx<>"") {
	$sql=" delete from $tabla WHERE id='$idx' ";
	if ($db->Execute($sql))  {
		$mensajes="<strong>".$men[3]."</strong>";
	}
}
// modificacion rapida
		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$clavee = $rc4->encrypt($s3m1ll4, $_REQUEST['dsm_'][$j]);
					$clave = urlencode($clavee);
					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
					$sql.= ",dsm='".$clave."'";
					$sql.= ",dsautorizado='".$_REQUEST['dsautorizado_'][$j]."'";
					$sql.= " where id=".$_REQUEST['id_'][$j];
					//echo $sql;
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
$sql="select a.id,a.dsm,a.idactivo,a.dsautorizado from $tabla a where id>0 ";
//echo $sql;
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
$sql.=" order by a.id asc ";
//echo $sql;
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsm";
		// 2. los tipo de busqueda
		$paramb="dsm";
		$paramn="Direccion IP";
			//include("../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	//$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";
	include($rutxx."../../incluidos_modulos/paginar.variables.php");

$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		$dsclave = $rc4->decrypt($s3m1ll4, urldecode($dsm));
		$rutamodulo="<a href='$rutxx../root/default.php' class='textlink' title='Principal'>Principal</a>  /  <span class='text1'>".$titulomodulo."</span>";
		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
		include("bloqueoip.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si
$result->Close();
	include("bloqueoip.ingreso.php");

	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>

