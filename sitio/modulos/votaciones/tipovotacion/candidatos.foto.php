<?
$rutx=1;
$rutxx="../";

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

$titulomodulo="Subir foto Candidato";
$dsm=$_REQUEST['dsm'];
$idtv=$_REQUEST['idtv'];
$idasociado=$_REQUEST['idasociado'];
$rutaImagen=$rutxx."../../../contenidos/images/fichatecnica/";
if ($_FILES['userfile']['name']<>"") {
		$temp_name =$_FILES['userfile']['tmp_name'];
		$nombre1=$idasociado."_foto_".$_FILES['userfile']['name'];
		if (move_uploaded_file($temp_name,$rutaImagen.$nombre1)) {
				$foto=$nombre1;
		} else {
			$foto = "";
		}
 $sql="update tblcandidatos set foto='$foto' where id=$idasociado ";
	//echo $sql;
 if ($db->Execute($sql)) {
	$mensajes="Datos actualizados con exito";
}

 } else {
	$foto=$_REQUEST['foto'];
 }





?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");

	$rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.="<a href='default.php' class='textlink' title='Tipo de votacion'>Tipo de votacion</a>  /  ";
	$rutamodulo.="<a href='candidatos.php?idtv=$idtv' class='textlink' title='Tipo de votacion'>Candidatos</a>  /  ";

	$rutamodulo.=" <span class='text1'>Subir foto</span>";
	$papelera=1;
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

	include("candidatos.foto.ingreso.php");


	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>