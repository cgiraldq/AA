<article id='responder' class="cont_frm_horizontal  cuerpo_tab" style="display:none;">
		<article class="txt_qsomos">
	<h2>Responder</h2>
	<p></p>
	</article>
	<?  $dsnombrex=$_REQUEST['dsnombrex'];
	if ($dsnombrex<>"") {
	include("modulos/validaciones/comentariob.php"); ?>
	<? } ?>
	<form action="<? echo $pag ?>" name="frm_comentar" method="post" id="frm_comentar">
		<?
			$forma="frm_comentar";
			/*$param="captcha";*/
			$param="dsnombrex,dscorreo,dscom,captcha";
		?>

		<fieldset class="izq_texto">
			<label for="dsnombrex">Nombres *</label>
			<div><input type="text" name="dsnombrex" id="dsnombrex" tabindex="1" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsnombrex','')"></div>
			<span class="camp_requerido" id="capax_dsnombrex" style="display:none;"></span>
		</fieldset>


		<fieldset class="textarea izq_texto">
			<label for="dscom" >Comentarios *</label>
			<div><textarea name="dscom" id="dscom" tabindex="11" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscom','')"></textarea></div>
			<span class="camp_requerido" id="capax_dscom" style="display:none;"></span>
		</fieldset>

		<?//include("incluidos_sitio/captcha.php");?>
		<fieldset class="btns">
			<input type="button" value="Comentar" class="btn_general" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rutbase ?>');">
			<input type="reset" value="Cancelar" class="btn_general">
			<input type="hidden" value="<? echo $idrelacion ?>" name="idblog">
		</fieldset>
	</form>
</article>