<article class="cont_noticas_centro_vertical">
	<article class="txt_qsomos">
	<?

	$sql="select dstit,dsd,dskw,dsd2,id,idactivo,dstitulo,dsvideo from tblpaginas where (dsm='$pag' or dsmalterna='$pag') and idtienda=$idtienda ";
	$result = $db->Execute($sql);
//	echo $sql;
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

		<h1><? echo $dstituloPagina?></h1>
		<p><? echo $dsd2Pagina?></p>
	

	</article>
	<?include("incluidos_sitio/videos/video.destacado.php");?>

	<?
	$sql="select a.id,a.dsm,a.dsd,a.dsvideo from tblvideos a where a.idactivo=1 order by idpos asc ";

			$rutaPaginacion="idcat=".$_REQUEST['idcat']."&search=".$_REQUEST['search'];
			$maxregistros=6;

			include("incluidos_modulos/paginar.variables.php");

			$resultx=$db->PageExecute($sql,$maxregistros,$pagina_actual);
			if(!$resultx->EOF){

	        $contar=0;
            while (!$resultx->EOF && ($contar<$maxregistros)) {
            $idm=$resultx->fields[0];
			$dsm=reemplazar($resultx->fields[1]);
			$dsd=reemplazar($resultx->fields[2]);
			$dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));

			$dsvideo=$resultx->fields[3];

?>

	<article class="cont_videos">

		<? echo $dsvideo?>

		<h2><? echo $dsm?></h2>
		<h3><? echo ellistr($dsd,130);?></h3>

		<br style="clear:both;">
	</article>

	<?
	$contar++;
		$resultx->MoveNext();
		} // fin while

	?>

	<?include("incluidos_modulos/index.paginar.php");?>
</article>
<?
			}
			$resultx->Close();

?>



