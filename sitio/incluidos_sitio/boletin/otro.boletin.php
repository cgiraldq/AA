<?
 $year=$_REQUEST["year"];
  $sql="select id,dstitulo from $dstabla where idactivo not in(2,9) group by dsyear";
  //echo $sql;
  $result = $db->Execute($sql);
  if (!$result->EOF) {
?>
<form action="<? echo $rutalocal;?>/boletin.php" method="post" name="frmyear">

<div>
	<select name="year" id="year" onchange="cargarvalores('<? echo $rutalocal ?>')">
	<option value="0">Seleccione el año</option>
<?
  	while(!$result->EOF){
  	$idxx=reemplazar($result->fields[0]);
	$fecha=$result->fields[1];
 	$partir=explode("/",$fecha);
?>
<option <? if($year==$partir[0])echo "selected";?> value="<? echo $partir[0];?>"><? echo $partir[0];?></option>
<?
	$result->MoveNext();
}
?>
</select>
</div>
</form>
<?
  }
  $result->Close();
?>

<script type="text/javascript">

	$("#year").change(function(){
document.frmyear.submit();
//location.href="/sitio/boletin.php?year="+document.frmyear.year.value;

});

</script>

<?


   $dsnombre=$_REQUEST["dsnombre"];
   $id=$_REQUEST["id"];


  $sql="select dsm,dsd,dsimg,dsvideo,dsruta,id from $dstabla where idactivo not in(2,9) and id!='$idx'  ";
  if($id<>"") $sql.=" and id!=$id";
  if($dsnombre<>"") $sql.=" and dsruta!='$dsnombre'";
  if($year<>""){$sql.=" and dsyear='$year'";
}else{
	$sql.=" and dstitulo like '%".date(Y)."%' ";
}

  //echo $sql;
  $result = $db->Execute($sql);
  if (!$result->EOF) {
?>
<article class="cont_txt">
	<article class="cont_relacionado">
		<h1>Otros boletines</h1>
		<ul>
			<?
			 while(!$result->EOF) {
			  $dsm=reemplazar($result->fields[0]);
			  $dsd=trim($result->fields[1]);
			  $dsd=reemplazar($dsd);
			  $dsimg=$result->fields[2];
			  $dsvideo=$result->fields[3];
			   $dsruta=$result->fields[4];
			    $idx=$result->fields[5];
				$dsrutax=$rutalocal."/lista_boletines/".$dsruta;
	  		if ($rutaAmiga>1) $dsrutax="$rutadetalle?id=".$id;
			  ?>

			<li>
				<a href="<?echo $dsrutax;?>">
					<article>
						<? if($dsimg<>""){?>
						<img src="<? echo $rutalocalimag;?>/contenidos/images/asociados/<? echo $dsimg; ?>">
						<?}?>

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