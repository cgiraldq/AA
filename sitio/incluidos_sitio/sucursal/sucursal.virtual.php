<h1><? echo reemplazar($dstituloPagina);?></h1>
<article class="bloque_texto">
	<p><? echo reemplazar($dsd2Pagina);?></p>
<article class="cont_sucursal">

<?
  $dsnombre=$_REQUEST["dsnombre"];
  $sql="select a.id,a.dsm,a.dsd,a.dsimg,a.dsruta,a.dstitulo from $dstabla a where idactivo not in(2,9) order by idpos asc";
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
   $ruta=$result->fields[5];

?>
	<li>
		<? if($dsimg<>""){?>
		<a href="<? echo $ruta;?>" target="_blank"class="btn_ir">
			<img src="<? echo $rutalocalimag;?>/contenidos/images/qsomos/<? echo $dsimg;?>">
		</a>
		<?}?>
		<a href="<? echo $ruta;?>" target="_blank"class="btn_ir"><h2><? echo $dsm;?></h2></a>
		<p><? echo $dsd;?></p>
		<a href="<? echo $ruta;?>" target="_blank"class="btn_ir"><p>Ver más</p></a>
	</li>
<?
    $result->Movenext();
 }

 ?>

	</ul>
<?
  if($totalregistros>$maxregistros)
          {
            $rutaPaginacion=$pagina."?id=".$_REQUEST["id"]."&page=";

            include($rut."incluidos_sitio/func.paginador.php");

          }
 }
  $result->Close();
 ?>
</article>
</article>