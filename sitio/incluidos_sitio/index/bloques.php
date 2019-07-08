<article class="bloques_index">

	<?//include("incluidos_sitio/index/qsomos.php");?>

	<?
	$sql="select a.id,a.dsm,a.dsd,a.dsruta,a.dsmodo,a.dsimg,a.dssubtitulo from tbldestacados a where a.idactivo NOT IN(2,9) order by idpos asc";

	$result=$db->Execute($sql);
	if(!$result->EOF){
		while(!$result->EOF){

		$id=$result->fields[0];
		$dsm=reemplazar($result->fields[1]);
		$dsd=reemplazar($result->fields[2]);
		$dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));
		$dsruta=$result->fields[3];
		$dsmodo=$result->fields[4];
		$dsimg=$result->fields[5];
		$dssubtitulo=$result->fields[6];

		$dsrutax=$dsruta;
		//if ($rutaAmiga>1) $dsrutax=$dsruta."?id=$id";

	?>
	<article class="bloques_horizontal">
		<? if ($dsimg<>""){?>
			<a href="<? echo $dsrutax;?>">
				<img src="<? echo $rutalocalimag;?>/contenidos/images/destacadoindex/<? echo $dsimg;?>" alt="">
		   </a>
		<?}?>
			<div>
				<a href="<? echo $dsrutax;?>"><h2><? echo $dsm;?></h2></a>
				<p><? echo $dsd;?></p>
			</div>

	</article>

		<?

		$result->MoveNext();
         } // fin while

	}
	$result->Close();

	?>

</article>


