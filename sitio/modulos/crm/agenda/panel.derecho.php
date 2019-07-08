<?
/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2011
Medellin - Colombia
=====================================================================
  Autores:  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
Calendario
*/
?>
<table width="100%" cellspacing="1" cellpadding="1" ID="Table2" class="crm_agendamiento_calendario">

	<tr align="center" valign="top" class="titulo_calendario">
		<td align="center" valign="top" bgcolor="<? echo $fondos[21];?>">
		CALENDARIO
		</td>
	</tr>

	<tr align="center" valign="top" class="subtitulo_calendario">
		<td align="center" valign="top" bgcolor="<? echo $fondos[4];?>">
		Haga click sobre el d&iacute;a seleccionado
		</td>
	</tr>

	<tr align="center" valign="top" class="cont_fechas_calendario">
		<td align="center" valign="top" bgcolor="<? echo $fondos[3];?>">
			<? include ($rutxx."../../incluidos_modulos/calendario.plantrabajo.php");?>
		</td>
	</tr>

</table>
