<?
	$sql="select a.id,a.dsm,a.dsd,a.dsvideo,a.dsimg,a.dsruta from tblnoticias a where a.idactivo=4 order by idpos asc";
	//echo $sql;
	$result=$db->Execute($sql);
	if(!$result->EOF){
?>

<article class="cont_noticias_lateral">
	<ul class="noticias_lateral">
		<h2>Noticias</h2>

		<? while(!$result->EOF){

			$idm=$result->fields[0];
			$dsm=reemplazar($result->fields[1]);
			$dsd=reemplazar($result->fields[2]);
			$dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));

			$dsvideo=$result->fields[3];
			$dsimg=$result->fields[4];
			$dsruta=$result->fields[5];
			$dsrutax=$rutalocal."/mis_noticias/".$dsruta;
  			if ($rutaAmiga>1) $dsrutax="noticia.detalle.php?id=".$idm;



			?>
		<li>
			<? if ($dsimg<>""){?>
				<a href="<? echo $dsrutax;?>"class="ver_mas"><img src="<? echo $rutalocalimag;?>/contenidos/images/noticias/<? echo $dsimg;?>" alt=""></a>
			<?}?>
			<a href="<? echo $dsrutax;?>"class="ver_mas"><h3><? echo $dsm?></h3></a>

			<p><? echo elliStr($dsd,100);?></p>

		</li>
		<?
		$result->Movenext();
		}
		?>
	</ul>

</article>
<?

	}
	$result->Close();

?>
