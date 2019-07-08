
<?
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
$idx=$_REQUEST['idproducto'];
$mensaje=$_REQUEST['mensaje'];
$idx=trim($idx);
$display="none";
if($mensaje==1){
	$display="";
	$mensaje="<strong>El registro ha sido eliminado</strong>";
}
if($mensaje==2){
	$display="";
	$mensaje="<strong>El registro ha sido creado en el sistema</strong>";
}
if($mensaje==3){
	$display="";
	$mensaje="<strong>El registro ha sido modificado con  en el sistema</strong>";
}




?>
<form action="" method=post name=p enctype="multipart/form-data">
<table id='tallas' width=70% class="campos_ingreso campos_ingreso_producto">
<tr>
	<td colspan="2">
		<h1 class="tabs_titulo">TALLAS DEL PRODUCTO</h1>
	</td>
	</tr>
<?
$sql_t ="select a.id,c.dsm,b.dsm,c.dsd,a.dsprecio1,a.dsprecio2,a.dsprecio3,a.dsprecio4,a.dsprecio5,a.dsunidad from ecommerce_tbltallasxtblproductos a ,ecommerce_tbltallas b ,ecommerce_tblcolores c";
$sql_t.=" where idorigen=$idx and a.iddestino=b.id and a.idcolor=c.id order by b.idpos asc";
$result_x = $db->Execute($sql_t);
if (!$result_x->EOF) {
	$prexiox_x=0;
?>
<tr>
	<td colspan="2">
		<table width=100%>
			<tr>
				<td><strong><p>Talla</p></strong></td>
				<td><strong><p>Color</p></strong></td>
				<td><strong><p>Unidades Disponibles</p></strong></td>

				<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',1,1)){
				$xprecio1=reemplazar(seldato('dsm','idactivo','ecommerce_tblnombrecampo',1,2));
				$xprecio1x=1;
				$prexiox_x++;
				?>
				<td><strong><p><?echo $xprecio1?></p></strong></td>
				<?}?>

				<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',2,1)){
				$xprecio2=seldato('dsm','idactivo','ecommerce_tblnombrecampo',2,2);
				$xprecio2x=1;
				$prexiox_x++;
				?>
				<td><strong><p><?echo $xprecio2?></p></strong></td>
				<?}?>

				<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',3,1)){
				$xprecio3=reemplazar(seldato('dsm','idactivo','ecommerce_tblnombrecampo',3,2));
				$xprecio3x=1;$prexiox_x++;	
				?>
				<td><strong><p><?echo $xprecio3?></p></strong></td>
				<?}?>

				<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',4,1)){
				$xprecio4=reemplazar(seldato('dsm','idactivo','ecommerce_tblnombrecampo',4,2));
				$xprecio4x=1;$prexiox_x++;?>
				<td><strong><p><?echo $xprecio4?></p></strong></td>
				<?}?>

				<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',5,1)){
				$xprecio5=reemplazar(seldato('dsm','idactivo','ecommerce_tblnombrecampo',5,2));
				$xprecio5x=1;$prexiox_x++;?>
				<td><strong><p><?echo $xprecio5?></p></strong></td>
				<?}?>
				<td><strong><p>Opciones</p></strong></td>
			</tr>
			<?
			$pos=0;
			while (!$result_x->EOF) {

			?>	
			<tr>
				<td>
					<p><?echo $result_x->fields[2]?></p>
				</td>
				<td>
				<p><? echo reemplazar($result_x->fields[1])?></p>
				<div style="cursor:hand;background-color:<? echo $result_x->fields[3];?>;width: 25px;height: 25px;float: left;border: 1px black solid;"></div>
				</td>
				<td>     
					<input type="text" name="dsunidad[]" value="<?echo $result_x->fields[9]?>">
				</td>
				<?if($xprecio1x==1){?>
				<td>     
					<input type="text" name="xprecio_1[]" value="<?echo $result_x->fields[4]?>"></td>
				<?}?>
				<?if($xprecio2x==1){?>
				<td>     
					<input type="text" name="xprecio_2[]" value="<?echo $result_x->fields[5]?>">
				</td>
				<?}?>
				<?if($xprecio3x==1){?>
				<td>     
					<input type="text" name="xprecio_3[]" value="<?echo $result_x->fields[6]?>">
				</td>
				<?}?>
				<?if($xprecio4x==1){?>
				<td>     
					<input type="text" name="xprecio_4[]" value="<?echo $result_x->fields[7]?>">
				</td>
				<?}?>
				<?if($xprecio5x==1){?>
				<td>     
					<input type="text" name="xprecio_5[]" value="<?echo $result_x->fields[8]?>"></td>
				<?}?>
				<td align=center >
					<div class="borrar">
					<a onclick="modificar_talla('<?echo $result_x->fields[0]?>','<?echo $idx?>','<?echo $pos?>','<?echo $prexiox_x?>')" title="Modificar Talla ">Modificar </a>
					<input type="hidden" name="id_[]" value="<? echo $idimagen?>" size="1">
					</div>
					<div class="borrar">
					<a onclick="eliminar_talla('<?echo $result_x->fields[0]?>','<?echo $idx?>')" title="Eliminar Items">Eliminar </a>
					<input type="hidden" name="id_[]" value="<?echo $result_x->fields[0]?>" size="1">
					</div>

				</td>
			</tr>
			<?$contar++;
			$pos++;
			$result_x->MoveNext();
			 }?>

		</table>
	</td>	
