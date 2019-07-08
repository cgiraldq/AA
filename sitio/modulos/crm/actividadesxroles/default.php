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
// root / empresa
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");


$titulomodulo="Configuraci&oacute;n de tipos de actividades por roles";
$dsnombre=$_REQUEST['dsm'];
$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];
$letra=$_REQUEST['letra'];
$tabla="crmtblactividades_roles";
$maxregistros=1; // maximo de registros por pantalla
// insercion
if ($dsnombre<>"" && $idpos<>"") {
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$dsnombre' ";
	 	//echo $sql;
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
			$error=1;

		 } else {
		 	// insertar
			$sql="insert into $tabla (dsm,idactivo)";
			$sql.=" values ('$dsnombre','$idactivo') ";
			//echo $sql;
			if ($db->Execute($sql))  {
				$mensajes="<strong>".$men[1]."</strong>";
				$error=0;

			} else {
				$mensajes=$men[2].".<br><br>$sql";
				$error=1;

			}
		 }
		 $result->close();
}
include($rutxx."../../incluidos_modulos/modulos.papelera.php");
// modificacion rapida
		$contar=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contar;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$sql=" update $tabla set ";
					$sql.= "dsm='".$_REQUEST['dsnombre_'][$j]."'";
					$sql.= ",idactivo='".$_REQUEST['idactivo_'][$j]."'";
					$sql.= ",idcat='".$_REQUEST['idcat_'][$j]."'";

					$sql.= " where id=".$_REQUEST['id_'][$j];
					//echo $sql;
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for
		if ($h>0) $mensajes=$men[4];

?>
<html>
<head>
	<?include($rutxx."../../incluidos_modulos/head.php");?>
</head>
<body color=#ffffff  topmargin=0 leftmargin=0>
<?
include($rutxx."../../incluidos_modulos/navegador.principal.php");


if ($_SESSION['i_idperfil']=="-1") {
	$rutamodulo="<a href='../../root/default.php' class='textlink'>Principal</a>  /";
} else {
	$rutamodulo="<a href='../../core/default.php' target='_top' class='textlink'>Principal</a>  /";
}
	$rutamodulo.="  <span class='text1'>".$titulomodulo."</span>";
	$papelera=1;

	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
	// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idactivo,idtipo,idcat from $tabla a where a.idactivo not in(9) ";
$sql.="order by a.idtipo asc ";
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();

	include("actividades.tabla.php");


} // fin si
$result->Close();

include("actividades.ingreso.php");
include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>

