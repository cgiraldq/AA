<article class="cont_paginas">

	<h1>CONVENIOS</h1>
	<h2><? $categoria=seldato("dsm","id","tblcategoriaconvenios",$_REQUEST["id"],2); echo reemplazar($categoria);?></h2>
<?
  $id=$_REQUEST["id"];
  $sql="select a.dsm,a.dsd,a.dsimg,a.dsvideo,a.id from tblconvenios a,tblconveniosxcategoria b  ";
  $sql.="where a.id=b.idorigen and b.iddestino='$id' and a.idactivo not in(2,9) order by a.idpos ";
  //echo $sql;
  $result = $db->Execute($sql);
  if (!$result->EOF) {
  while(!$result->EOF) {

  $dsm=reemplazar($result->fields[0]);
  $dsd=trim($result->fields[1]);
  $dsd=reemplazar($dsd);
  $dsimg=$result->fields[2];
  $dsvideo=$result->fields[3];
  $id=$result->fields[4];
?>
	<article class="noticias_vertical">
		<? if($dsimg<>""){?>
			<a href="convenios.detalle.php?id=<? echo $id;?>" >
				<img src="../../contenidos/images/qsomos/<? echo $dsimg; ?>">
			</a>
		<?}?>
		<a href="convenios.detalle.php?id=<? echo $id;?>"><h2><? echo $dsm?></h2></a>
		<h3></h3>
		<p><? echo ellistr($dsd,100);?></p>
		<a href="convenios.detalle.php?id=<? echo $id;?>" class="ver_mas" title="ver m&aacute;s">VER MÁS</a>
	</article>

	<!--div class="separador"></div-->
<?
$result->MOveNext();
}
}
$result->Close();
?>

	<?include("incluidos_sitio/convenios/otros.convenios.php");?>
</article>



