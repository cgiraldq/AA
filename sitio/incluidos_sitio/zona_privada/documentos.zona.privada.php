<article id='documentos' class="cuerpo_tab">

	<h2>FORMACIÓN</h2>
	    <article class="cont_docs">
<?
	$rutaDocumento=$rut."../contenidos/images/documentos/";
	$sql="select a.id,a.dsm,a.dsd,a.dsdocumento from tbldocumentos a where a.idactivo not in (2,9) order by id desc";
	//echo $sql;
	//$result=$db->Execute($sql);
	$maxregistros=10;
	include($rut."incluidos_sitio/paginador/paginar_variables.php");
	$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if(!$result->EOF){
?>

<?
while(!$result->EOF){
$id=reemplazar(trim($result->fields[0]));
$dsm=reemplazar(trim($result->fields[1]));
$dsd=reemplazar(preg_replace("/\n/","<br>",trim($result->fields[2])));
$dsdocumento=trim($result->fields[3]);
?>


<? if ($dsdocumento<>""){?>

    <a href="<?echo $rut?>descargar.php?path=<? echo $rutaDocumento;?>&file=<? echo $dsdocumento; ?>">
    	<article>
    		<img src="images/descarga.png" alt="">
    		<h2><? echo $dsm ?></h2>
    		<p></p>
    	</article>
	</a>

	<?}?>

	<?
	$result->MoveNext();
	}
	?>

	<?
		}else{
?>

		<p>Lo sentimos en estos  momentos no tienes  documentos disponibles</p>

<?
if($totalregistros>$maxregistros)
          {
            $rutaPaginacion=$pagina."?";
            $enlace=$rutaPaginacion."page=";
            $rutaPaginador=$rutaPaginacion."page=";
            $total=$totalregistros;
            $por_pagina=$maxregistros;
            include($rut."incluidos_sitio/func.paginador.php");

          }
		}
		$result->Close();
	?>
	    </article>
</article>