<article class="cont_txt">

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

	<article class="bloque_texto">
	<?include("incluidos_sitio/noticias/noticia.destacada.php");?>


	<?
	$sql="select a.id,a.dsm,a.dsd,a.dsvideo,a.dsimg,a.dsruta from tbltips2 a where a.idactivo=1 order by id desc ";

			$maxregistros=5;
      $limitemostra=3;
      include($rut."incluidos_sitio/paginar_variables.php");
      $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
			if(!$resultx->EOF){

	        $contar=0;

            while (!$resultx->EOF && ($contar<$maxregistros)) {
            $idm=$resultx->fields[0];
			$dsm=reemplazar($resultx->fields[1]);
			$dsd=reemplazar($resultx->fields[2]);
			$dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));

			$dsvideo=$resultx->fields[3];
			$dsimg=$resultx->fields[4];
			$dsruta=$resultx->fields[5];
			$dsrutax=$rutalocal."/noticias/".$dsruta;
  			if ($rutaAmiga>1) $dsrutax="noticias.detalle.php?idrelacion=".$idm;


?>
	<article class="bloques_horizontal">

		<h2><? echo $dsm?></h2>

		<? if (trim($dsimg)<>""){?>
			<a href="<? echo $dsrutax?>"><img src="<? echo $rutaImagen.$dsimg?>" alt=""></a>
		<?}?>

		<!--h3>Sub titulo</h3-->
		<p><? echo $dsd?></p>
		<a href="<? echo $dsrutax?>" class="ver_mas" title="ver m&aacute;s"><p>ver más</p></a>
		<br style="clear:both;">
	</article>

	<article class="bloque_texto">

	<?
	$contar++;
		$resultx->MoveNext();
		} // fin while

if($totalregistros>$maxregistros)
          {
            $rutaPaginacion=$pagina."?id=".$_REQUEST["id"]."&page=";
            if ($_REQUEST["dsnombre"]<>"") $rutaPaginacion=$_REQUEST["dsnombre"]."&page=";
            include($rut."incluidos_sitio/func.paginador.php");

          }
	?>




</article>
<?
			}
			$resultx->Close();

?>


