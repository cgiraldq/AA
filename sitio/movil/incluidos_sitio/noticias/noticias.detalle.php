<article class="blq_txt">
  <h1><? echo reemplazar($dstituloPagina);?></h1>
  <p><? echo reemplazar($dsd2Pagina);?></p>
  <? if($dsimgpaginas<>""){?>
    <img src="../../contenidos/images/paginas/<? echo $dsimgpaginas; ?>">
  <?}?>
</article>

<?

  $id=$_REQUEST["id"];
  $sql="select a.id,a.dsm,a.dsd2,a.dsimg2,dsvideo from tblnoticias a  ";
   if($id<>"") $sql.=" where a.id='$id' ";
  //echo $sql;
  $result=$db->Execute($sql);
  if(!$result->EOF){
  	while(!$result->EOF){

      $id=$result->fields[0];
      $dsm=reemplazar($result->fields[1]);
      $dsd=reemplazar($result->fields[2]);
      $dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));
      $dsimg=$result->fields[3];
      $dsvideo=$result->fields[4];

?>
      <? if($dsimg<>""){?>
      <a href="noticias.detalle.php?id=<? echo $id;?>" >
      <img src="../../contenidos/images/noticias/<? echo $dsimg; ?>">
      </a>
      <?}?>
  <article class="noticias_vertical">
    <h2><? echo $dsm;?></h2>
		<p><? echo $dsd;?></p>

		<?include("incluidos_sitio/sindicacion/sindicacion.php");?>

	</article>
<?
 $result->Movenext();
      }

  }
  $result->Close();

?>
  <?include("comentario.facebook.php");?>
	<?include("incluidos_sitio/noticias/otras.noticias.php");?>