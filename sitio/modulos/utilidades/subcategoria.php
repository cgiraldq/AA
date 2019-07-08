<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Area Investigacion y Desarrollo
  Area Diseno y Maquetacion
  Area Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// core central de datos
include("../../incluidos_modulos/modulos.globales.php");
$id=$_SESSION['i_idusuario'];
$titulomodulo="Principal";
?>
<html>

    <?include("../../incluidos_modulos/head.php");?>

<body>

      <? include("../../incluidos_modulos/navegador.principal.php");?>

      <? include("manual.subcategorias.php");?>

    <?
    include("../../incluidos_modulos/navegador.principal.cerrar.php");
    include("../../incluidos_modulos/modulos.remate.php");
    ?>

    </body>
</html>