<article class="blq_txt">
	<h1><? echo reemplazar($dstituloPagina);?></h1>
	<p><? echo reemplazar($dsd2Pagina);?></p>
	<? if($dsimgpaginas<>""){?>
	<img src="../../contenidos/images/paginas/<? echo $dsimgpaginas; ?>">
	<?}?>
</article>

<ul class="cont_qsomos_detalle">
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

		<? if($dsimg<>""){?>
		<a href="qsomos.detalle.php?id=<? echo $id;?>">
		<img src="../../contenidos/images/qsomos/<? echo $dsimg; ?>">
		</a>
		<?}?>
	<li>
		<h2><? echo $dsm;?></h2>
		<p><? echo $dsd;?></p>
		<?include("incluidos_sitio/sindicacion/sindicacion.php");?>
	</li>
<?
$result->MOveNext();
}
}
$result->Close();
?>
</ul>

<?include("incluidos_sitio/qsomos/otros.qsomos.php");?>