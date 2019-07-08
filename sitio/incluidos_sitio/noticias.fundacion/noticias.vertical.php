<article class="cont_txt">
		<h1><? echo reemplazar($dstituloPagina);?></h1>
		<p><? echo reemplazar($dsd2Pagina);?></p>

<? include("enlaces.php");?>
	<article class="bloque_texto">
	<?include("incluidos_sitio/noticias/noticia.destacada.php");?>


	<?
	$sql="select a.id,a.dsm,a.dsd,a.dsvideo,a.dsimg,a.dsruta from tblnoticias a where a.idactivo=1 order by id desc ";

			$maxregistros=9;
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


