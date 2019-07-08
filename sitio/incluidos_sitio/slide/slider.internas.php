<? if($pagina<>"oficinas.php"){?>

<?

$sql="select a.id,a.dsm,a.dsruta,a.dsimg,a.dsmodo,a.idfechai,a.idfechaf  from tblbanners a";
$sql.=", tblbannersxtblpaginas b";
if($pagina=="ecommerce.subcategorias.php")$sql.=", tblbannerxcategorias c";
$sql.=" where a.idactivo='7' and a.id=b.idorigen and b.iddestino='$idpagina'";
$sql.=" and $fechaBaseNum between a.idfechai and a.idfechaf ";
if($pagina=="ecommerce.subcategorias.php") $sql.=" and  a.id=c.idorigen and c.iddestino=$idrelacion";
$sql.=" order by a.idpos asc ";
//echo $sql;
$result=$db->Execute($sql);
if(!$result->EOF){
?>
<article class="galeria_index">
<article class="centro_banner">
    <div class="border_box">
    <div class="box_skitter box_skitter_small">
      <ul>
      <?
          while(!$result->EOF){
          $dsimg=$result->fields[3];
          $dsruta=$result->fields[2];
          $dsmodo=$result->fields[4];
          if ($dsruta<>""){
          $ahref1="<a href='".$dsruta."' target='".$dsmodo."' title='".reemplazar($mensaje)."'>";
          $ahref2="</a>";
          }else{
          $ahref1="";
          $ahref2="";
          }
           ?>
           <li>
                <? echo $ahref1?>

                  <img src="<? echo $rutalocalimag;?>/contenidos/images/banners/<? echo $dsimg;?>" class="block" />

                <? echo $ahref2?>



                <div class="label_text">

                  <div class="label_titulos">

                  <h1>TITULO DEL BANNER PRINCIPAL</h1>

                  <h2>SUBTITULO DEL BANNER</h2>

                <p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen.

                </p>

                  </div>

                  <nav>

                    <a href="">INGRESAR</a>

                  </nav>

                </div>



              </li>

              <?

                $result->MoveNext();

                     } // fin while



              ?>

            </ul>

        </div>

    </div>

</article>

<?





}else{

$sql="select a.id,a.dsm,a.dsruta,a.dsimg from tblbanners a, tblbannersxtblpaginas b where a.idactivo=6 and a.id=b.idorigen and b.iddestino='$idpagina' LIMIT 0,1";

                //echo $sql;

                $result=$db->Execute($sql);

                if(!$result->EOF){

?>



 <article class="centro_banner">





  <article class="img_banner">



              <?



                   

                     $dsimg=$result->fields[3];

                     $dsruta=$result->fields[2];

                ?>



                <a href="<? echo $dsruta;?>">

                  <img src="<? echo $rutalocalimag;?>/contenidos/images/banners/<? echo $dsimg;?>" class="block" />

                </a>

                <!--div class="label_text"><p>block</p></div-->



</article>



</article>







</article>

<?}}$result->Close();?>



<?}?>



