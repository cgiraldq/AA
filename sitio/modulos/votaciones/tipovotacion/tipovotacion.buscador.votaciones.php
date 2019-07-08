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
// Buscador generico
?>
<br>


<table width="100%" cellpadding="0" cellspacing="0" align="center" class="cont_centro">
  <tr>

    <td align="center" valign="top" style="  padding: 30px 0 0 0;">

<table width="70%" border="0" cellpadding="0" cellspacing="0" class="texto_centro">
        <tr>
          <td width="615" align="left"  valign="middle" ><img src="<? echo $rutxx; ?>../../img_modulos/modulos/ingresar_nuevo.png"><h1>Buscador</h1></td>
        </tr>
</table>
<table align="center"  cellspacing="1" cellpadding="1" border="0" width=70% class="campos_ingreso">

<form action="<? echo $pagina;?>" method=post name=u>
<tr valign=top bgcolor="#FFFFFF">
<td>Seleccione Tipo de votaci&oacute;n:
<select name="idtv">
<option value=""> -- Seleccionar -- </option>
<?
$sqlx="select id,dsm from tbltipovotacion where id>0 ";
$sqlx.=" and idactivo<>999 order by dsm asc ";
$resultv=$db->Execute($sqlx);
if (!$resultv->EOF) {
while (!$resultv->EOF) {
		$idtv=($resultv->fields[0]);
		$dsm=($resultv->fields[1]);

		?>
		<option value="<? echo $idtv?>" <? if ($_REQUEST['idtv']==$idtv) echo "selected";?>><? echo $dsm?></option>
		<?
		$resultv->MoveNext();
		}
								}
$resultv->Close();
?>
</select>
</td>
<td>
<input type="submit" name="enviar" value="Buscador"/>

</td>
</tr>


</form>
</table>
<br>

</td>
</tr>
</table>