<article class="cont_txt">

	<h1><? echo $dstituloPagina?></h1>
	<?
      $dsnombre=$_REQUEST["dsnombre"];
      $id=$_REQUEST["id"];
      $sql="select a.dsm,a.dsd2,a.dsimg2 from $dstabla a where idactivo=1  ";
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

    ?>

	<article class="servicios_detalle">

		 <? if($dsimg<>""){?><img src="<? echo $rutalocalimag;?>/contenidos/images/servicios/<? echo $dsimg; ?>"><?}?>

		<h2><?echo $dsm;?></h2>
		<p><? echo $dsd;?></p>

		<div class="barra"></div>


	</article>

	<?

     }
      $result->Close();

    ?>
 <br><a name="anclaform"></a>

	<nav class="cont_botenes">
		<ul class="tabs">
			<li><a href="#anclaform" onclick="abrir_forma('frm_solicitar_pro_2','frm_solicitar_pro_1');" class="btn_color"><p>RECOMENDAR</p></a></li>
			<li><a href="#anclaform" onclick="abrir_forma('frm_solicitar_pro_1','frm_solicitar_pro_2');"  class="btn_color"><p>SOLICITAR ASESORIA</p></a></li>
		</ul>
	</nav>

<?
	include("incluidos_sitio/servicios/formulario.recomendar.servicios.php");
	include("incluidos_sitio/servicios/formulario.solicitar.servicios.php");

?>

<?	include("incluidos_sitio/sindicacion/sindicacion.php");?>

<?	include("incluidos_sitio/servicios/otros.servicios.php");?>



</article>




