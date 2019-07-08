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


$titulomodulo="Configuraci&oacute;n de la empresa autorizada";
$dsnombre=$_REQUEST['dsnombre'];
$dsnit=$_REQUEST['dsnit'];
$idactivo=$_REQUEST['idactivo'];
$letra=$_REQUEST['letra'];
$tabla=$prefix."tblempresa";
$maxregistros=1; // maximo de registros por pantalla
// insercion
if ($dsnombre<>"" && $dsnit<>"") {
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsnombre='$dsnombre' ";
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
			$error=1;

		 } else {
		 	// insertar
			$sql="insert into $tabla (dsnombre,dsnit)";
			$sql.=" values ('$dsnombre','$dsnit') ";
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
// eliminacion
$idx=$_REQUEST['idx'];
if ($idx<>"") {
	$sql=" delete from $tabla WHERE id='$idx' ";
	if ($db->Execute($sql))  {
		$mensajes="<strong>".$men[3]."</strong>";
		$error=0;

	}
}
// modificacion rapida
		$contar=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contar;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$sql=" update $tabla set ";
					$sql.= "dsnombre='".$_REQUEST['dsnombre_'][$j]."'";
					$sql.= ",dsnit='".$_REQUEST['dsnit_'][$j]."'";
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
	// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsnombre,a.dsnit from $tabla a ";
$sql.="order by a.dsnombre asc ";
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
echo "<br>";
if ($_SESSION['i_idperfil']=="-1") {
	$rutamodulo="<a href='$rutxx../root/default.php' class='textlink'>Principal</a>  /";
} else {
	$rutamodulo="<a href='$rutxx../root/default.php' target='_top' class='textlink'>Principal</a>  /";
}
	$rutamodulo.="  <span class='text1'>".$titulomodulo."</span>";
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
	include("empresa.tabla.php");

} // fin si
$result->Close();
if ($totalregistros<1) 	include("empresa.ingreso.php");
		include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>

