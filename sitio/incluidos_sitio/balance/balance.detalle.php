<h1><? echo reemplazar($dstituloPagina);?></h1>

  <?//include("incluidos_sitio/publicaciones/publicaciones.menu.php");?>

<article class="cont_txt">
<?
  $id=$_REQUEST["id"];
  $dsnombre=$_REQUEST["dsnombre"];
  $sql="select dsm,dsd,dsimg,dsvideo from $dstabla where idactivo not in(2,9)  ";
  if($id<>"") $sql.=" and id=$id";
  if($dsnombre<>"") $sql.=" and dsruta='$dsnombre'";
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

    <article class="bloque_texto">


      <article class="servicios_vertical">

            <a href="<? echo $dsrutax;?>"class="ver_mas">
              <img src="<? echo $rutalocalimag;?>/contenidos/images/qsomos/<? echo $dsimg;?>" alt="">
           </a>


          <h2><? echo $dsm;?></h2>
           <? echo $dsvideo?>
          <p><? echo $dsd;?> </p>
      </article>



    </article>


<?
$result->MoveNext();
}
}
$result->Close();
?>


<?  include("incluidos_sitio/convenios/otros.convenios.php");?>

  </article>

