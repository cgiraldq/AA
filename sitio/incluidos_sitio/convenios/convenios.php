<article class="cont_txt">
  <? $dsnombre=$_REQUEST["dsnombre"];?>
<h1><? echo reemplazar($dstituloPagina);?></h1>
<h2><?  $nomcat=seldato("dsm","dsruta","tblcategoriaconvenios",$dsnombre,2);
        echo reemplazar($nomcat);
?></h2>
<?


  $cat=seldato("id","dsruta","tblcategoriaconvenios",$dsnombre,2);
   $id=$_REQUEST["id"];
  $sql="select a.id,a.dsm,a.dsd,a.dsimg,a.dsruta from $dstabla a, tblconveniosxcategoria b where b.idorigen=a.id  ";
  if($dsnombre<>"") $sql.=" and b.iddestino=$cat";

  $sql.=" and a.idactivo not in(2,9) order by a.idpos asc";
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
  $dsrutax=$rutalocal."/convenio_detalle/".$dsruta;
if ($rutaAmiga>1) $dsrutax="$rutadetalle?id=".$id;
?>
		<article class="convenios_vertical">

		<a href="<? echo $dsrutax;?>">
		 <? if($dsimg<>""){?><img src="<? echo $rutalocalimag;?>/contenidos/images/qsomos/<? echo $dsimg; ?>"><?}?>

			<h3><? echo $dsm;?></h3></a>
      <article class="cont_porcentaje">
        <p>50%</p>
        <span>de descuento</span>
      </article>
			<!--p><? echo elliStr($dsd,250);?></p-->
			<a href="<? echo $dsrutax;?>"class="ver_mas3"><p>ver más</p></a>
		</article>
<?
    $result->Movenext();
 }

 ?>

	</article>
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




<h1>Categorías</h1>
<article class="bloque_texto">
<?
  $dsnombre=$_REQUEST["dsnombre"];
  $sql="select a.id,a.dsm,a.dsd,a.dsimg1,a.dsruta from tblcategoriaconvenios a where idactivo not in(2,9) order by idpos asc";
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
      <a href="<? echo $dsrutax;?>" class="ver_mas"><p>ver más</p></a>
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


</article>

