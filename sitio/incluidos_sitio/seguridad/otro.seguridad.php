<?
  $id=$_REQUEST["id"];
  $dsnombre=$_REQUEST["dsnombre"];
  $sql="select dsm,dsd,dsimg,dsvideo,dsruta,id from $dstabla where idactivo not in(2,9)  ";
  if($id<>"") $sql.=" and id!=$id";
  if($dsnombre<>"") $sql.=" and dsruta!=$dsnombre";
  //echo $sql;

  $result = $db->Execute($sql);
  if (!$result->EOF) {

?>
<article class="cont_txt">
	<article class="cont_relacionado">
		<h1>QUIÉNES SOMOS</h1>
		<ul>
			<?
			 while(!$result->EOF) {

			  $dsm=reemplazar($result->fields[0]);
			  $dsd=trim($result->fields[1]);
			  $dsd=reemplazar($dsd);
			  $dsimg=$result->fields[2];
			  $dsvideo=$result->fields[3];
			   $dsruta=$result->fields[4];
			    $id=$result->fields[5];
				$dsrutax=$rutalocal."/quienes_somos/".$dsruta;
	  		if ($rutaAmiga>1) $dsrutax="$rutadetalle?id=".$id;

			  ?>

			<li>
				<a href="<?echo $dsrutax;?>">
					<article>
						<? if($dsimg<>""){?><img src="<? echo $rutalocalimag;?>/contenidos/images/producto/<? echo $dsimg; ?>"><?}?>
						<h2><? echo $dsm;?></h2>
						<p><? echo elliStr($dsd,100);?></p>
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