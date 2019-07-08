<?
  $dsnombre=$_REQUEST["dsnombre"];
  $id=$_REQUEST["id"];
  $sql="select a.id,a.dsm,a.dsd2,a.dsimg1,a.dsruta from $dstabla  a where idactivo=1 ";
  if($dsnombre<>"")$sql.=" and a.dsruta!='$dsnombre'";
  if($id<>"")$sql.=" and id!=$id";
  //	echo $sql;
  $maxregistros=9;
      $limitemostra=3;
      include($rut."incluidos_sitio/paginar_variables.php");
      $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
  if(!$result->EOF){
?>
<article class="cont_txt">
	<article class="cont_relacionado">
		<h1>Otros beneficios</h1>
		<ul>
			 <?while(!$result->EOF){

		      $id=$result->fields[0];
		      $dsm=reemplazar($result->fields[1]);
		      $dsd=reemplazar($result->fields[2]);
		      $dsd2=reemplazar(preg_replace("/\n/","<br>",$dsd));
		      $dsimg=$result->fields[3];

		     $dsruta=$result->fields[4];
			$dsrutax=$rutalocal."/beneficios_fundacion/".$dsruta;
  			if ($rutaAmiga>1) $dsrutax="$rutadetalle?id=".$id;


		      ?>
			<li>
				<a href="<?echo $dsrutax;?>">
					<article>
						<? //if($dsimg<>""){?><!--img  src="<? echo $rutalocalimag;?>/contenidos/images/eventos/<? echo $dsimg; ?>"--><?//}?>


						<h2><? echo $dsm;?></h2>
						<!--p><? echo $dsd2;?></p-->
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