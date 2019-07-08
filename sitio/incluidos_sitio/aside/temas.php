<?
	 if($_SESSION['idioma']==1){
	$sql="select id,dsm,dsd,dsruta from blogtblblog where idactivo=1";
	}

	 if($_SESSION['idioma']==2){
	$sql="select id,dsmingles,dsdingles,dsrutaingles from blogtblblog where idactivo=1";
	}

	if($idcat<>"") $sql.=" and idcategoria=$idcat";
	if($idcategoria<>"") $sql.=" and idcategoria=$idcategoria and dsruta<>'$dsrutablog'";
	$sql.="  order by idpos asc ";
	// echo $sql;

	$result=$db->Execute($sql);
	if(!$result->EOF){
?>
<article class="cont_noticias_lateral">
			<article class="titulos_aside">
				 <? if($_SESSION['idioma']==1){ ?>
				<p>OTROS TEMAS DEL BLOG</p>
				<?}?>

				 <? if($_SESSION['idioma']==2){ ?>
				<p>Other Issues</p>
				<?}?>
		</article>
		<article class="temas">


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
			<img src="/sitio/images/icono_otros.png" alt="Facebook" >
			<p><? echo $dsm ?></p>
			</li>
			</a>
<?

$result->MoveNext();
}
 ?>


	</ul>




	<a href="<? echo $rutbase ?>blog.principal.php" class="ver_mas">
		<p>
		<? if($_SESSION['idioma']==1){ ?>
		Ver otros temas relacionados
		<?}?>

		<? if($_SESSION['idioma']==2){ ?>
		See related topics
		<?}?>
		</p>

	</a>
</article>

</article>
<?
	}
	$result->Close();

?>
