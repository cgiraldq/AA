


<table id='imagenes_producto'width=70% class="campos_ingreso campos_ingreso_producto" >
<tr>
	<td class="tbl_titulo_img">
		<table border=0 width="100%" >
		<tr>
		<td colspan="2"><h1 class="tabs_titulo">IMAGENES DEL PRODUCTO  <?echo $nombre?></h1></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td class="tbl_titulo_img">
		<table border=0 width="100%">
		<tr>
		<td  width="35%" align=center>
			Imagen 800 x 800
		</td>
		<td  width="23%" align=center>
			Nombre
		</td>
		<td  width="15%" align=center>
			Estado
		</td>
			<td  width="23%" align=center>
			Opciones
		</td>
		</tr>
		</table>
	</td>
</tr>
<?
$sqlimg="select id,dsimg,idactivo";
$sqlimg.=" from ecommerce_tblproductoximg where 1";
$sqlimg.="  and iddestino=$idx order by id asc ";
//echo $sqlimg;
$contar=0;
$resultimg = $db->Execute($sqlimg);
if (!$resultimg->EOF) {
while (!$resultimg->EOF) {

	if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		//echo $contar;
	$dsimg=$resultimg->fields[1];
	$estadoimg=$resultimg->fields[2];
	$idimagen=$resultimg->fields[0];
	?>


<tr  bgcolor="<? echo $fondo?>">
<td>
<table border=1 width="100%">
<tr>
<td  width="37%" align=center>
	<?	if (is_file($rutaImagen.$dsimg)) {?>
	<img src="<? echo $rutaImagen.$dsimg;?>" align="absmiddle" border="0">
	<? } ?>
</td>


	<td align=center width="25%">
		<?echo $dsimg?>
	</td>
		<td align=center width="15%">
		<select name="estadoimg_[]" class=text1 >
		  <option value="1" <? if ($estadoimg==1) echo "selected";?>>Principal</option>
		  <option value="2" <? if ($estadoimg==2) echo "selected";?>>Segundario</option>
		</select>

				</td>

	<td align=center >
		<div class="borrar">
			<?
			 $rutax=$pagina."?idimg=".$resultimg->fields[0]."&idx=$idx&idtipoprod=$idtipoprod#imagenes_producto";
		 	 $formax="";
			 include($rutxx."../../incluidos_modulos/enlace.eliminar.php");?>
			<input type="hidden" name="id_[]" value="<? echo $idimagen?>" size="1">
		</div>

	</td>
</tr>

</table>
</td>
</tr>
<?$contar++;
	$resultimg->MoveNext();
		 }
		 }
$resultimg->Close();
?>
<tr><td>
<table border=0 width="100%" >
<tr>
	<td align="center">
		<strong><p>Cargar Imagen</p></strong>
	</td>
	<td align="center">
		<input type=file name=dsimg1 class=text1 onKeyPress="ocultar('capa_dsimg1')" onClick="ocultar('capa_dsimg1')" multiple>
	</td>
	<td align="center">
	<input type=submit name=cargar value="Cargar" class=botones>
	</td>


</tr>
</table>
</td></tr>
</table>