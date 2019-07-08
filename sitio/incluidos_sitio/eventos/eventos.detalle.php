	<h1><? echo $dstituloPagina?></h1>
	<?
      $dsnombre=$_REQUEST["dsnombre"];
      $id=$_REQUEST["id"];
      $sql="select a.dsm,a.dsd2,a.dsimg2,a.dshora,a.dslugar,a.dsfechainicial from $dstabla a where idactivo=1  ";
      if($dsnombre<>"")$sql.=" and a.dsruta='$dsnombre'";
      if($id<>"")$sql.=" and id=$id";

      //echo $sql;
     $maxregistros=4;
      include($rut."incluidos_sitio/paginar_variables.php");
      $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
      if(!$result->EOF){

          $dsm=reemplazar($result->fields[0]);
          $dsd=reemplazar($result->fields[1]);
          $dsimg=nl2br($result->fields[2]);

          $hora=nl2br($result->fields[3]);
          $lugar=nl2br($result->fields[4]);
          $fecha=nl2br($result->fields[5]);
    ?>

	<article class="evento_detalle">
    <h2><?echo $dsm;?></h2>
		 <? if($dsimg<>""){?><img src="<? echo $rutalocalimag;?>/contenidos/images/eventos/<? echo $dsimg; ?>"><?}?>

    <p><strong>Fecha: </strong><? echo reemplazar($fecha);?></p>
    <p><strong>Hora: </strong><? echo reemplazar($hora);?></p>
    <p><strong>Lugar: </strong> <? echo reemplazar($lugar);?></p>
		<p><? echo $dsd;?></p>

	</article>

	<?

     }
      $result->Close();

    ?>
<a name="anclaform"></a>

<?	include("incluidos_sitio/sindicacion/sindicacion.php");?>

<?	include("incluidos_sitio/eventos/otros.eventos.php");?>
