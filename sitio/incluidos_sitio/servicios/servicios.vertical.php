<article class="cont_txt">
<h1><? echo $dstituloPagina?></h1>
<?
  $dsnombre=$_REQUEST["dsnombre"];
  $sql="select a.id,a.dsm,a.dsd2,a.dsimg1,a.dsruta from $dstabla a where idactivo not in(2,9) order by idpos asc";
  //echo $sql;
  $maxregistros=10;
      include($rut."incluidos_sitio/paginar_variables.php");
      $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
  if(!$result->EOF){
?>

	<article class="bloque_texto">
<?

  while(!$result->EOF){

  $id=$result->fields[0];
  $dsm=reemplazar($result->fields[1]);
  $dsd=reemplazar($result->fields[2]);
  $dsd2=reemplazar(preg_replace("/\n/","<br>",$dsd));
  $dsimg=$result->fields[3];
  $dsruta=$result->fields[4];
  $dsrutax=$rutalocal."/mis_servicios/".$dsruta;
if ($rutaAmiga>1) $dsrutax="$rutalocal?id=".$id;
?>
		<article class="servicios_vertical">

		<a href="<? echo $dsrutax;?>">
		 <? if($dsimg<>""){?><img src="<? echo $rutalocalimag;?>/contenidos/images/servicios/<? echo $dsimg; ?>"><?}?>

			<h1><? echo $dsm;?></h1></a>
			<p><? echo elliStr($dsd,150);?></p>
			<a href="<? echo $dsrutax;?>"class="ver_mas"><p>ver más</p></a>

			<div class="barra">	</div>


			<?/*
				  $dsnombre=$_REQUEST["dsnombre"];
				  $sqlx="select a.id,a.dsm,dsruta from tblcategoria a where idactivo=1 and a.idcat=$id order by idpos asc";
				  //echo $sql;
				  $resultx=$db->Execute($sqlx);
				  if(!$resultx->EOF){
				  	 while(!$resultx->EOF){

					  $id=$resultx->fields[0];
					  $dsm=reemplazar($resultx->fields[1]);

					  $dsruta=$resultx->fields[2];
						$dsrutax=$rutalocal."/tv_servicios/".$dsruta;
			  			if ($rutaAmiga>1) $dsrutax="servicios.detalle.php?id=".$id;

				*/?>
			<!--ul>
				<a href="<? echo $dsrutax;?>"><li><p><? echo $dsm;?></p></li></a>
			</ul -->
			<?/*
    			$resultx->Movenext();
			 }
			}
			$resultx->Close();
			*/?>


		</article>
<?
    $result->Movenext();
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

	</article>
	<?
 }
  $result->Close();
 ?>

</article>


