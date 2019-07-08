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
// edicion de datos
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");


$rc4 = new rc4crypt();
$titulomodulo="Estatus de la Configuraci&oacute;n y modulos del sistema";
$tabla=$prefix."tblempresa";
$rutaImagen=$rutxx."../../../contenidos/imagenes/logo_empresa/";

?>
<html>
    <?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

  <? include($rutxx."../../incluidos_modulos/navegador.principal.php");
  include($rutxx."../../incluidos_modulos/core.mensajes.php");

  // generacion del encabezado de acuerdo a los resultados encontrados
$rutamodulo="<a href='$rutxx../core/default.php' target='_top' class='textlink'>Principal</a>  /";
$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
?>



<?
include("empresa.php");
echo "<br>";
include("paginas.php");
?>

<?
    include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>

