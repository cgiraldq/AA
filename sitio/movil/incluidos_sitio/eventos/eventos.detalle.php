	<h1><? echo reemplazar($dstituloPagina);?></h1>
	<p><? echo reemplazar($dsd2Pagina);?></p>
	<? if($dsimgpaginas<>""){?>

			<img src="../../contenidos/images/paginas/<? echo $dsimgpaginas; ?>">

	<?}?>
<?
  $id=$_REQUEST["id"];
  $sql="select dsm,dsd,dsimg1,dsvideo from tbleventos where idactivo not in(2,9) and id='$id' order by idpos  ";
  //echo $sql;
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
			<? if($dsimg<>""){?>
				<a href="qsomos.detalle.php?id=<? echo $id;?>" >
					<img src="../../contenidos/images/eventos/<? echo $dsimg; ?>">
				</a>
			<?}?>
			<p><? echo $dsd;?></p>
		<?include("incluidos_sitio/sindicacion/sindicacion.php");?>
	</article>
<?
$result->MOveNext();
}
}
$result->Close();
?>
	<?include("incluidos_sitio/eventos/otros.eventos.php");?>