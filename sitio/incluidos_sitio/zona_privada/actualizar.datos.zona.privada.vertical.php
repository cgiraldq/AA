<article id='actualizar_datos' class="cont_frm_horizontal cuerpo_tab">

	<h1>ACTUALIZAR DATOS</h1>

<? $dsnombre=$_REQUEST['dsnombre'];
if ($dsnombre<>"") {
 include("modulos/validaciones/actualizar.datos.zona.php"); ?>
<? } ?>

<?
if ($mensaje==1) {?>
<h4 class="title_lateral" id="mensaje" >
Datos actualizados en el sistema.
</h4>
<?
}elseif ($mensaje==2 ){ ?>
<h4 class="title_lateral" id="mensaje">Datos incorrectos. la contraseña actual o confirmaci&oacute;n son incorrectas intente nuevamente. </h4>
<?}?>

	<?
		$sql="select id,dsm,dsapellidos,dstelefono,dscorreocliente,dsciudad,dspais,dsdireccion,dscontrasena,dstipo from  tblregistro_zonaprivada where  id=".$_SESSION['i_idregist'];
		//echo $sql;
		$result=$db->Execute($sql);
		if(!$result->EOF){
			$dsm = $result->fields[1];
			$dsapellidos = reemplazar($result->fields[2]);
			$dstelefono = reemplazar($result->fields[3]);
			$dscorreocliente = $result->fields[4];
			$dsciudad = reemplazar($result->fields[5]);
			$dspais = reemplazar($result->fields[6]);
			$dsdireccion = reemplazar($result->fields[7]);
			$dsclave = trim($result->fields[8]);
			$dstipo = trim($result->fields[9]);

	?>


	<form action="<? echo $pag ?>" name="frm_actualizar_datos_zona" method="post" id="frm_actualizar_datos_zona">
		<?
			$forma="frm_actualizar_datos_zona";
			/*$param="captcha";*/
			$param="dstipo,dsnombre,dsapellidos,dstelefono,dscorreocliente,dsciudad,dspais,dsdireccion";
		?>

		<fieldset>
			<label for="dsnombre">Nombres *</label>
			<div><input type="text" name="dsnombre" id="dsnombre" tabindex="1"  value="<? echo $dsm ?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsnombre','')"></div>
			<span class="camp_requerido" id="capax_dsnombre" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dsapellidos">Apellidos</label>
			<div><input type="text" name="dsapellidos" id="dsapellidos" tabindex="2" value="<? echo $dsapellidos?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsapellido','')"></div>
			<span class="camp_requerido" id="capax_dsapellidos" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dstelefono">Teléfono *</label>
			<div><input type="text" name="dstelefono" id="dstelefono" tabindex="3" value="<? echo $dstelefono ?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dstelefono','')"></div>
			<span class="camp_requerido" id="capax_dstelefono" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dscorreocliente">Email *</label>
			<div><input type="text" name="dscorreocliente" id="dscorreocliente" tabindex="4" value="<? echo $dscorreocliente ?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscorreocliente','')"></div>
			<span class="camp_requerido" id="capax_dscorreocliente" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dsciudad">Ciudad *</label>
			<div><input type="text" name="dsciudad" id="dsciudad" tabindex="5" value="<? echo $dsciudad ?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsciudad','')"></div>
			<span class="camp_requerido" id="capax_dsciudad" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dspais">País *</label>
			<div><input type="text" name="dspais" id="dspais" tabindex="6" value="<? echo $dspais ?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dspais','')"></div>
			<span class="camp_requerido" id="capax_dspais" style="display:none;"></span>
		</fieldset>
		<fieldset class="direccion">
			<label for="dsdireccion">Dirección *</label>
			<div><input type="text" name="dsdireccion" id="dsdireccion" tabindex="10" value="<? echo $dsdireccion ?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsdireccion','')"></div>
			<span class="camp_requerido" id="capax_dsdireccion" style="display:none;"></span>
		</fieldset>
		<article class="agrupar_campos">
			<fieldset>
				<label for="dscontrasena">Contraseña Actual*</label>
				<div><input type="password" name="dscontrasena" id="dscontrasena" tabindex="7" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscontrasena','')"></div>
				<span class="camp_requerido" id="capax_dscontrasena" style="display:none;"></span>
			</fieldset>

			<fieldset>
				<label for="dscontrasena1">Nueva Contraseña *</label>
				<div><input type="password" name="dscontrasena1" id="dscontrasena1" tabindex="8" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscontrasena1','')"></div>
				<span class="camp_requerido" id="capax_dscontrasena1" style="display:none;"></span>
			</fieldset>

			<fieldset>
				<label for="dscontrasena2">Confirmar contraseña *</label>
				<div><input type="password" name="dscontrasena2" id="dscontrasena2" tabindex="9" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscontrasena2','')"></div>
				<span class="camp_requerido" id="capax_dscontrasena2" style="display:none;"></span>
			</fieldset>
		</article>
		<fieldset class="btns">
			<input type="button" value="Enviar" class="btn_color" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rut ?>');">
			<input type="reset" value="Cancelar" class="btn_color">
			<input type="hidden" name="dsclave" value="<?echo $dsclave?>">

		</fieldset>
	</form>


<?
	}
	$result->Close();
?>
</article>