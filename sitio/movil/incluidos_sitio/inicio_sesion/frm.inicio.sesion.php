<article id="ancla-inicio">


	<article class="cont_cliente_nuevo">

		<h1>CLIENTE NUEVO</h1>
		<p>Lo invitamos a registrarse para realizar sus compras de forma segura, acceder a ofertas exclusivas, hacer solicitudes especiales y muchos beneficios más.</p>

		<fieldset class="btns direccion" >
			<a href="registro.php" class="ver_mas"><p>REGISTRATE YA</p></a>
			<input type=hidden name="idtipocliente" value="<? echo $idtipocliente?>">
		</fieldset>

	</article>

	<article class="cont_frm_vertical">

		<h1>INICIAR SESI&Oacute;N</h1>
		<p class="parrafo_intro">Por favor ingresa tu usuario y clave para poder ingresar</p>

	<form id="frm_inicio_sesion">

		<input type="hidden" name="entrar" >

		<fieldset>
			<!--label for="email">Email</label-->
			<div><input type="text" placeholder="Email"></div>
			<span class="camp_requerido" id="capax_email" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<!--label for="clave">Contrase&ntilde;a *</label-->
			<div><input type="password" placeholder="Contraseña"></div>
			<span class="camp_requerido" id="capax_clave" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<a href="recuperar.contrasena.php" class="links"><p>Olvido su contrase&ntilde;a</p></a>
		</fieldset>

		<fieldset class="btns direccion">
			<input type="button" value="Ingresar" class="btn_general">
		</fieldset>

	</form>

	</article>
</article>
