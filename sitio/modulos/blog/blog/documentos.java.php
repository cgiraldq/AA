<?
include("../../incluidos_modulos/version.php");
//include("../../incluidos_modulos/sql.injection.php");
$rutaGalerias="../../../contenidos";
$ruta="images/blog";
if ($ruta<>""){
	 $rutaImagen="".$rutaGalerias."/".$ruta."/";
}


/*
| ----------------------------------------------------------------- |
Sender version 3.5
Un Producto de Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2007
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.net>
  Juan Felipe Sánchez <graficoweb@comprandofacil.net>
  José Fernando Peña <soporteweb@comprandofacil.net>
=====================================================================
| ----------------------------------------------------------------- |
Manejador de imagenes en javascript
*/

?>

// This list may be created by a server logic page PHP/ASP/ASPX/JSP in some backend system.
// There images will be displayed as a dropdown in all image dialogs if the "external_link_image_url"
// option is defined in TinyMCE init.
var tinyMCEImageList = new Array(
	// Name, URL
	["0", "0"]
	<?
	// cargar la ruta de datos de acuerdo a las variables de session
$handle1=@opendir($rutaImagen);
	$j=0;
  while ($file1 = readdir($handle1)) {
		   if ($file1 <> "." && $file1 <> ".." && $file1 <>"peq" && $file1 <>"iconos" && $file1 <>"noticias" && $file1 <>"banner" && $file1 <>"menuderecho" && $file1 <>"Thumbs.db" && $file1 <>"clientes") {

	?>
	,["<? echo $file1?>", "<? echo $rutaImagen?><? echo $file1?>"]
	<?
		}
	} // fin ciclo
	closedir($handle1);
	?>
);
