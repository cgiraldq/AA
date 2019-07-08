<?
  $dsnombre=$_REQUEST["dsnombre"];
  $id=$_REQUEST["id"];

  $sql="select a.id,a.dsm,a.dsd2,a.dsimg2,dsvideo from tbltips2 a  ";
  //if($id=="") {$sql.=("  a.idactivo=3");}else{ $sql.=(" id=$id");}
  if($dsnombre<>"") $sql.=" where a.dsruta='$dsnombre' ";
   if($id<>"") $sql.=" where a.id='$id' ";
  //echo $sql;
  $result=$db->Execute($sql);
  if(!$result->EOF){
?>
<article class="cont_txt">

        <h1><? echo $dstituloPagina?></h1>

  <article class="bloque_texto">
    <?while(!$result->EOF){

      $id=$result->fields[0];
      $dsm=reemplazar($result->fields[1]);
      $dsd=reemplazar($result->fields[2]);
      $dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));
      $dsimg=$result->fields[3];
      $dsvideo=$result->fields[4];

      ?>
     <article class="bloque_horizontal2">
       <h2><? echo $dsm;?></h2>
      <? if($dsimg<>""){?><img src="/contenidos/images/tips/<? echo $dsimg; ?>">
      <?}if($dsvideo<>""){?> <div><? echo $dsvideo; ?></div> <?}?>
      <!--p class="fecha">Fecha: 03/01/2019</p-->
      <p><? echo $dsd;?></p>
      <?include("incluidos_sitio/carrusel/carruseltips.php");?>
      </article>
      <?
        $result->Movenext();
      }?>
  </article>

    <?  include("incluidos_sitio/sindicacion/sindicacion.php");?>

    <?  include("incluidos_sitio/tips/otros.tips.php");?>

  </article>
<?

  }
  $result->Close();

?>