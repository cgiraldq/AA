	<h1><? echo $dstituloPagina;?></h1>
	<p><? echo $dsdescr;?></p>

<article class="bloques_horizontal">

<article class="cont_zona_clientes">

	<article class="texto_zona">
		<h2>ZONA CLIENTES</h2>
	</article>
	<? $idno=$_REQUEST['idno'];?>
	<? if ($idno==1) {?> <p style="color:red" >Contraseña o usuario incorrecto<p> <?}elseif ($idno==2)  { ?><p style="color:red" >Debe digitar los campos <p> <? } ?>
	<? if ($_SESSION['i_idregist']=="")  { #"";?>

	<form action="<? echo $rutbase;?>modulos/validaciones/validar.registro.php" name="" id="frm_zona_privada">
	<fieldset>
		<input type="text" name="usuariol" id="usuariol" placeholder="USUARIO">
	</fieldset>
	<fieldset>
		<input type="password" name="clave" id="clave" placeholder="CLAVE">
	</fieldset>
	<fieldset class="otros_link">
		<a href="<? echo $rutbase ?>recuperar.contrasena.php">¿Olvido su Contraseña?</a>
		<a href="<? echo $rutbase ?>registro.php">¿Regístrate?</a>
	</fieldset>
	<fieldset>
		<input type="submit" name="" id="" value="ENTRAR" class="btn_color">
	</fieldset>
	</form>


</article>
<? }else{ ?>
	<!--a href="<? echo $rutbase ?>zona.privada.php"><input type="button" value="Regresar a la zona privada" class="btn_general"></a-->
	<p></p>
	<? } ?>

	</article>
