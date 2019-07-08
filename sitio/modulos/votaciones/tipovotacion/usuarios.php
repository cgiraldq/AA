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
$rutxx="../";

include($rutxx."../../incluidos_modulos/version.php");
include($rutxx."../../incluidos_modulos/comunes.php");
include($rutxx."../../incluidos_modulos/varconexion.php");
include($rutxx."../../incluidos_modulos/modulos.funciones.php");
include($rutxx."../../incluidos_modulos/sql.injection.php");
include($rutxx."../../incluidos_modulos/sessiones.php");
include($rutxx."../../incluidos_modulos/varmensajes.php");
include($rutxx."../../incluidos_modulos/class.rc4crypt.php");
include($rutxx."../../incluidos_modulos/bloqueo.ip.php");

$titulomodulo="Usuarios";
$dsm=$_REQUEST['dsm'];
$dslogin=$_REQUEST['dslogin'];
$dsclave=$_REQUEST['dsclave'];
$idtv=$_REQUEST['idtv'];
$idactivo=$_REQUEST['idactivo'];
$letra=$_REQUEST['letra'];
$orderby=$_REQUEST['orderby'];
$dstelefono=$_REQUEST['dstelefono'];
$tabla="tblusuariosvot";
// insercion
$dsruta="../tipovotacion/default.php";
if ($dsm<>"") { 
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$dsm' ";
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
		 } else { 
		 	// insertar
			$sql="insert into $tabla (dsm,idactivo,dslogin,dsclave,idtv)";
			$sql.=" values ('$dsm',$idactivo,'$dslogin','$dsclave',$idtv) ";
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
					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
					$sql.= ",dslogin='".$_REQUEST['dslogin_'][$j]."'";
					$sql.= ",dsclave='".$_REQUEST['dsclave_'][$j]."'";
					$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";
					$sql.= " where id=".$_REQUEST['id_'][$j];
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for	
		if ($h>0) $mensajes=$men[4];

?>
<html>
<head>
<title><? echo $AppNombre;?></title>
<? include($rutxx."../../incluidos_modulos/sub.encabezado.php");?>
</head>
<body color=#ffffff  topmargin=0 leftmargin=0>
<?
include($rutxx."../../incluidos_modulos/modulos.encabezado.php");
include($rutxx."../../incluidos_modulos/modulos.mensajes.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idactivo,a.dslogin,a.dsclave from $tabla a where a.idtv=".$idtv;

if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";

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
		include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	//$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	//$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	$rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.="<a href='default.php' class='textlink' title='Tipo de votacion'>Tipo de votacion</a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	$papelera=1;	
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		
		include("usuarios.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si 
$result->Close();
	include("usuarios.ingreso.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>