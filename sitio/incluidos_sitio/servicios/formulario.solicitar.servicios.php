<article class="cont_frm_horizontal" id="frm_solicitar_pro_1" style="display:none">


	<form action="<? echo $rutalocal;?>/modulos/validaciones/contacto.servicio.php" name="frm_solicitar" method="post" id="frm_solicitar">

		<a href="javascript:Abrir_ventana('../info.frm.php')" class="ver_mas"><p>POLÍTICA DE TRATAMIENTO DE DATOS PERSONALES</p></a>

		<?
			$forma="frm_solicitar";
			/*$param="captcha";*/
			$param="dsproducto,dsnombre,dsapellido,dscorreo,dstelefono,dscelular,dsciudad,dspais,dsdireccion,dscom,captcha";
		?>
		<fieldset>
			<label for="dsproducto">Asesor Solicitado*</label>
			<div><input readonly="" type="text" name="dsproducto" id="dsproducto" value="<?echo $dsm;?>" onkeypress="ocultar('capax_dsproducto')"></div>
			<span class="camp_requerido" id="capax_dsproducto" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dsnombre">Nombres *</label>
			<div><input type="text" name="dsnombre" id="dsnombre" onkeypress="ocultar('capax_dsnombre')"></div>
			<span class="camp_requerido" id="capax_dsnombre" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dsapellido">Apellido *</label>
			<div><input type="text" name="dsapellido" id="dsapellido" onkeypress="ocultar('capax_dsapellido')"></div>
			<span class="camp_requerido" id="capax_dsapellido" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dscorreo">Email *</label>
			<div><input type="text" name="dscorreo" id="dscorreo" onkeypress="ocultar('capax_dscorreo')"></div>
			<span class="camp_requerido" id="capax_dscorreo" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dstelefono">Tel&eacute;fono *</label>
			<div><input type="text" name="dstelefono" id="dstelefono" onkeypress="ocultar('capax_dstelefono')"></div>
			<span class="camp_requerido" id="capax_dstelefono" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dscelular">Celular *</label>
			<div><input type="text" name="dscelular" id="dscelular" onkeypress="ocultar('capax_dscelular')"></div>
			<span class="camp_requerido" id="capax_dscelular" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dsciudad">Ciudad *</label>
			<div><input type="text" name="dsciudad" id="dsciudad" onkeypress="ocultar('capax_dsciudad')"></div>
			<span class="camp_requerido" id="capax_dsciudad" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dspais">Pa&iacute;s *</label>
			<div><input type="text" name="dspais" id="dspais" onkeypress="ocultar('capax_dspais')"></div>
			<span class="camp_requerido" id="capax_dspais" style="display:none;"></span>
		</fieldset>

		<fieldset class="direccion">
			<label for="dsdireccion">Direcci&oacute;n *</label>
			<div><input type="text" name="dsdireccion" id="dsdireccion" onkeypress="ocultar('capax_dsdireccion')"></div>
			<span class="camp_requerido" id="capax_dsdireccion" style="display:none;"></span>
		</fieldset>

		<fieldset class="textarea">
			<label for="dscom">Comentarios *</label>
			<div><textarea style="height: 100px;" name="dscom" id="dscom" tabindex="11" onkeypress="ocultar('capax_dscom')"></textarea></div>
			<span class="camp_requerido" id="capax_dscom" style="display:none;"></span>
		</fieldset>

		<?include("incluidos_sitio/captcha.php");?>
		<fieldset class="btns">
			<input type="button" value="Enviar" class="btn_color" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rutalocal."/" ?>');">
			<input type="hidden" name="ruta" value="<? echo $autorizado."/mis_servicios/".$_REQUEST['dsnombre'];?>">

			<!--	input type="reset" value="Cancelar" class="btn_general" -->
		</fieldset>
	</form>
</article>