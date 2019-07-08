<h1><? echo reemplazar($dstituloPagina);?></h1>

  <?include("incluidos_sitio/convenios/convenios.menu.php");?>

<article class="cont_txt">
<?
  $id=$_REQUEST["id"];
  $dsnombre=$_REQUEST["dsnombre"];
  $sql="select dsm,dsd,dsimg,dsvideo,dsciudad,dstelefono,dsdireccion,id,dsdescuento from $dstabla where idactivo not in(2,9)  ";
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

  $dsciudad=reemplazar($result->fields[4]);
  $dstelefono=reemplazar($result->fields[5]);
  $dsdireccion=reemplazar($result->fields[6]);
   $id=reemplazar($result->fields[7]);
   $dsdescuento=reemplazar($result->fields[8]);

?>

    <article class="bloque_texto">


      <article class="convenios_detalle convenios_vertical">

           


           <article class="info_porcentaje">

            <table border="0">
              <tr>
                <td width="25%">

             <a href="<? echo $dsrutax;?>"class="ver_mas">
              <? if($dsimg<>""){?><img src="<? echo $rutalocalimag;?>/contenidos/images/qsomos/<? echo $dsimg;?>" alt=""> <?}?>
           </a>

            </td>

            <td width="55%" >
          <h2><? echo $dsm;?></h2>
           <? echo $dsvideo?>

            <p><? echo $dsd;?> </p>
            <p><strong>Beneficios</strong></p>
            <p><? echo $dsdescuento;?> </p>

            </td>
            <td style="text-align:right;">

            <article class="cantidad_porcentaje">
              50%
            </article>
            </td>
              </tr>
            </table>


            </article>


          <div class="info_servicios">
            <p><strong>Aplica en: </strong><? echo $dsciudad;?></p>
            <p><strong>Teléfono: </strong><? echo $dstelefono;?></p>
            <p><strong>Dirección:</strong><? echo $dsdireccion;?></p>
          </div>
      </article>

        <a class="fancybox fancybox.iframe img_link" onclick="popup('<? echo $rutalocal;?>/incluidos_sitio/convenios/imprimir.php?id=<? echo $id;?>')" href="">
          <img src="<? echo $rutalocal;?>/images/imprimir.png">
        </a>

    </article>


<?
$result->MoveNext();
}
}
$result->Close();
?>


<? include("incluidos_sitio/convenios/otros.convenios.php");?>

  </article>

  <script type="text/javascript">
  function popup(ruta){
  window.open(ruta,'','scrollbars=no,width=600,height=600,left=50,top=2');
}

  </script>

