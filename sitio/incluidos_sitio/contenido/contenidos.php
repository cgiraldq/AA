<?
  $dsnombre=$_REQUEST["dsnombre"];
  $id=$_REQUEST["id"];
  $sql="select a.id,a.dsm,a.dsdp,a.dsimg2,dsvideo,idcat from tblcategoriacontenido a where a.idactivo not in(2,9)  ";
  if($dsnombre<>"") $sql.=" and a.dsruta='$dsnombre'";
  if($id<>"") $sql.=" and id=$id";
  //echo $sql;
  $result=$db->Execute($sql);
  if(!$result->EOF){
?>
<article class="cont_txt">

        <h1><? echo $dstituloPagina;?></h1>

  <article class="bloque_texto">
    <?while(!$result->EOF){

      $id=$result->fields[0];
      $dsm=reemplazar($result->fields[1]);
      $dsd=reemplazar($result->fields[2]);
      $dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));
      $dsimg=$result->fields[3];
      $dsvideo=$result->fields[4];
       $idcat=$result->fields[5];

      ?>
     <article class="bloque_horizontal">
       <h2><? echo $dsm;?></h2>
      <? if($dsimg<>""){?><img src="<? echo $rutalocalimag;?>/contenidos/images/categoriacontenido/<? echo $dsimg; ?>">
      <?}else{?> <div><? echo $dsvideo; ?></div> <?}?>


      <!--p class="fecha">Fecha: 03/01/2019</p-->

      <p><? echo $dsd;?></p>
      </article>
      <?
        $result->Movenext();
      }?>
  </article>

    <?  include("incluidos_sitio/sindicacion/sindicacion.php");?>

    <?  include("incluidos_sitio/contenido/otros.contenidos.php");?>

  </article>
<?

  }
  $result->Close();

?>