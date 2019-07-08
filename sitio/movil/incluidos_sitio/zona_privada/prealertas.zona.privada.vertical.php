<article id='prealertas' class="cont_frm_horizontal cuerpo_tab">
	<article class="txt_qsomos">
	<h2>Pre-Alerte su Mercanc&iacute;a</h2>
	<p>Diligencia el siguiente formulario para prealertar sus productos que llegar&aacute;n a su casillero virtual.</p>
	</article>
	<form action="modulos/validaciones/prealertar.php" name="frm_actualizar_prealerta" method="post" id="frm_actualizar_prealerta" enctype="multipart/form-data">
		<?
			$forma="frm_actualizar_prealerta";
			/*$param="captcha";*/
           	$param="dsnombre,dstrackingnumber,dsvalordeclarado,dstienda,dscom";

		?>

		<fieldset>
			<label for="dsnombre">Nombres *</label>
			<div><input type="text" name="dsnombre" id="dsnombre" value="<? echo $_SESSION['i_dsnombre']?>" tabindex="1" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsnombre','')"></div>
			<span class="camp_requerido" id="capax_dsnombre" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dstrackingnumber">Número de Tracking</label>
			<div><input type="text" name="dstrackingnumber" id="dstrackingnumber" tabindex="2" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dstrackingnumber','')"></div>
			<span class="camp_requerido" id="capax_dstrackingnumber" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dsvalordeclarado">Valor Declarado *</label>
			<div><input type="text" name="dsvalordeclarado" id="dsvalordeclarado" tabindex="3" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsvalordeclarado','')"></div>
			<span class="camp_requerido" id="capax_dsvalordeclarado" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dscompania">Compa&ntilde;&iacute;a Courier *</label>
			<div><input type="text" name="dscompania" id="dscompania" tabindex="4" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscompania','')"></div>
			<span class="camp_requerido" id="capax_dscompania" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dstienda">Tienda donde Compro *</label>
			<div><input type="text" name="dstienda" id="dstienda" tabindex="5" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dstienda','')"></div>
			<span class="camp_requerido" id="capax_dstienda" style="display:none;"></span>
		</fieldset>
		<fieldset class="direccion">
			<label for="archivo">Prueba o Factura de compra *</label>
			<div><input type="file" name="archivo" id="archivo" tabindex="6" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_archivo','')"></div>
			<span class="camp_requerido" id="capax_archivo" style="display:none;"></span>
		</fieldset>

		<fieldset class="direccion">
			<label for="archivo">Fecha estimada de llegada</label>
			<div><input type="text" name="dsfechallegada" id="dsfechallegada" tabindex="7"></div>
			<span class="camp_requerido" id="capax_dsfechallegada" style="display:none;"></span>
		</fieldset>


		<fieldset class="textarea">
			<label for="dscom">Comentarios *</label>
			<div><textarea name="dscom" id="dscom" tabindex="8" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscom','')"></textarea></div>
			<span class="camp_requerido" id="capax_dscom" style="display:none;"></span>
		</fieldset>

		<fieldset class="btns">
			<input type="button" value="Enviar" tabindex="9" class="btn_general" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rut ?>');">
			<input type="reset" value="Cancelar" class="btn_general">
			<input type=hidden name="add" value="<? echo $add?>">
			<input type=hidden name="dsrutax" value="<? echo $rutaComprasYpagos?>">

		</fieldset>
	</form>
</article>