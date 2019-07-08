<? $idno=$_REQUEST['idno'];?>
			<? if ($idno==1) {?> <p >Contraseña o usuario incorrecto<p> <?}elseif ($idno==2)  { ?><p >Debe digitar los campos <p> <? } ?>
       <? if ($_SESSION['i_idregist']=="")  { #"";?>
	<article class="cont_zona_clientes">

		<div class="titulo_aside">
	<h2>Zona distribuidores</h2>
	</div>

	<form action="<? echo $rutalocal;?>/modulos/validaciones/validar.cliente.php" name="" id="frm_zona_privada">
	<label for="">Haga sus pedidos de una forma rápida</label>
	<fieldset>
		<input type="text" name="email" id="email" placeholder="Usuario">
	</fieldset>
	<fieldset>
		<input type="password" name="clave" id="clave" placeholder="Clave">
	</fieldset>
	<!--fieldset class="otros_link">
		<a href="<? echo $rutalocal; ?>/recuperar.contrasena.php">¿Olvido su Contraseña?</a>
		<a href="<? echo $rutalocal; ?>/registro.php">¿Regístrate?</a>
	</fieldset-->
	<fieldset class="cont_distribuidor">
		<a href="">
		<img src="<?echo $rutbase?>/images/icono_distribuidor.png" alt="">
		<p>COMO SER DISTRIBUIDOR</p>
		</a>
	</fieldset>
	<nav class="btn_centro">
		<input type="submit" name="" id="" value="INGRESAR" class="btn_buscador">
	</nav>
	</form>


</article>
<? }else{ ?>
	<!--a href="<? echo $rutbase ?>zona.privada.php"><input type="button" value="Regresar a la zona privada" class="btn_general"></a-->
	<p></p>
<? } ?>