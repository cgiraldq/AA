
<article class="cont_frm_horizontal">

	<!--img src="<?//echo $rutbase?>/images/exclamation.png" alt="" class="ico_exclamacion"-->
	<!--h2>BUSCADOR</h2-->
		   <?
    $sqlx="select dstit,dsd2 from tblpaginas where dsm='$pag'";
    //echo $sqlx;
    $resultx=$db->Execute($sqlx);
    if(!$resultx->EOF){
    $dsmx=reemplazar($resultx->fields[0]);
    $dsdx=reemplazar($resultx->fields[1]);
    $dsdx=preg_replace("/\n/","<br>",$dsdx);
    ?>
	<h2>¿No encontró lo que deseaba buscar?</h2>
	<p><? echo $dsdx ?>
	Por favor indique que desea encontrar para ser ingresado posteriormente en nuestro sistema.
	</p>

	<?
	    }
	    $resultx->Close();
	?>

	<form action="modulos/validaciones/buscador.php" name="frm_buscardor" method="post" id="frm_buscardor">
		<?
			$forma="frm_buscardor";
			/*$param="captcha";*/
			$param="dsnombre,dsapellido,dscorreo,dscom,captcha";
		?>

		<fieldset>
			<label for="dsnombre">Nombres *</label>
			<div><input type="text" name="dsnombre" id="dsnombre"  onkeypress="ocultar('capax_dsnombre')"></div>
			<span class="camp_requerido" id="capax_dsnombre" style="display:none;"></span>
		</fieldset>
		<fieldset>
			<label for="dsapellido">Apellidos</label>
			<div><input type="text" name="dsapellido" id="dsapellido" onkeypress="ocultar('capax_dsapellido')"></div>
			<span class="camp_requerido" id="capax_dsapellido" style="display:none;"></span>
		</fieldset>
		<fieldset class="campo_email">
			<label for="dscorreo">Email *</label>
			<div><input type="text" name="dscorreo" id="dscorreo" onkeypress="ocultar('capax_dscorreo')"></div>
			<span class="camp_requerido" id="capax_dscorreo" style="display:none;"></span>
		</fieldset>
		<fieldset class="textarea textarea2">
			<label for="dscom">Comentarios *</label>
			<div><textarea style="height:100px" cols="10" rows="30" name="dscom" id="dscom" onkeypress="ocultar('capax_dscom')"></textarea></div>
			<span class="camp_requerido" id="capax_dscom" style="display:none;"></span>
		</fieldset>

		<?include("incluidos_sitio/captcha.php");?>
		<nav class="btn_derecha">
			<input type="button" value="Enviar" class="btn_zona" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rut ?>');">
			<input type="reset" value="Cancelar" class="btn_zona">
		</nav>
	</form>
</article>
