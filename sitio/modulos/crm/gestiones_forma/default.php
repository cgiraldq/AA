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

$titulomodulo="Configuraci&oacute;n de tipos de formas de gestiones";
$dsnombre=$_REQUEST['dsm'];
$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];
$letra=$_REQUEST['letra'];
$tabla="crmtblgestionesformas";
$maxregistros=1; // maximo de registros por pantalla
// insercion
if ($dsnombre<>"" && $idpos<>"") {
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsnombre='$dsnombre' ";
	 	//echo $sql;
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
			$error=1;

		 } else {
		 	// insertar
			$sql="insert into $tabla (dsnombre,idactivo,idpos)";
			$sql.=" values ('$dsnombre','$idactivo','$idpos') ";
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
					$sql.= "dsnombre='".$_REQUEST['dsnombre_'][$j]."'";
					$sql.= ",idactivo='".$_REQUEST['idactivo_'][$j]."'";
					$sql.= ",idpos='".$_REQUEST['idpos_'][$j]."'";

					$sql.= " where id=".$_REQUEST['id_'][$j];
					//echo $sql;
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for
		if ($h>0) $mensajes=$men[4];

?>
<html>
	<?include($rutxx."../../incluidos_modulos/head.php");?>
<body color=#ffffff  topmargin=0 leftmargin=0>
<?
include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsnombre,a.idactivo,idpos from $tabla a where a.idactivo not in(9) ";
$sql.="order by a.idpos asc ";
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
echo "<br>";
if ($_SESSION['i_idperfil']=="-1") {
	$rutamodulo="<a href='default.php' class='textlink'>Principal</a>  /";
} else {
	$rutamodulo="<a href='../../core/default.php' target='_top' class='textlink'>Principal</a>  /";
}
	$rutamodulo.="  <span class='text1'>".$titulomodulo."</span>";
	$papelera=1;
	$dsrutaPapelera="papelera.php";//ruta de la papelera

	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
	include("gestion.tabla.php");
	include("gestion.ingreso.php");

} // fin si
$result->Close();
include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>

