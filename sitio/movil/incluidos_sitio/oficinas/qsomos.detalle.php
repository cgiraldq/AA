<article class="cont_paginas">
<h1>QUIENES SOMOS</h1>
<?
  $id=$_REQUEST["id"];
  $sql="select dsm,dsd,dsimg,dsvideo from tblqsomos where idactivo not in(2,9) and id='$id' order by idpos  ";
  $result = $db->Execute($sql);
  if (!$result->EOF) {
  while(!$result->EOF) {

  $dsm=reemplazar($result->fields[0]);
  $dsd=trim($result->fields[1]);
  $dsd=reemplazar($dsd);
  $dsimg=$result->fields[2];
  $dsvideo=$result->fields[3];
?>
	<article class="noticias_vertical">
			<h2><? echo $dsm;?></h2>
			<h3></h3>
			<? if($dsimg<>""){?>
				<a href="qsomos.detalle.php?id=<? echo $id;?>" >
					<img src="../../contenidos/images/qsomos/<? echo $dsimg; ?>">
				</a>
			<?}?>
			<p><? echo $dsd;?></p>

			<div style="clear:both;"></div>

		<?include("incluidos_sitio/sindicacion/sindicacion.php");?>

	</article>
<?
$result->MOveNext();
}
}
$result->Close();
?>
	<?include("incluidos_sitio/qsomos/otros.qsomos.php");?>

</article>

