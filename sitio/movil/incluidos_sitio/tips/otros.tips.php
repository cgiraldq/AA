<?
  $dsnombre=$_REQUEST["dsnombre"];

  $sql="select a.id,a.dsm,a.dsd,a.dsimg,a.dsruta from tbltips2 a where a.idactivo not in(2,9) ";
  if($dsnombre) $sql.=" and a.dsruta!='$dsnombre'";
  if($id) $sql.=" and id!=$id ";
  //echo $sql;
  $result=$db->Execute($sql);
  if(!$result->EOF){
?>
<article class="cont_txt">
	<article class="cont_relacionado">
		<h2>OTRAS NOTICIAS</h2>
		<ul>
			 <?while(!$result->EOF){

		      $idm=$result->fields[0];
		      $dsm=reemplazar($result->fields[1]);
		      $dsd=reemplazar($result->fields[2]);
		      $dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));
		      $dsimg=$result->fields[3];

		     $dsruta=$result->fields[4];
			$dsrutax=$rutalocal."/mis_tips/".$dsruta;
  			if ($rutaAmiga>1) $dsrutax="noticia.detalle.php?id=".$idm;


		      ?>
			<li>
				<a href="<?echo $dsrutax;?>">
					<article>
						<? //if($dsimg<>""){?>
						<!--img src="<? echo $rutalocalimag;?>/contenidos/images/noticias/<? echo $dsimg; ?>"-->
						<?//}?>
						<h2><? echo $dsm;?></h2>
						<!--p><? echo $dsd;?></p-->
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