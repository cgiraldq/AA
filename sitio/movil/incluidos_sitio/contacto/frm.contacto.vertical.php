<article class="blq_txt">

  <h1><? echo reemplazar($dstituloPagina);?></h1>
  <p><? echo reemplazar($dsd2Pagina);?></p>
  <? if($dsimgpaginas<>""){?>
    <img src="../../contenidos/images/paginas/<? echo $dsimgpaginas; ?>">
  <?}?>

	<form action="../modulos/validaciones/contactomovil.php" name="frm_contacto" method="post" id="frm_contacto">
		<?
			$forma="frm_contacto";
			/*$param="captcha";*/
			$param="dsnombre,dsapellidos,dscelular,dscorreo,dsciudad,dscom";
		?>
		<fieldset>
			<!--label for="dsnombre">Nombres *</label-->
			<div><input type="text" placeholder="Nombre" name="dsnombre" id="dsnombre" onkeypress="ocultar('capax_dsnombre')" ></div>
			<span class="camp_requerido" id="capax_dsnombre" style="display:none;color:red"></span>
		</fieldset>

		<fieldset>
			<!--label for="dsapellido">Apellidos</label-->
			<div><input type="text" name="dsapellidos" id="dsapellidos" placeholder="Apellidos" onkeypress="ocultar('capax_dsapellidos')"></div>
			<span class="camp_requerido" id="capax_dsapellidos" style="display:none;color:red"></span>
		</fieldset>

		<!--fieldset>
			<div><input type="text" name="dstelefono" id="dstelefono" placeholder="Tel&eacute;fono" onkeypress="ocultar('capax_dstelefono')" ></div>
			<span class="camp_requerido" id="capax_dstelefono" style="display:none;color:red"></span>
		</fieldset -->

		<fieldset>
			<!--label for="dstelefono">Tel&eacute;fono *</label-->
			<div><input type="text" name="dscelular" id="dscelular" placeholder="Celular" onkeypress="ocultar('capax_dscelular')"></div>
			<span class="camp_requerido" id="capax_dscelular" style="display:none;color:red"></span>
		</fieldset>

		<fieldset>
			<!--label for="dscorreo">Email *</label-->
			<div><input type="text" name="dscorreo" id="dscorreo" placeholder="Email" onkeypress="ocultar('capax_dscorreo')"></div>
			<span class="camp_requerido" id="capax_dscorreo" style="display:none;color:red"></span>
		</fieldset>

		<fieldset>
			<!--label for="dsciudad">Ciudad *</label-->
			<div><input type="text" name="dsciudad" id="dsciudad" placeholder="Ciudad" onkeypress="ocultar('capax_dsciudad')"></div>
			<span class="camp_requerido" id="capax_dsciudad" style="display:none;color:red"></span>
		</fieldset>

		<!--fieldset>

			<div><input type="text" name="dspais" id="dspais" placeholder="Pa&iacute;s" onkeypress="ocultar('capax_dspais')"></div>
			<span class="camp_requerido" id="capax_dspais" style="display:none;color:red"></span>
		</fieldset-->

		<fieldset class="textarea">
			<!--label for="dscom">Comentarios *</label-->
			<div><textarea name="dscom" id="dscom" placeholder="Comentarios" onkeypress="ocultar('capax_dscom')"></textarea></div>
			<span class="camp_requerido" id="capax_dscom" style="display:none;color:red"></span>
		</fieldset>

		<?//include("incluidos_sitio/captcha.php");?>
		<fieldset class="btns">
			<input type="button" value="Enviar" class="btn_general" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rutalocal."/"; ?>');" >
			<!--input type="reset" value="Cancelar" class="ver_mas" -->
			<input type="hidden" name="movil" value="1">
		</fieldset>
	</form>


</article>

	<?// include("mapa.php");?>