<article id='notas' class="cuerpo_tab">


	<article class="cont_noticias_zona">	

	<?
		$rutaImagen="../contenidos/images/noticias/";
		$sqlx="select id,dsm,dsimg2,dsd,dsruta from tblnoticias where idactivo=5 order by id desc";
		//  echo $sqlx;
	  $maxregistros=10;
	  include($rut."incluidos_sitio/paginar_variables.php");
	  $resultx=$db->PageExecute($sqlx,$maxregistros,$pagina_actual);
	  if(!$resultx->EOF){


	while(!$resultx->EOF){

		$id=reemplazar($resultx->fields[0]);
		$dsm=reemplazar($resultx->fields[1]);
		$dsimg2=$resultx->fields[2];
		$dsd=reemplazar(preg_replace("/\n/","<br>",$resultx->fields[3]));


        $dsruta=$resultx->fields[4];
      	 $dsrutax=$rutalocal."/gh_noticias/".$dsruta;
        if ($rutaAmiga>1) $dsrutax="noticia.detalle.php?id=".$id;
	?>
	<article class="bloque_horizontal">
		<h2><? echo $dsm ?></h2>
		<a href="<? echo $dsrutax ?>"><? if(is_file($rutaImagen.$dsimg2)){ ?>
		<img src="<? echo $rutaImagen.$dsimg2;?>" alt=""><? } ?></a>

    	
    	<p><? echo $dsd ?></p>
    	<!--a href="<? echo $dsrutax ?>" class="ver_mas" title="ver m&aacute;s"><p>Leer m&aacute;s</p></a-->
    	<div class="clear"></div>
    </article>

   <?
	$resultx->MoveNext();
	}
	if($totalregistros>$maxregistros)
          {
            $rutaPaginacion=$pagina."?";
            $enlace=$rutaPaginacion."page=";
            $rutaPaginador=$rutaPaginacion."page=";
            $total=$totalregistros;
            $por_pagina=$maxregistros;
            include($rut."incluidos_sitio/func.paginador.php");

          }
?>
<?

}
$resultx->Close();

?>

</article>

	<?include("incluidos_sitio/aside/aside.php");?>



	<?//include("incluidos_sitio/paginador/paginador.php");?>
</article>