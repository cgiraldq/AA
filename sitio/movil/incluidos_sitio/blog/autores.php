<article class="noticas_centro_vertical">
	 <?
	if($_SESSION['idioma']==1){
    $sql="select dstit,dsd2 from tblpaginas where dsm='$pag'";
	}

	if($_SESSION['idioma']==2){
    $sql="select dstitingles,dsdingles from tblpaginas where dsm='$pag'";
	}
    $result=$db->Execute($sql);
    if(!$result->EOF){
    $dsm=reemplazar($result->fields[0]);
    $dsd=reemplazar($result->fields[1]);
    $dsd=preg_replace("/\n/","<br>",$dsd);
    ?>


      <?
      $m=2;
		//$Nombrecategoriam=seldato("dsm","id","tblcategorias",$idrelacion,1);
      include("incluidos_sitio/miga/miga.php");?>


	<article class="txt_qsomos">

			<!--a href="<? echo $rutbase ?>categorias.php" class="seguir_leyendo">Regresar a las categorías</a-->
	<h1><? echo $dsm?></h1>
	<p><? echo $dsd ?></p>
	</article>
	<?
	}
	$result->Close();
	?>
	<!--article class="separacion_blog"></article-->


	<? if($idrelacion=="") $idrelacion=0;


	 ?>




      <?

	    //  if($dsnombre=="") $dsnombre="revista_holasa";
    /*    $rutaImagen=$rut."../contenidos/images/blog/";
        $sql="select id,dsm,dssubt,dsimg2,dsd2,dsruta from tblblog where  idcategoria=$idrelacion and idactivo=3";
        //    echo $sql;
        $result=$db->Execute($sql);
        if(!$result->EOF){
       		$id=reemplazar($result->fields[0]);
			$dsm=reemplazar($result->fields[1]);
			$dssubt=reemplazar($result->fields[2]);
			$dsimg2=($result->fields[3]);
			$dsd2=reemplazar(preg_replace("/\n/","<br>",$result->fields[4]));
			$dsd2=elliStr($dsd2,200);
			$dsfecha=$result->fields[22];
			$dsruta=$result->fields[5];
			$dsrutax=$rutalocal."/blog_holasa/holasablog/".$dsruta;
			*/
      ?>
	<!--article class="cont_destacado">
		<h3><? echo $dsm ?></h3>

		<a href="<? echo $dsrutax ?>"><? if(is_file($rutaImagen.$dsimg2)){ ?><img src="<? echo $rutaImagen.$dsimg2;?>" alt=""><? } ?></a>
		<p><? echo $dsd2 ?></p>
		<article class="botones">
			<ul>
					<li><a href="<? echo $dsrutax ?>" class="seguir_leyendo">Seguir leyendo</a></li>
			</ul>
		</article>
	</article-->
		<?
	//	}
	//	$result->Close();
	?>
	<!--article class="separacion_blog"></article-->
      <?
	    //  if($dsnombre=="") $dsnombre="revista_holasa";
        $rutaImagen=$rut."../contenidos/images/blog/";
        if($_SESSION['idioma']==1){
        $sql="select dsm,dsd2,dsimg1 from tblautores where";
   		 }

   		 if($_SESSION['idioma']==2){
        $sql="select dsm,dsd2ingles,dsimg1 from tblautores where";
   		 }
       if($idrelacion<>0) $sql.=" idactivo=1";
       if($idrelacion==0) $sql.="  idactivo=1";
			//   echo $sql;
			$maxregistros=10;
			include("incluidos_modulos/paginar.variables.php");
			//include($rut."incluidos_sitio/paginar.variables.php");
			$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
			if(!$result->EOF){
      ?>

		<article class="cont_noticias_relacionadas">
		<!--h2><? echo $nombrecategoria ?></h2-->
		<ul>
			<?
			while(!$result->EOF && ($contar<$maxregistros)){
			$id=reemplazar($result->fields[0]);
			$dsm=reemplazar($result->fields[0]);
			$dssubt=reemplazar($result->fields[0]);
			$dsimg=($result->fields[2]);
			$dsd2=reemplazar(preg_replace("/\n/","<br>",$result->fields[1]));
			$dsd2=elliStr($dsd2,150);
			$dsfecha=$result->fields[22];
			$dsruta=$result->fields[5];
			$dsrutax=$rutalocal."/blog_holasa/holasablog/".$dsruta;
			$idcat=$result->fields[6];

			?>
			<li>
				<a style="cursor: default;" href="">

					<article>

						<? if(is_file($rutaImagen.$dsimg)){ ?><img src="<? echo $rutaImagen.$dsimg;?>"><? } ?>
						<h3><? echo $dsm ?></h3>
						<p><? echo $dsd2 ?></p>
						<div style="clear:both;"></div>
					</article>
				</a>
			</li>
		<?
	    $contar++;
		$result->MoveNext();
		}
		?>
		</ul>
	</article>

	   <? include("incluidos_modulos/index.paginar.php");?>

	<?
		}
		$result->Close();
	?>

	<!-- //////////////////////// ver mas temas por autor//////////////////////////////////////////////////-->

	<?
		$idautor=2;
		if($_SESSION['idioma']==1){
      	 $sql="select id,dsm,dssubt,dsimg,dsd2,dsruta,idcategoria from tblblog where ";
   		 }

   		 if($_SESSION['idioma']==2){
      	 $sql="select id,dsmingles,dssubt,dsimg,dsd2,dsrutaingles,idcategoria from tblblog where ";
   		 }

       $sql.=" idautor=$idautor and idactivo=1";
			//   echo $sql;
        $resultbbb=$db->Execute($sql);
        if(!$resultbbb->EOF){

?>

<nav>
	<span id="muestra" class="ver_mas" style="cursor:pointer">
		<? if($_SESSION['idioma']==1){?>
		Ver otros temas de este autor
		<?}?>

		<? if($_SESSION['idioma']==2){?>
		View other items by this author.
		<?}?>
	</span>
</nav>

<ul id="ver" style="">
<?
        	while(!$resultbbb->EOF){

			$id=reemplazar($resultbbb->fields[0]);
			$dsm=reemplazar($resultbbb->fields[1]);
			$dssubt=reemplazar($resultbbb->fields[2]);
			$dsimg=($resultbbb->fields[3]);
			$dsd2=reemplazar(preg_replace("/\n/","<br>",$resultbbb->fields[4]));
			$dsd2=elliStr($dsd2,150);
			$dsfecha=$resultbbb->fields[22];
			$dsruta=$resultbbb->fields[5];
			$dsrutax=$rutalocal."/blog_holasa/holasablog/".$dsruta;
			$idcat=$resultbbb->fields[6];


?>

	<a href="<? echo $dsrutax?>"><li><? echo $dsm?></li></a>
<?
		$resultbbb->MoveNext();
		}

?>
</ul>


<?
}
$resultbbb->Close();
?>


	</article>