
<h1><? echo $dstituloPagina?></h1>
<? include("enlaces.php");?>
<?
  $dsnombre=$_REQUEST["dsnombre"];
  $sql="select a.id,a.dsm,a.dsd2,a.dsimg1,a.dsruta,a.dsfechainicial,a.dshora,a.dslugar  from $dstabla a where idactivo not in(2,9) order by idpos asc";
  //echo $sql;
   $maxregistros=9;
      $limitemostra=3;
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
  $fecha=$result->fields[5];
  $hora=$result->fields[6];
  $lugar=$result->fields[7];
  $dsrutax=$rutalocal."/beneficios_asociados/".$dsruta;
if ($rutaAmiga>1) $dsrutax="$rutalocal/$rutadetalle?id=".$id;
?>
		<article class="convenios_categorias">

		<a href="<? echo $dsrutax;?>">
		 <? if($dsimg<>""){?><img src="<? echo $rutalocalimag;?>/contenidos/images/eventos/<? echo $dsimg; ?>"><?}?>
    </a>

    <div>
      <h1><? echo $dsm;?></h1>
			<p><? echo elliStr($dsd,150);?></p>
			<a href="<? echo $dsrutax;?>"class="ver_mas"><p>ver más</p></a>
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
 ?>

	</article>
	<?
 }
  $result->Close();
 ?>
