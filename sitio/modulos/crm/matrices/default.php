<?
/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
Imprimir Cotizacion
*/
//include ("../validaciones/sessiones.php");
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
$activareditor=1;
$tiny="Activar editor de texto";

?>

<html>

		<?include($rutxx."../../incluidos_modulos/head.php");?>

  <link rel="stylesheet" href="http://www.comprandofacil.com/pide/corehome/css_modulos/style.core.css" type="text/css" media="all" rel="stylesheet" >
  <link rel="stylesheet" href="<? echo $rutxx;?>../../css_modulos/core.graficas.css">
  <link rel="stylesheet" href="<? echo $rutxx;?>../../css_modulos/core.crm.css">


<body >
	 <? include($rutxx."../../incluidos_modulos/navegador.principal.php");
	   include($rutxx."../../incluidos_modulos/core.mensajes.php");
	   $rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
		$rutamodulo.=" <span class='text1'>Configurtacion de observaciones </span>";
	   include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
	?>
	<br />
 <article class="cont_general">

	<table width="100%" >
	<form action="" method="" name="formOBS">
	<tr>
		<td>

		<?if($activareditor==1){?>
		<input type="button" name="tiny[]" id="tiny[]" value="<? echo $tiny;?>"  class="botones" onclick="validar_tiny('formOBS');">
		<?}?>
<br>
			<textarea name="obs" style="width: 800px; height: 520px;"><? echo utf8_decode($dsobs) ; ?></textarea>
<br>
<?if($activareditor==1){?>
<input type="button" name="tiny[]" id="tiny[]" value="<? echo $tiny;?>"  class="botones" onclick="validar_tiny('formOBS');">
<?}?>

		</td>
	</tr>
	</form>
	</table>
	</article>

	<?
    include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
    include($rutxx."../../incluidos_modulos/modulos.remate.php");
    ?>

    </body>
</html>
