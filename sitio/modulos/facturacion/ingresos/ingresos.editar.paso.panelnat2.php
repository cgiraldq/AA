		<tr class=forma2  bgcolor="<? echo $color;?>" align="center" title="<? echo $mem;?>" onMouseOut="mOut(this,'<? echo $color;?>');" onMouseOver="mOvr(this,'<? echo $colorx;?>');">
		<td valign=top class="link_negro1">
		<input type='text' name="idpedido[]" class='link_negro1' size='10' maxlength=20 id="idpedido[]" value="<? echo $vermas->fields[1];?>" onKeypress="moverfoco_1(2,'iddescripcion[]',<? echo $i;?>)">
		<input type=hidden name="idx[]" value="<? echo $i?>">
		</td>
		<td valign=top class="link_negro1">
		<select name='iddescripcion[]' class="link_negro1" onKeyPress="moverfoco_1(2,'dsvalor[]',<? echo $i;?>)">
		<option value="">---</option>
		<option value="1" <? if ($y=="1") echo "selected";?>>CANCELACION</option>
		<option value="2" <? if ($y=="2") echo "selected";?>>ABONANDO</option>
		<option value="4" <? if ($y=="4") echo "selected";?>>ANTICIPO</option>

		</select>
		</td>
		<td valign=top class="link_negro1">
		<input type='text' name="dsvalor[]" class='link_negro1' size='10' maxlength=20 id="dsvalor[]" value="<? echo $total;?>" onBlur="totales();" onKeypress="moverfoco_1(2,'dscuentacontable[]',<? echo $i;?>)">
		</td>
		<td valign=top class="link_negro1"><input type='hidden' name="dscom[]" id="dscom[]">
		<?
		echo "Total Factura: $ ".number_format($fila->dstotal,0,",",".");	
		?>
		</td>
		<td valign=top class="link_negro1">
		<input type='text' name="dscuentacontable[]" class='link_negro1' size='10' maxlength=20 id="dscuentacontable[]" value="<? echo $x?>" onKeypress="moverfoco_1(2,'dsnaturaleza[]',<? echo $i;?>)"></td>
		<td valign=top class="link_negro1"><input type='text' name="dsnaturaleza[]" class='link_negro1' size='2' maxlength=2 id="dsnaturaleza[]" value="<? echo $dsnaturaleza?>" onBlur="totales();" onKeypress="moverfoco_1(2,'idpedido[]',<? echo $i+1;?>)"></td>
		<td valign=top class="link_negro1">
		<?
		// calcular pendientes por cobrar	
		if ($total>0)  { // abonando?>
		<a href="#" onClick="irAPaginaDN('../facturacion/facturar.imprimir.html.php?idpedido=<? echo $vermas->fields[1];?>&enca=1&no=1');" title="Click para imprimir"><img src="../../../img_modulos/alerta.gif" align=absmiddle title="Pendiente por finalizar pago" border=0></a>
		<br>
		<?}elseif ($total<=0) {  // cancelado?>
		<img src="../../../img_modulos/vistobueno.gif" align=absmiddle title="Cancelado">
		<? } else {  // pendiente  ?>
		<a href="#" onClick="irAPaginaDN('../facturacion/facturar.imprimir.html.php?idpedido=<? echo $vermas->fields[1];?>&enca=1&no=1');" title="Click para imprimir"><img src=".../../../img_modulos/faq_g.gif" align=absmiddle title="Pendiente" border=0></a>
		<? } ?>
		</td>
		</tr>
