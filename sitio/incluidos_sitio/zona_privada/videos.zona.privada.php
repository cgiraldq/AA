<article id='videos' class="cuerpo_tab">

	<h2>VIDEOS DE FORMACIÓN</h2>

	<article class="con_videos">
	<?
	  $sql="select id,dsm,dsvideo,dsruta,dsfecha from tblvideos where idactivo=1 order by id desc";
	  //echo $sql;
	  $maxregistros=10;
	  include($rut."incluidos_sitio/paginar_variables.php");
	  $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	  // $result=$db->Execute($sql);
	  if(!$result->EOF){
		while(!$result->EOF){
	    $id=$result->fields[0];
	    $dsm=reemplazar($result->fields[1]);
	    $dsvideo4=reemplazar($result->fields[2]);
	    $dsruta=$result->fields[3];
	    $dsrutax=$rutalocal."/jvideos/".$dsruta;
	?>	<article class="listado_videos">
			
			<ul>
				<li>
					<!--h3><? echo $dsm ?></h3-->
					<? echo $dsvideo4 ?>
					<div class="clear"></div>
				</li>
			</ul>
		</article>


	<?
		$result->MoveNext();
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
		$result->Close();
	?>
	

	<?//include("incluidos_sitio/informes/informes.php");?>

	<article class="documentos_pdf">
		<h2>FORMACIÓN</h2>
		<ul>
			<?for ($i=0; $i < 3; $i++) { ?>
			<li>
				<img src="images/pdf.png" alt="">
				<p>Documento para descargar</p>
				<nav>
					<a href="">Descargar</a>
				</nav>
			</li>
			<?}?>
		</ul>
	</article>

	</article>


	<?include("incluidos_sitio/aside/aside.php");?>




</article>