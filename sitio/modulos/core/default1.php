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

$titulomodulo="Principal";
?>
<html>

    <?include("../../incluidos_modulos/head.php");?>

<body>

      <? include("../../incluidos_modulos/navegador.principal.php");?>

      <? include ("core.mensajes.php") ?>


    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="50%" align="center" valign="top">
          <? include ("core.acciones.php") ?>
        </td>

        <td width="50%" align="center" valign="top" >
          <? include ("core.solicitar.php") ?>
        </td>

      </tr>

      <tr>
        <td width="50%" align="center" valign="top">
          <? include ("core.correos.recibidos.php") ?>

        </td>

        <td width="50%" align="center" valign="top" >
          <? include ("core.recomendados.php") ?>

        </td>

      </tr>


    </table>

    <?
    include("../../incluidos_modulos/navegador.principal.cerrar.php");
    include("../../incluidos_modulos/modulos.remate.php");
    ?>

    </body>
</html>