<article class="cont_cliente_nuevo">

	<h1>CLIENTE NUEVO	</h1>

	<p>Lo invitamos a registrarse para realizar sus compras de forma segura, acceder a ofertas exclusivas, hacer solicitudes especiales y muchos beneficios más.</p>

</article>


	<article class="cont_frm_vertical" id="ancla-cliente">

		<form id="frm_registro">

		<fieldset>
			<!--label for="dsempresa">Empresa *</label-->
			<div><input type="text" placeholder="Empresa"></div>
			<span class="camp_requerido" id="capax_dsempresa" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<!--label for="dsnit">NIT *</label-->
			<div><input type="text"placeholder="NIT" ></div>
			<span class="camp_requerido" id="capax_dsnit" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<!--label for="dstelefono">Tel&eacute;fono *</label-->
			<div><input type="text" placeholder="Teléfono"></div>
			<span class="camp_requerido" id="capax_dstelefono" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<!--label for="dspais">País *</label-->
			<div><input type="text" placeholder="País"></div>
			<span class="camp_requerido" id="capax_dspais" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<!--label for="dsciudad">Ciudad *</label-->
			<div><input type="text" placeholder="Cuidad"></div>
			<span class="camp_requerido" id="capax_dsciudad" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<!--label for="dsdireccion">Dirección *</label-->
			<div><input type="text" placeholder="Dirección"></div>
			<span class="camp_requerido" id="capax_dsdireccion" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<!--label for="dsnombre">Nombres *</label-->
			<div><input type="text" placeholder="Nombres" ></div>
			<span class="camp_requerido" id="capax_dsnombre" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<!--label for="dsapellido">Apellidos</label-->
			<div><input type="text" placeholder="Apellidos"></div>
			<span class="camp_requerido" id="capax_dsapellido" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<!--label for="dsmovil">Celular</label-->
			<div><input type="text" placeholder="Celular"></div>
			<span class="camp_requerido" id="capax_dsmovil" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<!--label for="dscorreo">Email *</label-->
			<div><input type="text" placeholder="Email"></div>
			<span class="camp_requerido" id="capax_dscorreo" style="display:none;"></span>
		</fieldset>


		<article class="agrupar_campos">
		<fieldset>
			<!--label for="dscontrasena1">Contrase&ntilde;a *</label-->
			<div><input type="password" placeholder="Contraseña"></div>
			<span class="camp_requerido" id="capax_dscontrasena1" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<!--label for="dscontrasena2">Confirmar contrase&ntilde;a *</label-->
			<div><input type="password" placeholder="Confirmar contraseña" ></div>
			<span class="camp_requerido" id="capax_dscontrasena2" style="display:none;"></span>
		</fieldset>

		</article>

		<?include("incluidos_sitio/captcha.php");?>

		<fieldset>
			<input type="button" class="ver_mas" value="Enviar formulario" alt="Enviar">
			<a href="inicio.sesion.php#ancla-inicio" class="ver_mas"><p>YA ESTOY REGISTRADO</p></a>
			<input type=hidden name="idtipocliente" value="<? echo $idtipocliente?>">
		</fieldset>
	</form>


</article>
