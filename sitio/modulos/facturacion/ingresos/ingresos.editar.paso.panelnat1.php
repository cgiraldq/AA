<tr class=forma2  bgcolor="<? echo $color;?>" align="center" onMouseOut="mOut(this,'<? echo $color;?>');" onMouseOver="mOvr(this,'<? echo $colorx;?>');" id="filax_<? echo $i?>_<? echo $j?>" style="display:">
		<td valign=top class="link_negro1">
		<? //  echo $i;?>
		<input type=hidden name="idx[]" value="<? echo $i?>">

		<input type='text' name="idpedido[]" class='link_negro1' size='10' maxlength=20 id="idpedido[]" value="<? echo $_REQUEST['idpedido'][$i];?>" onKeypress="moverfoco_1(2,'iddescripcion[]',<? echo $i;?>)">

		
		</td>
		<td valign=top class="link_negro1">
		<select name='iddescripcion[]' class="link_negro1" onKeyPress="moverfoco_1(2,'dsvalor[]',<? echo $i;?>)">
		<option value="3">OTROS</option>
		<option value="4">ANTICIPO</option>
		
		</select>
		</td>
		<td valign=top class="link_negro1">
		<input type='text' name="dsvalor[]" class='link_negro1' size='10' maxlength=20 id="dsvalor[]" value="<? echo $total;?>" onBlur="totales();" onKeypress="moverfoco_1(2,'dscom[]',<? echo $i;?>)">
		</td>
		<td valign=top class="link_negro1"><input type='text' name="dscom[]" class='link_negro1' size='35' maxlength=255 id="dscom[]" value="<? echo $z;?>" onKeypress="moverfoco_1(2,'dscuentacontable[]',<? echo $i;?>)"></td>
		<td valign=top class="link_negro1"><input type='text' name="dscuentacontable[]" class='link_negro1' size='10' maxlength=20 id="dscuentacontable[]" value="<? echo $x;?>" onKeypress="moverfoco_1(2,'dsnaturaleza[]',<? echo $i;?>)"></td>
		<td valign=top class="link_negro1">
		
		<? if ($j<3) { ?> 
		<input type='text' name="dsnaturaleza[]" class='link_negro1' size='2' maxlength=2 id="dsnaturaleza[]" value="1" onBlur="totales();" onKeypress="moverfoco_1(2,'idpedido[]',<? echo $i+1;?>)">
		<? } else { ?>
		<input type='text' name="dsnaturaleza[]" class='link_negro1' size='2' maxlength=2 id="dsnaturaleza[]" value="1" onBlur="totales();" onKeypress="moverfoco_1(1,'subdsvalor',<? echo $i+1;?>)">
		<? } ?>

		
		</td>
		<td valign=top class="link_negro1">&nbsp;</td>
		</tr>

