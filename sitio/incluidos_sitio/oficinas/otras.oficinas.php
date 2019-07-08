
<article class="cont_txt">
	<article class="cont_relacionado_mapa">
<?
  $dsnombre=$_REQUEST["dsnombre"];
  $sql="select a.id,a.dsm,a.dsd2,a.dsimg1,a.dsruta,a.dsdir,a.dstel,a.dshorarios  from $dstabla a where idactivo not in(2,9) order by idpos asc";
  //echo $sql;
   $maxregistros=9;
      $limitemostra=3;
      include($rut."incluidos_sitio/paginar_variables.php");
      $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
  if(!$result->EOF){
?>
		<ul>
<?

  while(!$result->EOF){

  $id=$result->fields[0];
  $dsm=reemplazar($result->fields[1]);
  $dsd=reemplazar($result->fields[2]);
  $dsd2=reemplazar(preg_replace("/\n/","<br>",$dsd));
  $dsimg=$result->fields[3];
  $dsruta=$result->fields[4];
  $dsdir=$result->fields[5];
  $hora=$result->fields[6];
  $dstel=$result->fields[7];
   $dshorarios=$result->fields[8];
  //$dsrutax=$rutalocal."/eventos/".$dsruta;
//if ($rutaAmiga>1) $dsrutax="$rutalocal/$rutadetalle?id=".$id;
?>
		<li>
				<article>
					<a class="customlightbox" href="images/mapa2.jpg" rel="group2">
				      		<img src="images/ver_mas.jpg" class="ver_mapa">
		            </a>

					<? if($dsimg<>""){?><img  src="<? echo $rutalocalimag;?>/contenidos/images/eventos/<? echo $dsimg;?>"><?}?>

					<a href="#">
						<h2><? echo $dsm;?></h2>
						<p><? //echo $dsd2;?></p>

						 <ul>
						    <li><p><strong> Dirección: </strong><? echo $dsdir;?></p></li>
						    <li><p><strong>Teléfonos: </strong><? echo $dstel?></p></li>
						    <li><p><strong> Horarios de atención:</strong><? echo $dshorarios?></p></li>
						  </ul>
					</a>

					<div style="clear:both;"></div>
				</article>
		</li>
<?
    $result->Movenext();
 }
 if($totalregistros>$maxregistros)
          {
            $rutaPaginacion=$pagina."?id=".$_REQUEST["id"]."&page=";

            include($rut."incluidos_sitio/func.paginador.php");

          }
 ?>
		</ul>
<?
 }
  $result->Close();
 ?>

	</article>
</article>
