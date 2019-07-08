<article class="cont_productos_lateral">
	<ul>
	<h2>PRODUCTOS DESTACADO</h2>
<?
      $dsnombre=$_REQUEST["dsnombre"];
      $sql="select a.id,a.dsm,a.dsd,a.dsimg1,a.dsruta from tblproductos a where idactivo=3  ";

     $maxregistros=9;
      include($rut."incluidos_sitio/paginar_variables.php");
      $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
      if(!$result->EOF){

      	 $id=$result->fields[0];
          $dsm=reemplazar($result->fields[1]);
          $dsd=reemplazar($result->fields[2]);
          $dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));
          $dsimg=$result->fields[3];
            $dsruta=$result->fields[4];
 $idcat=seldato("iddestino","idorigen","tbltblproductoxcategoria",$id,2);
          $nombrecat=seldato("dsruta","id","tblcategoria",$idcat,2);

          $dsrutax=$rutalocal."/detalles/".$nombrecat."/".$dsruta;
        if ($rutaAmiga>1) $dsrutax="$rutadetalle?id=".$id;
    ?>
		<li>
      <? if ($dsimg<>""){?>
        <a href="<? echo $dsrutax;?>"class="ver_mas"><img src="<? echo $rutalocalimag;?>/contenidos/images/producto/<? echo $dsimg;?>" alt=""></a>
      <?}?>

			<a href="<? echo $dsrutax;?>"class="ver_mas"><h3><? echo $dsm?></h3></a>
			<p><? echo elliStr($dsd,200);?></p>
		</li>
<?
 }
      $result->Close();

    ?>
	</ul>

</article>

