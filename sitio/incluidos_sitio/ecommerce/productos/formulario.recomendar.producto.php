<article class="cont_frm_horizontal cont_tab_ecommerce_detalle" id="frm_recom_pro" style="display:none;">

	<form action="<? echo $rutbase?>/modulos/validaciones/recomendar.php" name="recomendar" method="post" id="recomendar">
		<?
			$forma="recomendar";
			/*$param="captcha";*/
			$param="dsnombre1,dsemail,dsnombre2,dsemail2,dscom1";
		?>
		<fieldset>
			<label for="dsnombre">Mi Nombre *</label>
			<div><input type="text" name="dsnombre1" id="dsnombre1" tabindex="1" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsnombre1','')"></div>
			<span class="camp_requerido" id="capax_dsnombre1" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dscorreo">Mi Email *</label>
			<div><input type="text" name="dsemail" id="dsemail" tabindex="2" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsemail','')"></div>
			<span class="camp_requerido" id="capax_dsemail" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dsnombre">Nombre de Amigo*</label>
			<div><input type="text" name="dsnombre2" id="dsnombre2" tabindex="3" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsnombre2','')"></div>
			<span class="camp_requerido" id="capax_dsnombre2" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dscorreo">Email de Amigo*</label>
			<div><input type="text" name="dsemail2" id="dsemail2" tabindex="4" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsemail2','')"></div>
			<span class="camp_requerido" id="capax_dsemail2" style="display:none;"></span>
		</fieldset>

		<fieldset class="textarea3">
			<label for="dscom">Comentarios *</label>
			<div><textarea name="dscom1" id="dscom1" tabindex="5" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscom1','')"></textarea></div>
			<span class="camp_requerido" id="capax_dscom1" style="display:none;"></span>
		</fieldset>

		<nav class="btn_derecha2">
			<input type="button" value="Enviar" class="btn_zona" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rut ?>');">
			<input type="reset" value="Cancelar" class="btn_zona">
			<input type="hidden" value="<? echo $rutbase?>/ecommerce.productos.detalle.php?idrelacion=<? echo $idrelacion?>" name="dsrutax">
		</nav>
	</form>
</article>