
<article class="blq_txt">
	<h1><? echo reemplazar($dstituloPagina);?></h1>
	<p><? echo reemplazar($dsd2Pagina);?></p>
	<? if($dsimgpaginas<>""){?>
		<img src="../../contenidos/images/paginas/<? echo $dsimgpaginas; ?>">
	<?}?>
</article>

<?
	$sql="select a.id,a.dsm,a.dsd,a.dsvideo,a.dsimg,a.dsruta from tblnoticias a where a.idactivo not in(2,9) order by id desc ";
	//echo $sql;
      $resultx=$db->Execute($sql);
			if(!$resultx->EOF){
	        $contar=0;
            while (!$resultx->EOF) {
            $id=$resultx->fields[0];
			$dsm=reemplazar($resultx->fields[1]);
			$dsd=reemplazar($resultx->fields[2]);
			$dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));

			$dsvideo=$resultx->fields[3];
			$dsimg=$resultx->fields[4];

?>
		<? if($dsimg<>""){?>
			<a href="noticias.detalle.php?id=<? echo $id;?>">
				<img src="../../contenidos/images/noticias/<? echo $dsimg; ?>">
			</a>
		<?}?>
	<article class="noticias_vertical">
		<a href="noticias.detalle.php?id=<? echo $id;?>" title="ver m&aacute;s"><h2><? echo $dsm;?></h2></a>
		<p><? echo ellistr($dsd,80);?></p>
		<a href="noticias.detalle.php?id=<? echo $id;?>" class="btn_general" title="ver m&aacute;s">Ver m&aacute;s</a>
	</article>

<?
	$contar++;
		$resultx->MoveNext();
		} // fin while

		}
			$resultx->Close();

	?>