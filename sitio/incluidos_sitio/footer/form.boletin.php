<article class="form_boletin_footer">
	<h3><span>Suscríbete</span> a nuestro boletín</h3>
	<form action="<?echo $rut?>modulos/validaciones/suscripcion.php" method="POST" name="frm_suscripcion" id="frm_suscripcion">
			<?
				$forma="frm_suscripcion";
				$param="dscorreo_suscrip";
			?>
		<fieldset>
			<legend>Escribe tu correo</legend>
			<input type="text" name="dscorreo_suscrip" id="dscorreo_suscrip" value="<? echo $_SESSION['i_dscorreo_suscrip']?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscorreo_suscrip','')">
			<input type="hidden" name="dstipo" value="3">
			<input type="button" value="Suscríbete" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rut ?>');">
			<span class="camp_requerido" id="capax_dscorreo_suscrip" style="display:none;"></span>
		</fieldset>
	</form>
</article>