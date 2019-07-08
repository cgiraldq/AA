	<article class="cont_frm_horizontal">




	<h1><? echo reemplazar($dstituloPagina);?></h1>

		<?
// extraer datos de remate
        $sql="select id,dsdireccion,dstelefono,dsimg1,dsemail,dsciudad from tblremate where idactivo=1";
        //    echo $sql;
        $result=$db->Execute($sql);
        if(!$result->EOF){
		$id=reemplazar($result->fields[0]);
		$dsdireccion=reemplazar($result->fields[1]);
		$dsimg1=($result->fields[3]);
		$dstelefono=reemplazar($result->fields[2]);

		$dsemail=reemplazar($result->fields[4]);
		$dsciudad=reemplazar($result->fields[5]);

		}
		$result->Close();

?>
		<?
	$mensaje = $_REQUEST['mensaje'];
	if ($mensaje==1) echo "<article class='txt_qsomos'><p><strong style='color:#F00'>El correo electr&oacute;nico ya se encuentra registrado en el sistema. <a href='recuperar.contrasena.php' style='float: none; color:#005AA2;'>Click aqu&iacute;</a> para recuperar su contraseña.</strong></p></article>";?>
	
	<form action="modulos/validaciones/registro.php" name="frm_registro" method="post"  autocomplete="off" id="frm_registro">
		<?
			$forma="frm_registro";
			/*$param="captcha";*/
			$param="dscorreo,dscontrasena1,dscontrasena2,captcha";
		?>


		<fieldset>
			<label for="dsnombre">Nombres *</label>
			<div><input type="text" name="dsnombre" id="dsnombre"  onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsnombre','')"></div>
			<span class="camp_requerido" id="capax_dsnombre" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dsapellido">Apellidos</label>
			<div><input type="text" name="dsapellido" id="dsapellido"  onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsapellido','')"></div>
			<span class="camp_requerido" id="capax_dsapellido" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dstelefono">Tel&eacute;fono *</label>
			<div><input type="text" name="dstelefono" id="dstelefono"  onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dstelefono','')"></div>
			<span class="camp_requerido" id="capax_dstelefono" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dsmovil">Celular</label>
			<div><input type="text" name="dsmovil" id="dsmovil"  onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsmovil','')"></div>
			<span class="camp_requerido" id="capax_dsmovil" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dscorreo">Email *</label>
			<div><input type="text" name="dscorreo" id="dscorreo" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscorreo','')"></div>
			<span class="camp_requerido" id="capax_dscorreo" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dscontrasena1">Contrase&ntilde;a *</label>
			<div><input type="password" name="dscontrasena1" id="dscontrasena1"  onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscontrasena1','')"></div>
			<span class="camp_requerido" id="capax_dscontrasena1" style="display:none;"></span>

		</fieldset>

		<fieldset>
			<label for="dscontrasena2">Confirmar contrase&ntilde;a *</label>
			<div><input type="password" name="dscontrasena2" id="dscontrasena2"  onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscontrasena2','')"></div>
			<span class="camp_requerido" id="capax_dscontrasena2" style="display:none;"></span>
			<div class="checkbox">
				<input type="checkbox" name="dscondiciones" id="dscondiciones" value="SI" onkeypress="ocultar('capax_dscondiciones')">
				<label for="dscondiciones">Acepto <a  class='terminos_condiciones' href="<?echo $rutbase?>/terminos.condiciones.php?enca=2" >terminos y condiciones </a>*</label>
				<span class="camp_requerido" id="capax_dscondiciones" style="display:none;"></span>
			</div>
			<br>
			<span class="camp_requerido" id="capax_dscondiciones" style="display:none;"></span>
		</fieldset>

	<?include("incluidos_sitio/captcha.php");?>

		<nav class="btn_derecha">
			<input type="button" value="Enviar" class="btn_general" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rutbase ?>');">
			<input type="reset" value="Cancelar" class="btn_general">
		</nav>
	</form>

</article>
