<table id='precio_producto' width=70% class="campos_ingreso campos_ingreso_producto" >
<tr>
	<td colspan="2"><h1 class="tabs_titulo">PRECIOS DEL PRODUCTO <?echo $nombre?></h1></td>
</tr>
	<tr>
		<td colspan=2>
			<table   width=100%>
			<tr valign=top bgcolor="#FFFFFF">
				<td width="25%"><p>Precio compra(Referencia)</p></td>
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
	</table>
</td>
</tr>
</table>