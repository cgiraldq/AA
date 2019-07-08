<article class="cont_paginas">

	<h1>RED DE OFICINAS</h1>
	<h2><? echo seldato("dsm","id","tblciudades",$_REQUEST["id"],2);?></h2>
<?
  $id=$_REQUEST["id"];
  $sql="select dsm,dsd,dsimg,id from tbloficina where idactivo not in(2,9) and idc='$id' order by idpos  ";
  $result = $db->Execute($sql);
  if (!$result->EOF) {
  while(!$result->EOF) {

  $dsm=reemplazar($result->fields[0]);
  $dsd=trim($result->fields[1]);
  $dsd=reemplazar($dsd);
  $dsimg=$result->fields[2];

  $id=$result->fields[3];
?>
	<article class="noticias_vertical">
		<a href="qsomos.detalle.php?id=<? echo $id;?>" ><h2><? echo $dsm?></h2></a>
		<h3></h3>
		<? if($dsimg<>""){?>
			<a href="qsomos.detalle.php?id=<? echo $id;?>" >
				<img src="../../contenidos/images/oficina/<? echo $dsimg; ?>">
			</a>
		<?}?>

		<p><? echo $dsd;?></p>

		<!--a href="qsomos.detalle.php?id=<? echo $id;?>" class="ver_mas" title="ver m&aacute;s"><p>VER MÁS</p></a-->
	</article>

	<!--div class="separador"></div-->
<?
$result->MOveNext();
}
}
$result->Close();
?>


	</article>

</article>



