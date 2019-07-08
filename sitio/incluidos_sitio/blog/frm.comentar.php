
		<? $idc=$_REQUEST['idc'];
		 $idresp=$_REQUEST['idresp'];
		$res=$_REQUEST['res'];

		if($idresp==1 || $idresp==2 ){
		$cap="bloc";
		}else{
		$cap="none";
		}
		?>

<article id='comentar' class="cont_frm_horizontal  cuerpo_tab" style="display:<? echo $cap ?>;">
		<article class="txt_qsomos">
	<?  if($_SESSION['idioma']==1){?>
		<? if($_REQUEST['idx']==1){?>
			<h2>Responder comentario </h2>
		<?}else{?>
		<h2>Comentar</h2>
		<?}?>
	<?}?>

	<?  if($_SESSION['idioma']==2){?>
	<h2>Comments</h2>
	<?}?>

	<p></p>
	</article>

	<form action="<?echo $rutbase?>/modulos/validaciones/comentariob.php" name="frm_comentarx" method="post" id="frm_comentarx">
		<?
			$forma="frm_comentarx";
			/*$param="captcha";*/
			$param="dsnombrex,dscorreo,dscom,captcha";
		?>
		<fieldset class="izq_texto">
			<?  if($_SESSION['idioma']==1){?>
			<label for="dsnombrex">Nombres *</label>
			<?}?>

			<?  if($_SESSION['idioma']==2){?>
			<label for="dsnombrex">Names *</label>
			<?}?>

			<div><input type="text" name="dsnombrex" id="dsnombrex" tabindex="1" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsnombrex','')"></div>
			<span class="camp_requerido" id="capax_dsnombrex" style="display:none;"></span>
		</fieldset>
		<fieldset class="izq_texto">
			<label for="dscorreo" >Email *</label>
			<div><input type="text" name="dscorreo" id="dscorreo" tabindex="4" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscorreo','')"></div>
			<span class="camp_requerido" id="capax_dscorreo" style="display:none;"></span>
		</fieldset>
		<!--fieldset class="izq_texto">
			<label for="dsciudad" >Ciudad</label>
			<div><input type="text" name="dsciudad" id="dsciudad" tabindex="5" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsciudad','')"></div>
			<span class="camp_requerido" id="capax_dsciudad" style="display:none;"></span>
		</fieldset-->
		<fieldset class="textarea izq_texto">
			<?  if($_SESSION['idioma']==1){?>
			<label for="dscom" >Comentarios *</label>
			<?}?>

			<?  if($_SESSION['idioma']==2){?>
			<label for="dscom" >Comments *</label>
			<?}?>

			<div><textarea name="dscom" id="dscom" tabindex="11" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscom','')"></textarea></div>
			<span class="camp_requerido" id="capax_dscom" style="display:none;"></span>
		</fieldset>

		<?include("incluidos_sitio/captcha.php");?>
		<nav class="btn_derecha">
			<input type="button" <? if($_SESSION['idioma']==1){?>value="Comentar"<?}?> <? if($_SESSION['idioma']==2){?>value="comment"<?}?> class="btn_trayectoria" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rutalocal."/"; ?>');">
			<input type="reset" <? if($_SESSION['idioma']==1){?>value="Cancelar"<?}?> <? if($_SESSION['idioma']==2){?>value="Cancel"<?}?> class="btn_trayectoria">
			<input type="hidden" value="<? echo $id ?>" name="idblog"><!--id del blog-->
			<input type="hidden" value="<? echo $idresp ?>" name="idtipo"><!--Si es tipo comentario principal o reespuesta-->
			<input type="hidden" value="<? echo $idc ?>" name="idc"><!--id del comentario principal -->
			<input type="hidden" value="<? echo $dsnombre ?>" name="rutablog"><!--ruta del blog nombre -->
			<input type="hidden" value="<? echo $res ?>" name="numrespuesta">
			<input type="hidden" value="<? echo $_REQUEST['idx']; ?>" name="idx">

		</nav>
	</form>
</article>