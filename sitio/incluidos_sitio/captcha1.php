<fieldset class="contenedor_capcha">
   <div class="img_capcha or">
    <img src="<? echo $rutalocal;?>/captcha/captcha1.php" id="captcha1" alt="capcha">
  </div>
   <div class="or_cont">
       <input type="text" class="capcha" name="captcha1" id="captcha1-form"  onkeypress="ocultarCaptcha1('capax_captcha1'),ocultarCaptcha('capax_cap1')"  required/>

       <p class="camp_requerido" style="display:none;">* Campo requerido</p>

       <p id="capax_captcha1" class="camp_requerido" style="display:none;">Por favor ingrese lo que dice la imagen</p>

       <p id="capax_cap1" class="camp_requerido" style="display:none;">El texto que ingreso no corresponde al de la imagen</p>

       <p class="txt" style="cursor:pointer" onclick="document.getElementById('captcha1').src='<? echo $rutalocal;?>/captcha/captcha1.php?'+Math.random();" id="change-image">Cambiar imagen</p>
   </div>

</fieldset>

<script language="javascript">
<!--
function ocultarCaptcha1(capa) {
	var base=document.getElementById(capa);
	if (base) base.style.display="none";
}
//-->
</script>
