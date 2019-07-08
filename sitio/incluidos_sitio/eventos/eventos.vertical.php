
<h1><? echo $dstituloPagina?></h1>
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
  $dsrutax=$rutalocal."/mis_eventos/".$dsruta;
if ($rutaAmiga>1) $dsrutax="$rutalocal/$rutadetalle?id=".$id;
?>
		<article class="eventos_vertical">

		<a href="<? echo $dsrutax;?>">
		 <? if($dsimg<>""){?><img src="<? echo $rutalocalimag;?>/contenidos/images/eventos/<? echo $dsimg; ?>"><?}?>
    </a>
    <a href="<? echo $dsrutax;?>">
			<h2><? echo $dsm;?></h2>
    </a>
			<p><strong>Fecha: </strong><? echo reemplazar($fecha);?></p>
			<p><strong>Hora: </strong><? echo reemplazar($hora);?></p>
			<p><strong>Lugar: </strong> <? echo reemplazar($lugar);?></p>
			<p><? echo elliStr($dsd,150);?></p>

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

	<?
 }
  $result->Close();
 ?>