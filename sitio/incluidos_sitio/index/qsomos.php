<?
$sql="select dstit,dsd,dskw,dsd2,id,idactivo,dstitulo,dsvideo from tblpaginas where (dsm='$pag' or dsmalterna='$pag') and idtienda=$idtienda ";
	$result = $db->Execute($sql);
	//echo $sql;
	if (!$result->EOF) {

		$dstitulox1=reemplazar($result->fields[0]);

		$dsdescr=trim($result->fields[1]);
		$dsdescr=reemplazar($dsdescr);
		$dsclaves=trim($result->fields[2]);
		$dsd2Pagina=reemplazar($result->fields[3]);
		$dsd2Pagina=preg_replace("/\n/","<br>", $dsd2Pagina);
		$dstituloPagina=reemplazar($result->fields[6]);
		$idpagina=$result->fields[4];
		$idactivo=$result->fields[5];
		$dsmiga=reemplazar($result->fields[0]);
		$dsvideo=$result->fields[7];

}
$result->Close();
?>

<article class="bloque_inf">
	<article class="qsomos_index">
		<a href="qsomos.php"class="ver_mas"><h1><? echo $dstituloPagina?></h1></a>
        <p><? echo $dsd2Pagina?></p>
		<a href="qsomos.php"class="btn_color">
			<p>ver trayectoria</p>
			<img src="images/icono_trayectoria.png" alt="">
		</a>
	</article>

	<article class="modelos">
		<a href="">
		<img src="images/modelos.jpg" alt="">
		<h2>Nuestras modelos</h2>
		</a>
	</article>	

	<article class="video_index">
		<iframe width="340" height="200" src="//www.youtube.com/embed/OXhs_yG4chU?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
	</article>
</article>

