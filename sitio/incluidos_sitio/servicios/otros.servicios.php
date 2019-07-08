<?
  $dsnombre=$_REQUEST["dsnombre"];
  $id=$_REQUEST["id"];
  $sql="select a.id,a.dsm,a.dsd2,a.dsimg1,a.dsruta from $dstabla  a where idactivo=1 ";
  if($dsnombre<>"")$sql.=" and a.dsruta!='$dsnombre'";
  if($id<>"")$sql.=" and id!=$id";
  //	echo $sql;
  $result=$db->Execute($sql);
  if(!$result->EOF){
?>
<article class="cont_txt">
	<article class="cont_relacionado">
		<h1>OTROS</h1>
		<ul>
			 <?while(!$result->EOF){

		      $id=$result->fields[0];
		      $dsm=reemplazar($result->fields[1]);
		      $dsd=reemplazar($result->fields[2]);
		      $dsd2=reemplazar(preg_replace("/\n/","<br>",$dsd));
		      $dsimg=$result->fields[3];

		     $dsruta=$result->fields[4];
			$dsrutax=$rutalocal."/mis_servicios/".$dsruta;
  			if ($rutaAmiga>1) $dsrutax="$rutadetalle?id=".$id;


		      ?>
			<li>
				<a href="<?echo $dsrutax;?>">
					<article>
							 <? if($dsimg<>""){?><img  src="<? echo $rutalocalimag;?>/contenidos/images/servicios/<? echo $dsimg; ?>"><?}?>


						<h2><? echo $dsm;?></h2>
						<p><? echo $dsd2;?></p>
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