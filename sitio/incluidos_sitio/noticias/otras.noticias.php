<?
	$sql="select a.id,a.dsm,a.dsd,a.dsvideo,a.dsimg,a.dsruta from tblnoticias a where a.idactivo not in (2,9) and a.id<>$idm order by id desc  ";
	$resultx = $db->Execute($sql);
	if(!$resultx->EOF){

?>

<article class="cont_noticas_centro_detalle">
	<article class="cont_noticias_relacionadas">
		<h2>OTRAS NOTICIAS</h2>
		<ul>
		<? while (!$resultx->EOF) {
            $idm=$resultx->fields[0];
			$dsm=reemplazar($resultx->fields[1]);
			$dsd=reemplazar($resultx->fields[2]);
			$dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));

			$dsvideo=$resultx->fields[3];
			$dsimg=$resultx->fields[4];
			$dsruta=$resultx->fields[5];
			$dsrutax=$rutalocal."/noticias/".$dsruta;
  			if ($rutaAmiga>1) $dsrutax="noticias.detalle.php?idrelacion=".$idm;

			?>
			<li>
				<a href="<? echo $dsrutax?>">
					<article>
						<?//if ($dsimg<>""){?>
							<!--img src="<?echo $rutaImagen.$dsimg?>" alt=""-->
						<?//}?>
						<h2><? echo $dsm?></h2>
						<!--p><? echo $dsd?></p-->
						<div style="clear:both;"></div>
					</article>
				</a>
			</li>
		<?
		$resultx->MoveNext();

	}?>

		</ul>
	</article>
</article>

<?
	}
	$resultx->Close();

?>
