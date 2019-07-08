<? if($dsimgpaginas<>""){?>
	<a href="oficinas.detalle.php?id=<? echo $id;?>">
		<img src="../../contenidos/images/paginas/<? echo $dsimgpaginas; ?>">
	</a>
<?}?>
<article class="blq_txt">
<h1><? echo reemplazar($dstituloPagina);?></h1>
<p><? echo reemplazar($dsd2Pagina);?></p>
</article>

	<?

		$rutaImagen="../../contenidos/images/blog/";
		if($_SESSION['idioma']==1){
		$sql="select id,dsm,dsimg2,dsruta,dsd2 from blogtblblog where idactivo=3 order by idpos asc,id desc";
		}

		if($_SESSION['idioma']==2){
		$sql="select id,dsmingles,dsimg2,dsrutaingles,dsdingles from blogtblblog where idactivo=3 order by idpos asc,id desc";
		}
		   // echo $sql;
		$result=$db->Execute($sql);
		if(!$result->EOF){
			while(!$result->EOF){
			$id=reemplazar($result->fields[0]);
			$dsm=reemplazar($result->fields[1]);
			$dsimg2=($result->fields[2]);
			$dsd2=reemplazar(preg_replace("/\n/","<br>",$result->fields[4]));
			$dsruta=$result->fields[3];
			$dsrutax=$rutalocal."/mis_blogs/".$dsruta;
			if ($rutaAmiga>1) $dsrutax="blog.php?id=".$id;
	?>

	<? if($dsimg2<>""){ ?>
		<a href="<? echo $dsrutax; ?>">
			<img src="<? echo $rutaImagen.$dsimg2;?>" alt="imagen blog">
		</a>
	<? } ?>
	<article class="blq_txt">
		<h2><? echo $dsm; ?></h2>
		<p><? echo $dsd2 ?></p>
		<a href="<? echo $dsrutax ?>" class="btn_general">Seguir leyendo</a>
	</article>


	<?
		$result->MoveNext();
		}
		}
		$result->Close();
	?>