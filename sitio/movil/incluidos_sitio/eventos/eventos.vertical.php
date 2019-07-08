	<h1><? echo reemplazar($dstituloPagina);?></h1>
	<p><? echo reemplazar($dsd2Pagina);?></p>
	<? if($dsimgpaginas<>""){?>

			<img src="../../contenidos/images/paginas/<? echo $dsimgpaginas; ?>">

	<?}?>

<?
  $sql="select dsm,dsd,dsimg1,dsvideo,id from tbleventos where idactivo not in(2) order by idpos  ";
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
		<a href="eventos.detalle.php?id=<? echo $id;?>" ><h2><? echo $dsm?></h2></a>
		<? if($dsimg<>""){?>
			<a href="eventos.detalle.php?id=<? echo $id;?>" >
			<? if($dsimg<>""){?><img src="../../contenidos/images/eventos/<? echo $dsimg; ?>"> <?}?>
			</a>
		<?}?>

		<p><? echo ellistr($dsd,100);?></p>
		<a href="eventos.detalle.php?id=<? echo $id;?>" class="btn_general" title="ver m&aacute;s">Ver m&aacute;s</a>
	</article>

<?
$result->MOveNext();
}
}
$result->Close();
?>