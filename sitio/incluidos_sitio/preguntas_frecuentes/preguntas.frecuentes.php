<?
$sql="select a.id,a.dsm,a.dsd ";
$sql.="from tblfaqs a ";
$sql.=" where a.idactivo not in (2,9) ";
$sql.=" order by dsm asc ";
            $result=$db->Execute($sql);
            if(!$result->EOF){

?>

<article class="cont_qsomos">
	<article class="txt_preguntas">
	<h1>Preguntas Frecuentes</h1>
	<div style="clear:both"></div>
	</article>
	<section class="bloque_horizontal">

             <?
            while(!$result->EOF){
            $id=reemplazar($result->fields[0]);
            $dsm=reemplazar($result->fields[1]);
            $dsd=reemplazar($result->fields[2]);

              ?>
			<h2 class="titu_pregunta">¿<? echo $dsm?>?</h2>
			<article class="txt_pregunta">

				<p><? echo $dsd;?></p>
				<div class="barra"></div>
			</article>

	<?
	$result->MoveNext();
	$i++;
	}
	?>

	</section>
</article>

<? }
$result->Close();
?>
