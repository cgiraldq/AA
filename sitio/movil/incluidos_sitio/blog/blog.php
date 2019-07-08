	<article class="noticas_centro_vertical">
<?  $rutax=$_REQUEST['rutax'];

if($dsnombre=="") {
if ($idrelacion=="") $idrelacion=$idblog;
	$dsnombre=$rutax;
}

?>
  <?include("incluidos_sitio/miga/miga.php");?>
 ?>
	<article class="txt_qsomos">
	<!--p>Donec vitae nisl turpis, vitae interdum nisl. Nulla sed sollicitudin nunc. Proin rhoncus purus ut erat rhoncus at iaculis
	enim dapibus. Mauris sed eros in sem porta adipiscing in a arcu.</p-->
	</article>
	<article class="cont_blog">
	  <!--article class="color"></article-->
	<article class="bloque_texto">

      <?
    //  if($dsnombre=="") $dsnombre="revista_holasa";

        $rutaImagen=$rut."../contenidos/images/blog/";
        $sql="select id,dsm,dssubt,dsimg,dsimg2,dsimg3,from tblblog where  dsruta='$dsnombre'";
        //    echo $sql;
        $result=$db->Execute($sql);
        if(!$result->EOF){
      	$id=reemplazar($result->fields[0]);
        $dsm=reemplazar($result->fields[1]);
        $dssubt=reemplazar($result->fields[2]);
        $dsimg=($result->fields[3]);
        $dsimg2=($result->fields[4]);
        $dsimg3=($result->fields[5]);
   	    $desc1=reemplazar(preg_replace("/\n/","<br>",$result->fields[7]));
          ?>

      	<h1><? echo $dsm ?></h1>


      	<article class="fecha">
		<p class="mes"><? echo $dsfecha ?></p>
		</article>
		</article>

      				<? if($pos1==1){ ?>
					  <?include("blogimg1.php");?>
					  <br>
					  <? } ?>

<?
}
$result->close();

?>

	</article>
			  <?include("incluidos_sitio/sindicacion/sindicacion.php");?>
	</article>
	<!--nav class="cont_botenes">
		<ul class="botones">
			<li><a href="detalle.blog.php" class="btn_general">Seguir leyendo</a></li>
		</ul>
	</nav-->
<nav class="cont_botenes">
		<ul class="botones">
			<li><a href="#comentar" class="btn_comentar btn_general_ico ico_pencil">Comentar</a></li>

			<li><a href="#comentarios" class="btn_comentario btn_general_ico ico_coment">Ver comentarios</a></li>
		</ul>
	</nav>

	<?include("incluidos_sitio/blog/frm.comentar.php");?>

	<?include("incluidos_sitio/blog/comentarios.php");?>


	<article class="separacion_blog"></article>

</article>
