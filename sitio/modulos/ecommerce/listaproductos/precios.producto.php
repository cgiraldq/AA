<table id='precio_producto' width=70% class="campos_ingreso campos_ingreso_producto" >
<tr>
	<td colspan="2"><h1 class="tabs_titulo">PRECIOS DEL PRODUCTO <?echo $nombre?></h1></td>
</tr>
	<tr>
		<td colspan=2>
			<table   width=100%>
			<tr valign=top bgcolor="#FFFFFF">
				<td width="25%"><p>Precio compra</p></td>
				<td>
				<? $contadorx="preciocompra_counter";$valorx="255";$campox="preciocompra";?>
				<input type=text name=preciocompra size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_preciocompra')" value="<? echo $preciocompra?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
				<?
				$nombre_capa="capa_preciocompra";
				$mensaje_capa="Debe ingresar el Precio de compra";
				include($rutxx."../../incluidos_modulos/control.capa.php");
				include($rutxx."../../incluidos_modulos/control.letras.php");?>
				</td>
			</tr>
		</table>

		</td>

	</tr>
	<tr>
<td>
	<table border=0>
			<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',1,2)<>""){?>
		<tr valign=top bgcolor="#FFFFFF">
			
			<td width="25%"><p><?echo seldato('dsm','idactivo','ecommerce_tblnombrecampo',1,2)?></p></td>
			<td>
			<? $contadorx="precio1_counter";$valorx="255";$campox="precio1";?>
			<input type=text name=precio1 size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_precio1')" value="<? echo $precio1?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
			<?
			$nombre_capa="capa_precio1";
			$mensaje_capa="Debe ingresar el Precio 1";
			include($rutxx."../../incluidos_modulos/control.capa.php");
			include($rutxx."../../incluidos_modulos/control.letras.php");?>
			</td>
		</tr>
		<?}?>
		<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',2,2)<>""){?>
		<tr>
			<td width="25%"><p><?echo seldato('dsm','idactivo','ecommerce_tblnombrecampo',2,2)?></p></td>
			<td>
			<? $contadorx="precio2_counter";$valorx="255";$campox="precio2";?>
			<input type=text name=precio2 size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_precio2')" value="<? echo $precio2?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
			<?
			$nombre_capa="capa_precio2";
			$mensaje_capa="Debe ingresar el Precio 1";
			include($rutxx."../../incluidos_modulos/control.capa.php");
			include($rutxx."../../incluidos_modulos/control.letras.php");?>
			</td>
		</tr>
		<?}?>
		<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',3,2)<>""){?>
		<tr valign=top bgcolor="#FFFFFF">
			<td width="25%"><p><?echo seldato('dsm','idactivo','ecommerce_tblnombrecampo',3,2)?></p></td>
			<td>
			<? $contadorx="precio3_counter";$valorx="255";$campox="precio3";?>
			<input type=text name=precio3 size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_precio3')" value="<? echo $precio3?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
			<?
			$nombre_capa="capa_precio3";
			$mensaje_capa="Debe ingresar el Precio 1";
			include($rutxx."../../incluidos_modulos/control.capa.php");
			include($rutxx."../../incluidos_modulos/control.letras.php");?>
			</td>
		</tr>
		<?}?>
		<tr>
			<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',4,2)<>""){?>
			<td width="25%"><p><?echo seldato('dsm','idactivo','ecommerce_tblnombrecampo',4,2)?></p></td>
			<td>
			<? $contadorx="precio4_counter";$valorx="255";$campox="precio4";?>
			<input type=text name=precio4 size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_precio4')" value="<? echo $precio4?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
			<?
			$nombre_capa="capa_precio4";
			$mensaje_capa="Debe ingresar el Precio 1";
			include($rutxx."../../incluidos_modulos/control.capa.php");
			include($rutxx."../../incluidos_modulos/control.letras.php");?>
			</td>
		</tr>
		<?}
		if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',5,2)<>""){?>
		<tr valign=top bgcolor="#FFFFFF">
			<td width="25%"><p><?echo seldato('dsm','idactivo','ecommerce_tblnombrecampo',5,2)?></p></td>
			<td>
			<? $contadorx="precio5_counter";$valorx="255";$campox="precio5";?>
			<input type=text name=precio5 size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_precio5')" value="<? echo $precio5?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
			<?
			$nombre_capa="capa_precio5";
			$mensaje_capa="Debe ingresar el Precio 1";
			include($rutxx."../../incluidos_modulos/control.capa.php");
			include($rutxx."../../incluidos_modulos/control.letras.php");?>
			</td>

		</tr>
		<?}?>
		<tr>
			<td colspan=4 align=center>
				<strong>* Valores  Sin Iva </strong>
			</td>
		</tr>


		</table>
</td>


<td class="blq_tabla" >

	<table>
		
		<tr valign=top>
			<td ><p>%Impuestos</p></td>
			<td>
			<? $contadorx="iva_counter";$valorx="255";$campox="iva";?>
			<input type=text name=iva size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_iva')" value="<? echo $iva?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
			<?
			$nombre_capa="capa_iva";
			$mensaje_capa="Debe ingresar el Iva";
			include($rutxx."../../incluidos_modulos/control.capa.php");
			include($rutxx."../../incluidos_modulos/control.letras.php");?>
			</td>
		</tr>
		<tr>

			<td ><p>Valor flete</p></td>
			<td>
			<? $contadorx="dsflete_counter";$valorx="255";$campox="dsflete";?>
			<input type=text name=dsflete size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsflete')" value="<? echo $dsflete?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
			<?
			$nombre_capa="capa_dsflete";
			$mensaje_capa="Debe ingresar el Precio2";
			include($rutxx."../../incluidos_modulos/control.capa.php");
			include($rutxx."../../incluidos_modulos/control.letras.php");?>
			</td>
		</tr>
		<tr valign=top bgcolor="#FFFFFF">


	<!--td class="txt"><p>% Descuento</p></td>
	<td>
	<? $contadorx="descuento_counter";$valorx="255";$campox="descuento";?>
	<input type=text name=descuento size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_descuento')" value="<? echo $descuento?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
	<?
	$nombre_capa="capa_descuento";
	$mensaje_capa="Debe ingresar el Descuento";
	include($rutxx."../../incluidos_modulos/control.capa.php");
	include($rutxx."../../incluidos_modulos/control.letras.php");?>
	</td>
</tr>
		<tr valign=top bgcolor="#FFFFFF">

	<td class="txt"><p>Precio descuento</p></td>
	<td>
	<? $contadorx="preciodescuento_counter";$valorx="255";$campox="preciodescuento";?>
	<input type=text name=preciodescuento size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_preciodescuento')" value="<? echo $preciodescuento?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
	<?
	$nombre_capa="capa_preciodescuento";
	$mensaje_capa="Debe ingresar el Precio de descuento";
	include($rutxx."../../incluidos_modulos/control.capa.php");
	include($rutxx."../../incluidos_modulos/control.letras.php");?>
	</td>
</tr-->

	</table>
</td>
</tr>
</table>