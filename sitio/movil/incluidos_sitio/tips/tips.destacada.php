
<?
// listar categorias de la tienda

	$sql="select a.id,a.dsm,a.dsd,a.dsvideo,a.dsimg,a.dsruta from tbltips2 a where a.idactivo=3 order by rand() limit 0,1 ";
	$result=$db->Execute($sql);
	if(!$result->EOF){

			$idm=$result->fields[0];
			$dsm=reemplazar($result->fields[1]);
			$dsd=reemplazar($result->fields[2]);
			$dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));

			$dsvideo=$result->fields[3];
			$dsimg=$result->fields[4];
			$dsruta=$result->fields[5];
			$dsrutax=$rutalocal."/tips/".$dsruta;
  			if ($rutaAmiga>1) $dsrutax="tips.detalle.php?idrelacion=".$idm;



?>


<article class="noticia_destacada">
<? if ($dsimg<>""){?>
<?$rutaImagen=$rutalocalimag."contenidos/images/tips/"?>
	<a href="<? echo $dsrutax?>"><img src="<? echo $rutaImagen.$dsimg?>" alt=""></a>
<?}else{?>
	<? echo $dsvideo?>
<?}?>

	<article class="info_noticia">
	<h2><? echo $dsm?></h2>
	<!--h3>Sub titulo</h3-->
	<!--p class="fecha">22/02/2012</p-->
	<p><? echo ellistr($dsd, 100); ?></p>
	<a href="<? echo $dsrutax?>" class="more" title="ver m&aacute;s">ver +</a>
	</article>

</article>
<?
	}
	$result->Close();

?>
