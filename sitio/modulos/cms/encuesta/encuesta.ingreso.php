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
Juan Fernando Fern�ndez <consultorweb@comprandofacil.com> - Proyectos
Juan Felipe S�nchez <graficoweb@comprandofacil.com> - Dise�o
Jos� Fernando Pe�a <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// Tabla de uso para el ingreso de datos
include($rutxx."../../incluidos_modulos/encabezado.ingreso.php");

?>
<table align="center"  cellspacing="1" cellpadding="1" border="0" width=70% class="campos_ingreso">
			<form action="<? echo $pagina;?>" method=post name=u>
			<tr valign=top bgcolor="#FFFFFF">
				<td>Pregunta</td>
				<td>
				<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
				<textarea name="dsm" cols=60 rows="3" class="text1" onKeyPress="ocultar('capa_dsm')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsm?></textarea>
				<?
				$nombre_capa="capa_dsm";
				$mensaje_capa="Debe ingresar el titulo";
				include($rutxx."../../incluidos_modulos/control.capa.php");
				include($rutxx."../../incluidos_modulos/control.letras.php");
				?>
				</td>
			</tr>
			<tr valign=top bgcolor="#FFFFFF">
				<td>Activar?</td>
				<td>
				<select name=idactivo class=text1>
				<option value="1" <? if ($idactivo==1) echo "selected";?>>SI</option>
				<option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>
				</select>
				</td>
			</tr>
			<tr bgcolor="#FFFFFF" >
				<td colspan=2>
				<?
				$forma="u";
				$param="dsm";
				include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>
				</td>
			</tr>
		</form>
		</table>
		<br>
		</td>
	</tr>
</table>