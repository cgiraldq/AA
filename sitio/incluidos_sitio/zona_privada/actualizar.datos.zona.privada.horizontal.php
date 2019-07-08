<article id='actualizar_datos' class="cont_frm_horizontal cuerpo_tab">
	<article class="txt_qsomos">
	<h2>ACTUALIZAR DATOS</h2>
	<p>Donec vitae nisl turpis, vitae interdum nisl. Nulla sed sollicitudin nunc. Proin rhoncus purus ut erat rhoncus at iaculis enim dapibus. Mauris sed eros in sem porta adipiscing in a arcu.</p>
	</article>
	<form action="modulos/validaciones/actualizar.datos.zona.php" name="frm_actualizar_datos_zona" method="post" id="frm_actualizar_datos_zona">
		<?
			$forma="frm_actualizar_datos_zona";
			/*$param="captcha";*/
			$param="dstipo,dsnombre,dsapellido,dstelefono,dscorreo,dsciudad,dspais,dsdireccion";
		?>

		<fieldset>
			<label for="dsnombre">Nombres *</label>
			<div><input type="text" name="dsnombre" id="dsnombre" tabindex="1" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsnombre','')"></div>
			<span class="camp_requerido" id="capax_dsnombre" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dsapellido">Apellidos</label>
			<div><input type="text" name="dsapellido" id="dsapellido" tabindex="2" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsapellido','')"></div>
			<span class="camp_requerido" id="capax_dsapellido" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dstelefono">Teléfono *</label>
			<div><input type="text" name="dstelefono" id="dstelefono" tabindex="3" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dstelefono','')"></div>
			<span class="camp_requerido" id="capax_dstelefono" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dscorreo">Email *</label>
			<div><input type="text" name="dscorreo" id="dscorreo" tabindex="4" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscorreo','')"></div>
			<span class="camp_requerido" id="capax_dscorreo" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dsciudad">Ciudad *</label>
			<div><input type="text" name="dsciudad" id="dsciudad" tabindex="5" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsciudad','')"></div>
			<span class="camp_requerido" id="capax_dsciudad" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dspais">País *</label>
			<div><input type="text" name="dspais" id="dspais" tabindex="6" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dspais','')"></div>
			<span class="camp_requerido" id="capax_dspais" style="display:none;"></span>
		</fieldset>
		<fieldset class="direccion">
			<label for="dsdireccion">Dirección *</label>
			<div><input type="text" name="dsdireccion" id="dsdireccion" tabindex="10" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsdireccion','')"></div>
			<span class="camp_requerido" id="capax_dsdireccion" style="display:none;"></span>
		</fieldset>
		<article class="agrupar_campos">
			<fieldset>
				<label for="dscontrasena_actual">Contraseña Actual</label>
				<div><input type="password" name="dscontrasena_actual" id="dscontrasena_actual" tabindex="7" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscontrasena_actual','')"></div>
				<span class="camp_requerido" id="capax_dscontrasena_actual" style="display:none;"></span>
			</fieldset>

			<fieldset>
				<label for="dscontrasena_nueva">Nueva Contraseña</label>
				<div><input type="password" name="dscontrasena_nueva" id="dscontrasena_nueva" tabindex="8" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscontrasena_nueva','')"></div>
				<span class="camp_requerido" id="capax_dscontrasena_nueva" style="display:none;"></span>
			</fieldset>

			<fieldset>
				<label for="dscontrasena_nueva_confirmar">Confirmar contraseña</label>
				<div><input type="password" name="dscontrasena_nueva_confirmar" id="dscontrasena_nueva_confirmar" tabindex="9" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscontrasena_nueva_confirmar','')"></div>
				<span class="camp_requerido" id="capax_dscontrasena_nueva_confirmar" style="display:none;"></span>
			</fieldset>
		</article>
		<fieldset class="btns">
			<input type="button" value="Enviar" class="btn_color" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rut ?>');">
			<input type="reset" value="Cancelar" class="btn_color">
		</fieldset>
	</form>
</article>