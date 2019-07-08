<article class="bloque_formularios" >
		<article class="txt_qsomos">
			<h1>CONTACTO</h1>
		</article>

		<p>Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayoría sufrió alteraciones en alguna manera, ya sea porque se le agregó humor,
		o palabras aleatorias que no parecen ni un poco creíbles. Si vas a utilizar un pasaje</p>

			<article class="cont_frm_horizontal_dividido2">
	<form action="modulos/validaciones/contacto.php" name="frm_contacto" method="post" id="frm_contacto">
		<?
			$forma="frm_contacto";
			/*$param="captcha";*/
			$param="dstipo,dsnombre,dsapellido,dstelefono,dscorreo,dsciudad,dspais,dsdireccion,dscom,captcha";
		?>


<!--  BLOQUE IZQUIERDA  -->
<div class="bloque_izq">
		<fieldset>
			<label for="dstipo">Tipo *</label>
			<div>
				<select name="dstipo" id="dstipo" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dstipo','')">
					<option value=""></option>
					<option value="senor">Señor</option>
					<option value="senora">Señora</option>
				</select>
			</div>
			<span class="camp_requerido" id="capax_dstipo" style="display:none;"></span>
		</fieldset>
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

		<fieldset >
			<label for="dsdireccion">Dirección *</label>
			<div><input type="text" name="dsdireccion" id="dsdireccion" tabindex="7" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsdireccion','')"></div>
			<span class="camp_requerido" id="capax_dsdireccion" style="display:none;"></span>
		</fieldset>
		<fieldset class="radio">
			<label>Genero *:</label>
			<div class="radios">
				<input type="radio" name="dsgenero" id="dsgenerom" tabindex="8" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsgenero','')"><label for="dsgenerom">Masculino</label>
			</div>
			<div class="radios">
				<input type="radio" name="dsgenero" id="dsgenerof" tabindex="9" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsgenero','')"><label for="dsgenerof">Femenino</label>
			</div><br>
			<span class="camp_requerido" id="capax_dsgenero" style="display:none;"></span>
		</fieldset>
		<fieldset class="checked">
			<div class="checkeds">
				<input type="checkbox" name="dscondiciones" id="dscondiciones" tabindex="10" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscondiciones','')"><label for="dscondiciones">Acepto terminos y condiciones. <a href="#">leer</a></label>
			</div>
			<span class="camp_requerido" id="capax_dscondiciones" style="display:none;"></span>
		</fieldset>
			<?include("incluidos_sitio/captcha.php");?>
			<fieldset class="textarea">
			<label for="dscom">Comentarios *</label>
			<div><textarea name="dscom" id="dscom" tabindex="11" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscom','')"></textarea></div>
			<span class="camp_requerido" id="capax_dscom" style="display:none;"></span>
		</fieldset>





		
		
		
		
</div>
<!--  BLOQUE IZQUIERDA FIN -->

<!--  BLOQUE DERECHA  -->

<div class="bloque_der">
		
	
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d29316091.36527881!2d-43.40249245989987!3d24.331579479094607!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1ses!2ses!4v1402325962479" 
width="320" height="300" frameborder="0" style="border:0"></iframe>	


<div class="datos_contacto">
<p>Medellín - Antioquia</p>
<p>Direccion: Cra 50 #00 - 00</p>
<p>Teléfono: 000 00 00</p>

<img src="images/logo_pata.jpg" alt="">
</div>

</div>		

<!--  BLOQUE DERECHA  FIN -->

		
		
		

	
		<fieldset class="btns">
			<input type="reset" value="Cancelar" class="btn_cancelar">
			<input type="button" value="Enviar" class="btn_enviar" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rut ?>');">
		</fieldset>
	</form>





</article>




</article>

