<?$idtextozona=$_REQUEST['idtextozona'];
if ($idtextozona<>"") {
	$sql=" update tblclientes set ";
	$sql.=" idtextozona=".$idtextozona;
	$sql.=" where id=".$_SESSION['i_idcliente'];
	$db->Execute($sql);
}
?>



<?if ($_SESSION['i_idcliente']<>"" && $_SESSION['i_textozona'] == "1")  {?>
	<? $_SESSION['i_textozona']="2";?>
	<?
	$rutaImagen=$rut."../contenidos/images/zonaprivada/";
	$sql="select id,dsm,dsd,dsimg,idpos from tbltextozona where idactivo in (1) order by idpos ASC , id DESC";
	//echo $sql;
	$result=$db->Execute($sql);
	if(!$result->EOF){
	?>
		<script type="text/javascript">
			$(document).ready(function(){
			$.lightbox("#cont_textos_zona");
			});
		</script>
		<section class="cont_textos_zona" id="cont_textos_zona" style="display:none;">
			<article class="cont_zona_text">
			<?
					while(!$result->EOF){
					$id=reemplazar(trim($result->fields[0]));
					$dsm=reemplazar(trim($result->fields[1]));
					$dsd=reemplazar(preg_replace("/\n/","<br>",trim($result->fields[2])));
							$signo=array('$$');
							$replace=array("<img src='images/vineta.png' id='img_vineta'>");
							$dsd=str_replace($signo,$replace,$dsd);
					$dsimg=$rutaImagen.(trim($result->fields[3]));
					?>
					<article class="textos_zona">
						<h3><?echo $dsm?></h3>
						<? if (is_File($dsimg)){?>
						<img src="<?echo $dsimg?>" alt="<?echo $dsm?>">
						<?}?>
						<p><?echo $dsd?></p>
						<br style="clear:both;">
					</article>

					<?
					$result->MoveNext();
					}?>
			</article>
			<article class="cont_checkbox" >
				<form action="" id="frm_activar" name="frm_activar" method="POST">
					<input type="hidden" name="idtextozona" value="3">
					<input type="checkbox" name="che_activar" id="che_activar"><label>No volver a mostrar</label>
				</form>
			</article>
		</section>

		<script LANGUAGE="JavaScript">
		    $("#che_activar").click(function() {
		        if($(this).is(':checked')) {
		            $('#frm_activar').submit();
		        }
		    });
		</script>

	<?
	}
	$result->Close();
	?>
<?}elseif($_SESSION['i_idcliente']<>"") {?>
	<?
		$rutaImagen=$rut."../contenidos/images/zonaprivada/";
		$sql="select id,dsm,dsd,dsimg,idpos from tbltextozona where idactivo in (1) order by idpos ASC , id DESC";
		//echo $sql;
		$result=$db->Execute($sql);
		if(!$result->EOF){
	?>

	<section class="cont_textos_zona" id="cont_textos_zona" style="display:none;">
		<article class="cont_zona_text_1">
		<?
		while(!$result->EOF){
		$id=reemplazar(trim($result->fields[0]));
		$dsm=reemplazar(trim($result->fields[1]));
		$dsd=reemplazar(preg_replace("/\n/","<br>",trim($result->fields[2])));
				$signo=array('$$');
				$replace=array("<img src='images/vineta.png' id='img_vineta'>");
				$dsd=str_replace($signo,$replace,$dsd);
		$dsimg=$rutaImagen.(trim($result->fields[3]));
		?>
		<article class="textos_zona">
			<h3><?echo $dsm?></h3>
			<? if (is_File($dsimg)){?>
			<img src="<?echo $dsimg?>" alt="<?echo $dsm?>">
			<?}?>
			<p><?echo $dsd?></p>
			<br style="clear:both;">
		</article>

		<?
		$result->MoveNext();
		}?>
		</article>
	</section>
	<?
	}
	$result->Close();
	?>
<?}?>