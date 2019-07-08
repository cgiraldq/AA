<?
	$sql="select a.id,a.dsm,a.dsd,a.dsvideo,a.dsimg,a.dsruta from tblcolumnista a where a.idactivo=4 order by idpos asc  ";
	$result=$db->Execute($sql);
	if(!$result->EOF){
?>

<article class="cont_noticias_lateral">
	<ul class="noticias_lateral">
		<h2>TESTIMONIOS</h2>
		<? while(!$result->EOF){

			$idm=$result->fields[0];
			$dsm=reemplazar($result->fields[1]);
			$dsd=reemplazar($result->fields[2]);
			$dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));

			$dsvideo=$result->fields[3];
			$dsimg=$result->fields[4];
			$dsruta=$result->fields[5];
			$dsrutax=$rutalocal."/tv_columnista/".$dsruta;
  			if ($rutaAmiga>1) $dsrutax="columnista.detalle.php?id=".$idm;



		?>
		<li>
			<h2><?echo $dsm?></h2>
			<? if ($dsimg<>""){?>
				<a href="<? echo $dsrutax;?>"class="ver_mas"><img src="<? echo $rutalocalimag;?>/contenidos/images/columnista/<? echo $dsimg;?>" alt=""></a>
			<?}?>

			<p> <? echo $dsd?></p>
		</li>
		<?
		$result->Movenext();
	}?>
	</ul>
		<a href="<? echo $dsrutax;?>"class="ver_mas"><p>ver más</p></a>
</article>
<?

	}
	$result->Close();

?>