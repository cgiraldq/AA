<article class="cont_txt">

	<h1><? echo reemplazar($dstituloPagina);?></h1>
  <? include("enlaces.php");?>
	<?
      $dsnombre=$_REQUEST["dsnombre"];
      $id=$_REQUEST["id"];
      $sql="select a.dsm,a.dsd2,a.dsimg2 from $dstabla a where idactivo=1  ";
      if($dsnombre<>"")$sql.=" and a.dsruta='$dsnombre'";
      if($id<>"")$sql.=" and id=$id";

     // echo $sql;
     $maxregistros=4;
      include($rut."incluidos_sitio/paginar_variables.php");
      $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
      if(!$result->EOF){

          $dsm=reemplazar($result->fields[0]);
             $dsd=reemplazar($result->fields[1]);
          $dsimg=nl2br($result->fields[2]);

    ?>

	<article class="servicios_detalle">


    <h2><?echo $dsm;?></h2>
		 <? if($dsimg<>""){?><img src="<? echo $rutalocalimag;?>/contenidos/images/eventos/<? echo $dsimg; ?>"><?}?>

    <!--p><strong>Fecha: </strong><? echo $fecha;?></p>
    <p><strong>Hora: </strong><? echo $hora;?></p>
    <p><strong>Lugar: </strong> <? echo $lugar;?></p-->
		<p><? echo $dsd;?></p>

		<div class="barra"></div>


	</article>

	<?

     }
      $result->Close();

    ?>
 <br><a name="anclaform"></a>


<?	include("incluidos_sitio/sindicacion/sindicacion.php");?>

<?	include("otros.beneficios.php");?>



</article>