</tr>
<?
}
$result_x->Close();
?>
<tr id="capa_mensaje" style="display:<?echo $display?>">
	<td align=center >
		<?echo $mensaje?>
	</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td colspan="2">
	<table width=100% BORDER=1>
<tr>
<td>
<p>Seleccione Talla</p>	
<select name="idtalla" id="idtalla" class=text1>
<option value="">--Seleccione--</option>
<?categorias('ecommerce_tbltallas','')?>
</select>
</td>
<td>
<p>Seleccione Color</p>	
<select name="idcolor" id="idcolor" class=text1>
<option value="">--Seleccione--</option>
<?categorias('ecommerce_tblcolores','')?>
</select>
</td>
<td><p>Unidades Disponibles</p>
<input type="text" name="dsuni_talla" id="dsuni_talla" value="<? echo $dsprecio3?>"  size=10 maxlength="10" class=text1>
</td>
		
<?$preciox=0;?>
<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',1,1)){$preciox++;?>
<td align="center">
<p><?echo reemplazar(seldato('dsm','idactivo','ecommerce_tblnombrecampo',1,2))?></p>
<input type="text" name="dsprecio_1" id="dsprecio_1" value="<? echo $dsprecio1?>" size=10 maxlength="10" class=text1>
</td>
<?}?>
<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',2,1)){$preciox++;?>
<td align="center">
<p><?echo reemplazar(seldato('dsm','idactivo','ecommerce_tblnombrecampo',2,2))?></p>
<input type="text" name="dsprecio_2" id="dsprecio_2" value="<? echo $dsprecio2?>" size=10 maxlength="10" class=text1 >
</td>
<?}?>
<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',3,1)){$preciox++;?>
<td align="center">
<p><?echo reemplazar(seldato('dsm','idactivo','ecommerce_tblnombrecampo',3,2))?></p>
<input type="text" name="dsprecio_3" id="dsprecio_3" value="<? echo $dsprecio3?>"  size=10 maxlength="10" class=text1>
</td>
<?}?>
<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',4,1)){$preciox++;?>
<td align="center">
<p><?echo reemplazar(seldato('dsm','idactivo','ecommerce_tblnombrecampo',4,2))?></p>
<input type="text" name="dsprecio_4" id="dsprecio_4" value="<? echo $dsprecio4?>" size=10 maxlength="10" class=text1>
</td>
<?}?>
<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',5,1)){$preciox++;?>
<td align="center">
<p><?echo reemplazar(seldato('dsm','idactivo','ecommerce_tblnombrecampo',5,1))?></p>
<input type="text" name="dsprecio_5" id="dsprecio_5" value="<? echo $dsprecio5?>" size=10 maxlength="10" class=text1>
</td>
<?}?>
	<td>
	<input type=button name=enviar value="Guardar" class=botones onclick="guardar_talla('<?echo $preciox?>','<?echo $idx?>')">
	</td>

 </tr>
	</table>	

	</td>

</tr>
</table>
</form>
<?
include("../../../incluidos_modulos/cerrarconexion.php");


//echo $data;
?>