<article class="cont_frm_horizontal " id="frm_solicitar_pro_2" style="display:none;">

	<!--h2>Recomendar servicio</h2-->

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

<!--article class="contacto">
	<? if ($dstelefono<>"") {?><p><? echo $dstelefono ?></p><? } ?>
	<? if ($dsemail<>"") {?><p><? echo $dsemail?></p><? } ?>
	<? if ($dsdireccion<>"") {?><p><? echo $dsdireccion ?></p><? } ?>
	<? if ($dsciudad<>"") {?><p><? echo $dsciudad?></p><? } ?>
</article-->

	<form action="<? echo $rutalocal;?>/modulos/validaciones/recomendar.php" name="frm_recomendar" method="post" id="frm_recomendar">





		<?
			$forma="frm_recomendar";
			/*$param="captcha";*/
			$param="dsnombre1,dscorreo1,dsnombre2,dscorreo2,dscom,captcha1";
		?>
		<fieldset>
			<label for="dsnombre">Mi Nombre *</label>
			<div><input type="text" name="dsnombre1" id="dsnombre1" onkeypress="ocultar('capax_dsnombre1')"></div>
			<span class="camp_requerido" id="capax_dsnombre1" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dscorreo">Mi Email *</label>
			<div><input type="text" name="dscorreo1" id="dscorreo1" onkeypress="ocultar('capax_dscorreo1')"></div>
			<span class="camp_requerido" id="capax_dscorreo1" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dsnombre">Nombre de mi Amigo*</label>
			<div><input type="text" name="dsnombre2" id="dsnombre2" onkeypress="ocultar('capax_dsnombre2')"></div>
			<span class="camp_requerido" id="capax_dsnombre2" style="display:none;"></span>
		</fieldset>

		<fieldset>
			<label for="dscorreo">Email de Amigo*</label>
			<div><input type="text" name="dscorreo2" id="dscorreo2" onkeypress="ocultar('capax_dscorreo2')"></div>
			<span class="camp_requerido" id="capax_dscorreo2" style="display:none;"></span>
		</fieldset>

		<fieldset class="textarea">
			<label for="dscom">Comentarios *</label>
			<div><textarea name="dscom" id="dscom" onkeypress="ocultar('capax_dscom')"></textarea></div>
			<span class="camp_requerido" id="capax_dscom" style="display:none;"></span>
		</fieldset>

		<?include("incluidos_sitio/captcha1.php");?>
		<fieldset class="btns">
			<input type="button" value="Enviar" class="btn_color" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rutalocal."/"; ?>');">
			<input type="hidden" name="ruta" value="<? echo $autorizado."/mis_productos/".$_REQUEST['dsnombre'];?>">
			<input type="reset" value="Cancelar" class="btn_color">
		</fieldset>
	</form>

	<a href="javascript:Abrir_ventana('info.frm.php')" class="ver_mas"><p>POLÍTICA DE TRATAMIENTO DE DATOS PERSONALES</p></a>
</article>