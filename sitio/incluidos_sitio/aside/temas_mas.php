 <?

	if($_SESSION['idioma']==1){
	$sql="select a.id,a.dsm,a.dsd,a.dsruta from blogtblblog a, tbltema_ml b where a.idactivo=1 and a.id=b.idblog order by b.idcantdblog desc";
	}

	if($_SESSION['idioma']==2){
	$sql="select a.id,a.dsmingles,a.dsdingles,a.dsrutaingles from blogtblblog a, tbltema_ml b where a.idactivo=1 and a.id=b.idblog order by b.idcantdblog desc";
	}        //  echo $sql;
        $result=$db->Execute($sql);
        if(!$result->EOF){


      ?>

<article class="cont_noticias_lateral">
<article class="titulos_aside">


	 <? if($_SESSION['idioma']==1){ ?>
				<p>TEMAS MÁS LEIDOS DEL BLOG</p>
				<?}?>

	 <? if($_SESSION['idioma']==2){ ?>
				<p>MOST VIEWED THEMES</p>
				<?}?>
</article>

<article class="temas_mas">

	<ul>

     <?
          while(!$result->EOF){

        $id=reemplazar($result->fields[0]);
        $dsm=reemplazar($result->fields[1]);

          $dsd=reemplazar(preg_replace("/\n/","<br>",$result->fields[2]));
          $dsd=elliStr($dsd,50);

           $dsruta=$result->fields[3];
		 	$dsrutax=$rutalocal."/mis_blogs/".$dsruta;
		 	if ($rutaAmiga>1) $dsrutax="blog.php?id=".$id;


      ?>
			<a href="<? echo $dsrutax ?>">
			<li>
			<p class="links"><? echo $dsm; ?></p>

			</li>
			</a>

<?

$result->MoveNext();
}
 ?>




	</ul>

	<!--a href="" class="ver_mas">Ver otros links</a-->
</article>
</article>

<?
}
$result->Close();


?>