<?
	$idcat=seldato("id","dsruta","tblcategoria",$partir[0],2);
      $id=$_REQUEST["id"];
  $sql="select a.id,a.dsm,a.dsd,a.dsimg1,a.dsruta,a.dsvideo,a.dsd,a.dsurl from tblproductos a, tbltblproductoxcategoria b where a.id=b.idorigen and a.idactivo not in(2,9) ";
  if($dsnombre<>"")$sql.=" and b.iddestino='$idcat'";
  if($id<>"")$sql.=" and a.id!=$id";
 // echo $sql;
  $maxregistros=20;
      $limitemostra=3;
      include($rut."incluidos_sitio/paginar_variables.php");
      $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
  if(!$result->EOF){
?>
<article class="cont_txt">
	<article class="cont_relacionado">
		<h2>Otros productos relacionados</h2>
		<ul>
			 <?while(!$result->EOF){

		      $id=$result->fields[0];
		      $dsm=reemplazar($result->fields[1]);
		      $dsd=reemplazar($result->fields[2]);
		      $dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));
		      $dsimg=$result->fields[3];

		     $dsruta=$result->fields[4];
			$dsrutax=$rutalocal."/detalles/".$partir[0]."/".$dsruta;
  			if ($rutaAmiga>1) $dsrutax="productos.detalle.php?id=".$id;


		      ?>
			<li>
				<a href="<?echo $dsrutax;?>">
					<article>
							 <? //if($dsimg<>""){?>
							 <!--img src="<? echo $rutalocalimag;?>/contenidos/images/producto/<? echo $dsimg; ?>"-->
							 <?//}?>


						<p><? echo $dsm;?></p>
						<!--p><? echo elliStr($dsd,150);?></p-->
						<div style="clear:both;"></div>
					</article>
				</a>
			</li>
			 <?
		        $result->Movenext();
		      }?>

		</ul>
	</article>
</article>
<?

 if($totalregistros>$maxregistros)
          {
            $rutaPaginacion=$pagina."?id=".$_REQUEST["id"]."&page=";
            if ($_REQUEST["dsnombre"]<>"") $rutaPaginacion=$_REQUEST["dsnombre"]."&page=";
            include($rut."incluidos_sitio/func.paginador.php");

          }

  }
  $result->Close();

?>