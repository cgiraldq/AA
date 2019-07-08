
  <?
   $dsnombre=$_REQUEST["dsnombre"];

      $partir=explode("/",$dsnombre);
  ?>

  	<h1><? echo reemplazar($dstituloPagina);?> <? $idprod=seldato("dsm","dsruta","tblcategoria",$partir[0],2);?></h1>



  	<?

      $id=$_REQUEST["id"];
      $sql="select a.id,a.dsm,a.dsd,a.dsimg2,a.dsruta,a.dsvideo,a.dsd2,a.dsurl from tblproductos a where a.idactivo not in(2,9) ";
      if($dsnombre<>"")$sql.=" and a.dsruta='".$partir[1]."'";
      if($id<>"")$sql.=" and a.id=$id";
      //echo $sql;
     $maxregistros=4;
      include($rut."incluidos_sitio/paginar_variables.php");
      $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
      if(!$result->EOF){
      	$idm=$result->fields[0];
        $dsm=reemplazar($result->fields[1]);
        $dsd=nl2br($result->fields[2]);
        $dsd=reemplazar($dsd);
        $dsd=utf8_decode($dsd);
         $dsd2=utf8_decode($dsd2);

        $dsd2=nl2br($result->fields[6]);
        $dsd2=reemplazar($dsd2);

        $dsurl=reemplazar($result->fields[7]);
        $idcat=$result->fields[8];
       $dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));
        $dsimg=$result->fields[3];
        $dsvideo=$result->fields[5];
    ?>


  <article class="cms_producto_detalle">

    <h2><?echo $dsm;?></h2>

    <? if($dsimg<>""){?>
        <img src="<?echo $rutalocalimag?>/contenidos/images/producto/<? echo $dsimg;?>">
        <?}else{?>
           <div><? echo $dsvideo;?></div>
        <?}?>
    <p><? echo $dsd2;?></p>
	</article>
	<? //if($dsurl<>""){?>

    <!--a href="<? echo $dsurl;?>" target="_blank" class="btn_color">
      <p>IR AL SITIO WEB</p>
    </a-->

	<?//}?>
	<?

     }
      $result->Close();

    ?>


 <br><a name="anclaform"></a>

  <nav class="cont_botenes">
    <ul class="tabs">
      <li><a href="#anclaform" onclick="abrir_forma('frm_solicitar_pro_1','frm_solicitar_pro_2');"  class="btn_solicitar"><h2>Solicitar</h2></a></li>
       <li>
        <a href="oficinas.php" class="btn_solicitar"><h2>Ver Agencias</h2>
        </a>
      </li>
    </ul>
  </nav>

<?
  include("incluidos_sitio/cms.productos/formulario.solicitar.producto.php");
  include("incluidos_sitio/cms.productos/formulario.recomendar.producto.php");

?>

<?  include("incluidos_sitio/sindicacion/sindicacion.php");?>

<?  include("incluidos_sitio/cms.productos/otros.productos.php");?>

<?include("otros.productos2.php");?>
