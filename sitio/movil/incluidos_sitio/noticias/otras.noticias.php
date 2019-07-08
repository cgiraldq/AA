<?
	$sql="select a.id,a.dsm,a.dsd,a.dsvideo,a.dsimg from tblnoticias a where a.idactivo not in (2,9) and a.id<>$id order by id desc  ";
	$resultx = $db->Execute($sql);
	if(!$resultx->EOF){

?>


	<article class="otros_listado">
		<h2>OTRAS NOTICIAS</h2>
		<ul>
		<? while (!$resultx->EOF) {
            $idm=$resultx->fields[0];
			$dsm=reemplazar($resultx->fields[1]);
			$dsd=reemplazar($resultx->fields[2]);
			$dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));

			$dsvideo=$resultx->fields[3];
			$dsimg=$resultx->fields[4];



			?>
			<li>
				<a href="<? echo $dsrutax?>">
					<p><? echo $dsm?></p>
					<!--p><? echo $dsd?></p-->
				</a>
			</li>



		<?
		$resultx->MoveNext();

	}?>

		</ul>
	</article>


<?
	}
	$resultx->Close();

?>
