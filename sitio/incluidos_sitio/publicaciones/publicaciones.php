<h1><? echo reemplazar($dstituloPagina);?></h1>

<?
  $id=$_REQUEST["id"];
  $dsnombre=$_REQUEST["dsnombre"];
  $sql="select dsm,dsd,dsimg,dsvideo,id,dstitulo from $dstabla where idactivo='1' ";
  //echo $sql;
  if($id<>"") $sql.=" and id='$id'";
  if($dsnombre<>"") $sql.=" and dsruta='$dsnombre'";
  $sql.=" order by idpos asc ";
  $result = $db->Execute($sql);
  if (!$result->EOF) {


  $dsm=reemplazar($result->fields[0]);
  $dsd=trim($result->fields[1]);
  $dsd=reemplazar($dsd);
  $dsimg=$result->fields[2];
  $dsvideo=$result->fields[3];
  $idx=$result->fields[4];
  $dsfecha=$result->fields[5];
?>
    <article class="bloque_texto">

         <? if ($dsimg<>""){?>
        <a href="<? echo $dsrutax;?>"class="ver_mas">
          <img src="<? echo $rutalocalimag;?>/contenidos/images/asociados/<? echo $dsimg;?>" alt="">
         </a>
      <?}?>

          <h2><? echo $dsm;?></h2>
          <h4>Fecha publicaci&oacute;n: <? echo $dsfecha?></h4>
          <p><? echo $dsd;?></p>
          <? echo $dsvideo?>
          <div class="barra"></div>

    </article>
<?
}
$result->Close();
?>

<? include("incluidos_sitio/publicaciones/otro.publicaciones.php");?>
