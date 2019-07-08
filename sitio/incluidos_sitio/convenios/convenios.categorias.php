<h1><? echo reemplazar($dstituloPagina);?></h1>
<p><? echo reemplazar($dsd2Pagina);?></p>

<?
  $dsnombre=$_REQUEST["dsnombre"];
  $sql="select a.id,a.dsm,a.dsd,a.dsimg1,a.dsruta from $dstabla a where idactivo not in(2,9) order by idpos asc";
  //echo $sql;
   $maxregistros=9;
      $limitemostra=3;
      include($rut."incluidos_sitio/paginar_variables.php");
       $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);

  if(!$result->EOF){
  	 while(!$result->EOF){

  $id=$result->fields[0];
  $dsm=reemplazar($result->fields[1]);
  $dsd=reemplazar($result->fields[2]);
  $dsd2=reemplazar(preg_replace("/\n/","<br>",$dsd));
  $dsimg=$result->fields[3];
  $dsruta=$result->fields[4];
  $dsrutax=$rutalocal."/mis_convenios/".$dsruta;
if ($rutaAmiga>1) $dsrutax="$rutadetalle?id=".$id;
?>


	<article class="convenios_categorias">

		<a href="<? echo $dsrutax;?>">
			 <? if($dsimg<>""){?><img src="<? echo $rutalocalimag;?>/contenidos/images/producto/<? echo $dsimg; ?>"><?}?>
		</a>

		<div>
			<a href="<? echo $dsrutax;?>"><h1><? echo $dsm;?></h1></a>
			<p><? echo $dsd2;?></p>
		</div>
	</article>
<?
  $result->Movenext();
 }

  if($totalregistros>$maxregistros)
          {
            $rutaPaginacion=$pagina."?id=".$_REQUEST["id"]."&page=";

            include($rut."incluidos_sitio/func.paginador.php");

          }
 }
  $result->Close();
 ?>
