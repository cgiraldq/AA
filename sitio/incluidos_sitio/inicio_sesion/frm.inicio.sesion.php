<article id="ancla-inicio">

	<article class="cont_inicio_sesion">
		<h2>YA ESTOY REGISTRADO</h2>
		<h1>Iniciar sesión</h1>
		<p>Por favor ingresa tu usuario y clave para poder ingresar</p>
<?
			$msg=trim($_REQUEST['msg']);
			switch ($msg) {
				case 2:
					$text_r ="Usuario y/o Contraseña son incorrectos";
					break;
				case 3:
					$text_r ="Debe imgresar el usuario y contraseña";
					break;

				default:
					break;
			}
		?>
		<p style="color:#F00;"><?echo $text_r?></p>
		<form action="modulos/validaciones/validar.cliente.php" name="frm_inicio_sesion" method="post" id="frm_inicio_sesion">
				<input type="hidden" name="entrar" value="<? echo $_REQUEST['entrar']?>">

		<?
			$forma="frm_inicio_sesion";
			/*$param="captcha";*/
			$param="email,clave";
		?>
		<fieldset>
			<div><input placeholder="Email" type="text" name="email" id="email" tabindex="4" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_email','')"></div>
			<span class="camp_requerido" id="capax_email" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<div><input placeholder="Contrase&ntilde;a" type="password" name="clave" id="clave" tabindex="7" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_clave','')"></div>
			<span class="camp_requerido" id="capax_clave" style="display:none;"></span>
		</fieldset>
		<nav class="links_centro">
			<a href="recuperar.contrasena.php" class="link">Olvido su contrase&ntilde;a</a>
		</nav>

		<nav class="btn_centro">
			<input type="button" value="Ingresar" class="btn_trayectoria" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rut ?>');">
		</nav>

	</form>

	</article>

	<article class="cont_cliente_nuevo">
					   <?
    $sqlx="select dstit,dsd2 from tblpaginas where dsm='$pag'";
    //echo $sqlx;
    $resultx=$db->Execute($sqlx);
    if(!$resultx->EOF){
    $dsmx=reemplazar($resultx->fields[0]);
    $dsdx=reemplazar($resultx->fields[1]);
    $dsdx=preg_replace("/\n/","<br>",$dsdx);

    $textdistribuidor=$dsdx;

			}
		$resultx->Close();
		?>

					<h2>
					<? if ($idtipocliente=="") {?>
						CLIENTE NUEVO
					<? } else {?>
						DISTRIBUIDOR NUEVO
					<? } ?>
					</h2>
					<? if ($idtipocliente=="") {?><p>Lo invitamos a registrarse para realizar sus compras de forma segura, acceder a ofertas exclusivas, hacer solicitudes especiales y muchos beneficios más.</p><? }else{ ?>
					<p><? echo $textdistribuidor ?></p>
					<? } ?>
					<nav class="btn_centro" >
						<a href="registro.php" class="btn_trayectoria">REGÍSTRATE YA</a>
						<input type=hidden name="idtipocliente" value="<? echo $idtipocliente?>">
					</nav>
			</article>

		</article>
