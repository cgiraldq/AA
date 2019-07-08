<?
	$sql="select a.id,a.dsm,a.dsd,a.dsimg,a.dsruta from tbltips a where a.idactivo=3 order by idpos asc";
	//echo $sql;
	$result=$db->Execute($sql);
	if(!$result->EOF){
?>

<article class="cont_noticias_lateral">
	<ul class="noticias_lateral">
	<h2>TIPS</h2>
		<? while(!$result->EOF){

			$id=$result->fields[0];
			$dsm=reemplazar($result->fields[1]);
			$dsd=reemplazar($result->fields[2]);
			$dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));
			$dsimg=$result->fields[3];

			$dsruta=$result->fields[4];
			$dsrutax=$rutalocal."/tv_tips/".$dsruta;
  			if ($rutaAmiga>1) $dsrutax="tips.detalle.php?id=".$id;

			?>
		<li>
			<? if ($dsimg<>""){?>
				<a href="<? echo $dsrutax;?>"class="ver_mas"><img src="<?echo $rutalocalimag?>/contenidos/images/tips/<? echo $dsimg;?>" alt=""></a>
			<?}?>
			<h2><? echo $dsm?></h2>
			<p><? echo $dsd?></p>
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