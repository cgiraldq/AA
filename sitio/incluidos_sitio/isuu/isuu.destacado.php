<?
// listar categorias de la tienda
	$sql="select a.id,a.dsm,a.dsd,a.dsvideo from tblisuu a where a.idactivo=5 order by rand() limit 0,1 ";
	$result=$db->Execute($sql);
	if(!$result->EOF){

			$idm=$result->fields[0];
			$dsm=reemplazar($result->fields[1]);
			$dsd=reemplazar($result->fields[2]);
			$dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));

			$dsvideo=$result->fields[3];
			$dsimg=$result->fields[4];
			$dsruta=$result->fields[5];
			$dsrutax=$rutalocal."/noticias/".$dsruta;
  			if ($rutaAmiga>1) $dsrutax="noticias.detalle.php?idrelacion=".$idm;



?>


<article class="noticas_centro_horizontal">
	<? echo $dsvideo?>
	<h2><? echo $dsm?></h2>
	<p><? echo $dsd?></p>
	<br style="clear:both;">
</article>

<?
	}
	$result->Close();

?>
