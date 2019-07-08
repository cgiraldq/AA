<?
	 $id=$_REQUEST['idx'];
    $sql="select dsnombres,dsapellidos,dscorreocliente,dsciudad,dstelefono,dsempresa,dsdireccion,dsmovil from tblclientes where id=$id";
    $sql;
    $result=$db->Execute($sql);
    if(!$result->EOF){
        $dsnombres=reemplazar($result->fields[0]);
        $dsapellidos=reemplazar($result->fields[1]);
        $dscorreocliente=$result->fields[2];
        $dstelefono=reemplazar($result->fields[4]);
        $dsciudad=reemplazar($result->fields[3]);
        $dsempresa=reemplazar($result->fields[5]);
        $dsdireccion=reemplazar($result->fields[6]);
        $dsmovil=reemplazar($result->fields[7]);
    }

?>
	<article class="cont_frm_vertical">

	<h1>Registro Como cliente - Paso 2 de 3</h1>
	<p>Complete los siguientes pasos</p>

	<form action="modulos/validaciones/registro.paso.2.php" name="frmpaso2" method="post" id="frmpaso2">
		<?
			$forma="frmpaso2";
			/*$param="captcha";*/
			$param="dsm,dsapellido,dstipoidentificacion,dsidentificacion,dscorreo,dsmovil,dsdireccion,dsdepartamento";
		?>
		<fieldset>
			<label for="dsm">Nombres *</label>
			<div><input type="text" value="<? echo $dsnombres?>" name="dsm" id="dsm" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsm','')"></div>
			<span class="camp_requerido" id="capax_dsm" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dsapellido">Apellidos</label>
			<div><input type="text" name="dsapellido" value="<? echo $dsapellidos?>" id="dsapellido" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsapellido','')"></div>
			<span class="camp_requerido" id="capax_dsapellido" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dstipoidentificacion">Tipo de identificaci&oacute;n*</label>
			<div>
				<select name="dstipoidentificacion" id="dstipoidentificacion" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dstipoidentificacion','')">
					<option value="">Seleccione</option>
					<option value="CC">CC</option>
					<option value="CE">CE</option>
					<option value="PASAPORTE">PASAPORTE</option>
				</select>
			</div>
			<span class="camp_requerido" id="capax_dstipoidentificacion" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dsidentificacion">N&uacute;mero de identificaci&oacute;n *</label>
			<div><input type="text" name="dsidentificacion" id="dsidentificacion" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsidentificacion','')"></div>
			<span class="camp_requerido" id="capax_dsidentificacion" style="display:none;"></span>
		</fieldset>
		<fieldset class="fecha_nacimiento">
			<label for="">Fecha de Nacimiento *</label>
			<br>
			<article class="dia">
				<select name="dsdia" id="dsdia">
					<option value="">D&iacute;a</option>
					<?
						for($i=1;$i<=31;$i++){
							if($i<10){
								$cero=0;
							}else{
								$cero="";
							}
					?>
					<option value="<? echo $cero.$i; ?>"><? echo $cero.$i; ?></option>
					<? }?>
				</select>
			</article>
			<article class="mes">
				<select name="dsmes" id="dsmes">
					<option value="">Mes</option>
					<option value="01">Enero</option>
					<option value="02">Febrero</option>
					<option value="03">Marzo</option>
					<option value="04">Abril</option>
					<option value="05">Mayo</option>
					<option value="06">Junio</option>
					<option value="07">Julio</option>
					<option value="08">Agosto</option>
					<option value="09">Septiembre</option>
					<option value="10">Octubre</option>
					<option value="11">Noviembre</option>
					<option value="12">Diciembre</option>
				</select>
			</article>
			<article class="ano">
				<label for="dsanio">A&ntilde;o</label>
				<input type="text" name="dsanio" id="dsanio" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsanio','')">
			</article>
			<span class="camp_requerido" id="capax_dsanio" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dscorreo">Email *</label>
			<div><input type="text" name="dscorreo" id="dscorreo" value="<? echo $dscorreocliente?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscorreo','')"></div>
			<span class="camp_requerido" id="capax_dscorreo" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dstelefono">Tel&eacute;fono de la casa*</label>
			<div><input type="text" name="dstelefono" id="dstelefono" value="<? echo $dstelefono?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dstelefono','')"></div>
			<span class="camp_requerido" id="capax_dstelefono" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="tel_ofi">Tel&eacute;fono de la Oficina</label>
			<div><input type="text" name="tel_ofi" id="tel_ofi" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_tel_ofi','')"></div>
			<span class="camp_requerido" id="capax_tel_ofi" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dsmovil">Celular *</label>
			<div><input type="text" name="dsmovil" id="dsmovil" value="<? echo $dsmovil ?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsmovil','')"></div>
			<span class="camp_requerido" id="capax_dsmovil" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dsfax">Fax</label>
			<div><input type="text" name="dsfax" id="dsfax" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsfax','')"></div>
			<span class="camp_requerido" id="capax_dsfax" style="display:none;"></span>
		</fieldset>


		<fieldset class="direccion">
			<label for="dsdireccion">Direccion exacta de entrega *</label>
			<div><input type="text" name="dsdireccion" id="dsdireccion"  value="<? echo $dsdireccion ?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsdireccion','')"></div>
			<span class="camp_requerido" id="capax_dsdireccion" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dsempresa">Empresa</label>
			<div><input type="text" name="dsempresa" id="dsempresa"  value="<? echo $dsempresa ?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsempresa','')"></div>
			<span class="camp_requerido" id="capax_dsempresa" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dscargo">Cargo</label>
			<div><input type="text" name="dscargo" id="dscargo" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscargo','')"></div>
			<span class="camp_requerido" id="capax_dscargo" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dsciudad">Ciudad *</label>
			<div><input type="text" name="dsciudad" id="dsciudad" value="<? echo $dsciudad?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsciudad','')"></div>
			<span class="camp_requerido" id="capax_dsciudad" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dsdepartamento">Departamento *</label>
			<div><input type="text" name="dsdepartamento" id="dsdepartamento" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsdepartamento','')"></div>
			<span class="camp_requerido" id="capax_dsdepartamento" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dsfacebook">Facebook</label>
			<div><input type="text" name="dsfacebook" id="dsfacebook" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsfacebook','')"></div>
			<span class="camp_requerido" id="capax_dsfacebook" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dstwitter">Twitter</label>
			<div><input type="text" name="dstwitter" id="dstwitter" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dstwitter','')"></div>
			<span class="camp_requerido" id="capax_dstwitter" style="display:none;"></span>
		</fieldset>

		<fieldset class="btns">
			<input type="button" value="Siguiente" class="ver_mas" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rut ?>');">
			<!-- <input type="reset" value="Cancelar" class="btn_general"> -->
			<input type="hidden" value="<? echo $desdesitio?>" name="desdesitio">
			<input type="hidden" name="entrar" value="<? echo $_REQUEST['entrar']?>">
			<input type="hidden" id="idx" name="idx" value="<? echo $id; ?>">

		</fieldset>
	</form>
</article>
