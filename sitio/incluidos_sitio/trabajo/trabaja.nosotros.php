
	<h1><? echo $dstituloPagina;?></h1>
	<p><? echo $dsd2Pagina;?></p>

	<article class="bloque_texto">
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



	<article class="cont_frm_contacto cont_frm_small">

	<form action="modulos/validaciones/contactotrabajo.php" name="frm_contacto" method="post" id="frm_contacto" enctype="multipart/form-data">
		<?
			$forma="frm_contacto";
			/*$param="captcha";*/
			$param="dsnombre,dsapellidos,dsid,dstelefono,dscelular,dscorreo,dsdireccion,dspais,dsciudad,dscom,captcha";
		?>
		<fieldset>
			<label for="dsnombre">Nombres *</label>
			<div><input type="text" name="dsnombre" id="dsnombre" onkeypress="ocultar('capax_dsnombre')"></div>
			<span class="camp_requerido" id="capax_dsnombre" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dsapellidos">Apellidos</label>
			<div><input type="text" name="dsapellidos" id="dsapellidos" onkeypress="ocultar('capax_dsapellidos')"></div>
			<span class="camp_requerido" id="capax_dsapellidos" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dsid">Identificaci&oacute;n</label>
			<div><input type="text" name="dsid" id="dsid" onkeypress="ocultar('capax_dsid')"></div>
			<span class="camp_requerido" id="capax_dsid" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dstelefono">Tel&eacute;fono</label>
			<div><input type="text" name="dstelefono" id="dstelefono" onkeypress="ocultar('capax_dstelefono')"></div>
			<span class="camp_requerido" id="capax_dstelefono" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dscelular">Celular</label>
			<div><input type="text" name="dscelular" id="dscelular" onkeypress="ocultar('capax_dscelular')"></div>
			<span class="camp_requerido" id="capax_dscelular" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dscorreo">Email *</label>
			<div><input type="text" name="dscorreo" id="dscorreo" onkeypress="ocultar('capax_dscorreo')"></div>
			<span class="camp_requerido" id="capax_dscorreo" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dsdireccion">Direcci&oacute;n</label>
			<div><input type="text" name="dsdireccion" id="dsdireccion" onkeypress="ocultar('capax_dsdireccion')"></div>
			<span class="camp_requerido" id="capax_dsdireccion" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dspais">Pa&iacute;s</label>
			<div><input type="text" name="dspais" id="dspais" onkeypress="ocultar('capax_dspais')"></div>
			<span class="camp_requerido" id="capax_dspais" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dsciudad">Ciudad</label>
			<div><input type="text" name="dsciudad" id="dsciudad" onkeypress="ocultar('capax_dsciudad')"></div>
			<span class="camp_requerido" id="capax_dsciudad" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dshoja">Envie su C.V.</label>
			<div><input type="file" name="dshoja" id="dshoja" onkeypress="ocultar('capax_dshoja')" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"></div>
			<span class="camp_requerido" id="capax_dshoja" style="display:none;"></span>
		</fieldset>

		<fieldset class="textarea">
			<label for="dscom">Comentarios *</label>
			<div><textarea name="dscom" id="dscom" onkeypress="ocultar('capax_dscom')"></textarea></div>
			<span class="camp_requerido" id="capax_dscom" style="display:none;"></span>
		</fieldset>

		<?include("incluidos_sitio/captcha.php");?>
		<fieldset class="btns">
			<input type="button" value="Enviar" class="btn_verde" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rutalocal."/"; ?>');">
			<input type="reset" value="Cancelar" class="btn_verde">
		</fieldset>
	</form>
</article>

<article class="contacto">
	<? if ($dstelefono<>"") {?><p><? echo $dstelefono ?></p><? } ?>
	<? if ($dsemail<>"") {?><p><? echo $dsemail?></p><? } ?>
	<? if ($dsdireccion<>"") {?><p><? echo $dsdireccion ?></p><? } ?>
	<? if ($dsciudad<>"") {?><p><? echo $dsciudad?></p><? } ?>

</article>




</article>
