
<? if($dsimgpaginas<>""){?>

	<img src="../../contenidos/images/paginas/<? echo $dsimgpaginas; ?>">

<?}?>
<h1><? echo reemplazar($dstituloPagina);?></h1>
<p><? echo reemplazar($dsd2Pagina);?></p>


<ul class="cont_qsomos">

<?
  $sql="select dsm,dsd,dsimg,dsvideo,id from tblasociados where idactivo not in(2,9) order by idpos  ";
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
	<li>
		<a href="asociados.detalle.php?id=<? echo $id;?>"><h2><? echo $dsm?></h2></a>

		<? if($dsimg<>""){?>
			<a href="asociados.detalle.php?id=<? echo $id;?>">
			<img src="../../contenidos/images/asociados/<? echo $dsimg; ?>">
			</a>
		<?}?>

		<p><? echo ellistr($dsd,100);?></p>
		<a href="asociados.detalle.php?id=<? echo $id;?>" class="btn_general" title="ver m&aacute;s">Ver m&aacute;s</a>
	</li>

<?
$result->MOveNext();
}
}
$result->Close();
?>

</ul>