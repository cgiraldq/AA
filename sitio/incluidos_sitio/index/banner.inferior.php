<article class="bloque_inf">
	<?
    $sql="select a.id,a.dsm,a.dsruta,a.dsimg from tblbanners a, tblbannersxtblpaginas b where a.idactivo=9 group by a.id";
    //echo $sql;

    $result=$db->Execute($sql);
    if(!$result->EOF){
        while(!$result->EOF){
         $dsimg=$result->fields[3];
         $dsruta=$result->fields[2];
    ?>

	<article class="banner_inferior">
		<a target="_blank" href="<? echo $dsruta;?>" >
			<img src="images/banner.inferior.jpg">
		</a>
	</article>
	 <?
    $result->MoveNext();
         } // fin while
    }
    $result->Close();
  ?>
</article>