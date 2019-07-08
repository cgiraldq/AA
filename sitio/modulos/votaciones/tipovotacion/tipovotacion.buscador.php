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
<td>Seleccione Zona electoral (Muestra las que tengan candidatos):
<select name="idzona">
<option value=""></option>
<?
$sqlx="select idzona from tblcandidatos where id>0 ";
if ($idtv<>"") $sqlx.=" and idtipov=$idtv ";
$sqlx.=" and idactivo<>999 group by idzona order by idzona asc ";
$resultv=$db->Execute($sqlx);
if (!$resultv->EOF) {
while (!$resultv->EOF) {
		$dsm=($resultv->fields[0]);
		?>
		<option value="<? echo $dsm?>" <? if ($_REQUEST['idzona']==$dsm) echo "selected";?>><? echo $dsm?></option>
		<?
		$resultv->MoveNext();
		}
								}
$resultv->Close();
?>
</select>
</td>
<td>
<input type="hidden" name="idtv" value="<? echo $idtv?>"/>
<input type="submit" name="enviar" value="Buscador"/>

</td>
</tr>


</form>
</table>
<br>

</td>
</tr>
</table>