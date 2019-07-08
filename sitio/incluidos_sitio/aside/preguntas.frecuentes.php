<?
$sql="select a.id,a.dsm,a.dsd ";
$sql.="from tblfaqs a ";
$sql.=" where a.idactivo=3";
$sql.=" order by dsm asc ";
            $result=$db->Execute($sql);
            if(!$result->EOF){

?>

<article class="cont_noticias_lateral">
    <ul class="noticias_lateral">
        <li>
	   <h2 class="titulo_pregunta">PREGUNTAS FRECUENTES</h2>

    	<section class="cont_preguntas">

             <?
            while(!$result->EOF){
            $id=reemplazar($result->fields[0]);
            $dsm=reemplazar($result->fields[1]);
            $dsd=reemplazar($result->fields[2]);

              ?>
			<h3 class="titu_pregunta">¿<? echo $dsm?>?</h3>
			<article class="txt_pregunta">

				<p><? echo $dsd;?></p>
				<div style="clear:both"></div>
			</article>
			 <?
                 $result->MoveNext();
                 $i++;
              }

                 ?>

	</section>
    </li>
   </ul>
</article>

<? }
$result->Close();
?>