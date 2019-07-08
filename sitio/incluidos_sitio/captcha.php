
<fieldset class="contenedor_capcha">
   <div class="img_capcha or"><img src="<?echo $rutbase?>/captcha/captcha.php" id="captcha" alt=""></div>
   <div class="or or_cont">
       <input type="text" class="capcha" name="captcha" id="captcha-form"  onkeypress="ocultarCaptcha('capax_captcha'),ocultarCaptcha('capax_cap')"  required/>
       <p class="camp_requerido" style="display:none;">* Campo requerido</p>
       <p id="capax_captcha" class="camp_requerido" style="display:none;">Por favor ingrese lo que dice la imagen</p>
       <p id="capax_cap" class="camp_requerido" style="display:none;">El texto que ingreso no corresponde al de la imagen</p>
       <p class="txt_blanco1" style="cursor:pointer" onclick="document.getElementById('captcha').src='<?echo $rutbase?>//captcha/captcha.php?'+Math.random();" id="change-image">Cambiar Captcha</p>
   </div>

</fieldset>

<script language="javascript">
<!--
function ocultarCaptcha(capa) {
	var base=document.getElementById(capa);
	if (base) base.style.display="none";
}
//-->
</script>
