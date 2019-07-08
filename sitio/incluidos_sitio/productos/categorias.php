<article class="noticas_centro_vertical">
 <h1><? echo $dstituloPagina?></h1>
	<?

		$rutaImagen="../contenidos/images/blog/";
		if($_SESSION['idioma']==1){
		$sql="select id,dsm,dsimg2,dsruta,dsd2 from blogtblblog where idactivo=3";
		}

		if($_SESSION['idioma']==2){
		$sql="select id,dsmingles,dsimg2,dsrutaingles,dsdingles from blogtblblog where idactivo=3";
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

	<article class="cont_destacado">
			<? if($dsimg2<>""){ ?>
				<a href="<? echo $dsrutax; ?>">
					<img src="<? echo $rutaImagen.$dsimg2;?>" alt="imagen blog">
				</a>
			<? } ?>
		<h2><? echo $dsm; ?></h2>
		<p><? echo $dsd2 ?></p>

		<article class="botones">
			<ul>

				<li>
					<a href="<? echo $dsrutax ?>" class="ver_mas"><p>Seguir leyendo</p></a>
				</li>

			</ul>
		</article>
	</article>

	<div class="barra"></div>

	<?
		$result->MoveNext();
		}
		}
		$result->Close();
	?>









	<!--article class="separacion_blog"></article-->
	<?/*
		//$rutaImagen="../contenidos/images/categorias/";
		if($_SESSION['idioma']==1){
		$sql="select id,dsm,dsimg,dsruta from blogtblcategorias where idactivo in (1)";
		}

		if($_SESSION['idioma']==2){
		$sql="select id,dsmingles,dsimg,dsrutaingles from blogtblcategorias where idactivo in (1)";
		}
		//    echo $sql;
		$result=$db->Execute($sql);
		if(!$result->EOF){
	*/?>
		<!--article class="cont_categorias">
		<?if($_SESSION['idioma']==1){ ?>
		<h2>Categor&iacute;as Blog</h2>
		<?}?>

		<?if($_SESSION['idioma']==2){ ?>
		<h2>Blog Topics </h2>
		<?}?>

		<ul>
		<?
			while(!$result->EOF){
			$id=reemplazar($result->fields[0]);
			$dsm=reemplazar($result->fields[1]);
			$dsimg=($result->fields[2]);
			$dsruta=$result->fields[3];
			$dsrutaw=$result->fields[3];
			$dsrutax=$rutalocal."/gh_blog/categorias/".$dsruta;
			 if ($rutaAmiga>1) $dsrutax="blog.principal.php?id=".$id;
		?>
			<li>
				<a href="<? echo $dsrutax ?>">
				<? if(is_file($rutaImagen.$dsimg)){ ?><img src="<? echo $rutaImagen.$dsimg;?>" alt=""><? } ?>
				<h3><? echo $dsm ?></h3>
				</a>
			</li>
		<?
			$result->MoveNext();
			}
		?>


		</ul>
	</article-->
	<?/*
		}
		$result->Close();
	*/?>
 <article class="separacion_blog"></article>

</article>