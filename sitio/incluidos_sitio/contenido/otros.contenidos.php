<?
  $dsnombre=$_REQUEST["dsnombre"];
  $id=$_REQUEST["id"];
  $sql="select a.id,a.dsm,a.dsd,a.dsimg1,a.dsruta from tblcategoriacontenido a where a.idactivo not in(2,9) and a.dsenlace is NULL  ";
  //if($dsnombre<>"") $sql.=" and a.dsruta!='$dsnombre'";
  //if($id<>"") $sql.=" and id!=$id";

  //echo $sql;
  $result=$db->Execute($sql);
  if(!$result->EOF){
?>
<article class="cont_txt">
	<article class="cont_relacionado">
		<h1>Otros contenidos</h1>
		<ul>
			 <?while(!$result->EOF){

		      $id=$result->fields[0];
		      $dsm=reemplazar($result->fields[1]);
		      $dsd=reemplazar($result->fields[2]);
		      $dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));
		      $dsimg=$result->fields[3];

		     $dsruta=$result->fields[4];
			$dsrutax=$rutalocal."/informacion/".$dsruta;
  			if ($rutaAmiga>1) $dsrutax="contenidos.detalle.php?id=".$id;


		      ?>
			<li>
				<a href="<?echo $dsrutax;?>">
					<article>
							 <? if($dsimg<>""){?><img src="<? echo $rutalocalimag;?>/contenidos/images/categoriacontenido/<? echo $dsimg; ?>"><?}?>


						<h2><? echo $dsm;?></h2>
						<p><? echo $dsd;?></p>
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

  }
  $result->Close();

?>