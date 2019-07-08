<?
$sql="select dsclave from tblclientes where id=".$_SESSION['i_idcliente'];
 $result=$db->Execute($sql);
if(!$result->EOF){
$clave=reemplazar($result->fields[0]);
$dsclave = $rc4->decrypt($s3m1ll4, urldecode($clave));
}
$result->Close();

$r=trim($_REQUEST['r']);
?>

<article class="cuerpo_tab">
<article id='actualizar_datos' class="cont_frm_horizontal frm_recuperar">
	<article class="txt_qsomos">
	<h1>Actualizar Contrase&ntilde;a</h1>
	<?switch ($r) {
		case 1:
			$text="Su Cambio de Contraseña ha sido ¡Exitoso!";
			break;
		case 2:
			$text="Su contraseña actual no es correcta.";
			break;
		default:
			$text="";
			break;
	}?>
	<p style="color: #EC3434; font-size:18px;"><?echo $text?></p>
	</article>
	<form action="modulos/validaciones/cambio.contrasena.php" name="frm_actualizar_datos_zona" method="post" id="frm_actualizar_datos_zona">
		<?
			$forma="frm_actualizar_datos_zona";
			/*$param="captcha";*/
			$param="dscontrasenaant,dsclave,dsclave2";
		?>

		<article class="agrupar_campos">
			<fieldset>
				<label for="dscontrasenaant">Contrase&ntilde;a Actual*</label>
				<div><input type="password" name="dscontrasenaant" id="dscontrasenaant" tabindex="7" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscontrasenaant','')"></div>
				<span class="camp_requerido" id="capax_dscontrasenaant" style="display:none;"></span>
				<input id="" type="hidden" name="dscontrasena" value="<? echo $dsclave; ?>">

			</fieldset>

			<fieldset>
				<label for="dsclave">Nueva Contrase&ntilde;a *</label>
				<div><input type="password" name="dsclave" id="dsclave" tabindex="8" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsclave','')"></div>
				<span class="camp_requerido" id="capax_dsclave" style="display:none;"></span>
			</fieldset>

			<fieldset>
				<label for="dsclave2">Confirmar contrase&ntilde;a *</label>
				<div><input type="password" name="dsclave2" id="dsclave2" tabindex="9" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsclave2','')"></div>
				<span class="camp_requerido" id="capax_dsclave2" style="display:none;"></span>
			</fieldset>
		</article>
		<fieldset class="btns">
			<input type="button" value="Enviar" class="btn_general" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rut ?>');">
			<input type="reset" value="Cancelar" class="btn_general">
		</fieldset>
	</form>
</article>
</article>