<?
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
?>
	<h1><? echo reemplazar($dstituloPagina);?></h1>
<article class="noticas_centro_vertical">
<?  //$db->debug = true;?>


<!--vistas del blog-->
<!--Este incluido inserta tcada vez que se visite el blog para  generar el
lateral temas mas leidos -->

<!--Cierra vistas del blog-->
      <?
      if($_SESSION['idioma']=="")$_SESSION['idioma']=1;
      	$id=$_REQUEST['id'];
      	$rutax=$_REQUEST['rutax'];

      	$activo=$_REQUEST['activo'];

      	if($dsnombre=="") {
      		$dsnombre=$rutax;
      	}

   		if($activo<>""){
   		$activo=$activo;
   		}else{
   		$activo="1,3";
   		}




 if($dsnombre<>""){
include("vistas.blog.php");
 }
 		if ($rutalocalimag=="") $rutalocalimag="/";
        $rutaImagen=$rutalocalimag."contenidos/images/blog/";
        if($_SESSION['idioma']==1){
        $sql="select id,dsm,dsd,idcategoria,dsruta,idautor,dsfechain,dsimg2,dsvideo from blogtblblog where  idactivo in (".$activo.")";
        if($dsnombre<>"") $sql.=" and dsruta='$dsnombre'";
        if($id<>"") $sql.=" and id='$id'";
      	}


        if($_SESSION['idioma']==2){
        $sql="select id,dsmingles,dsdlargoingles,idcategoria,dsrutaingles,idautor,dsfechain,dsvideo from blogtblblog where dsrutaingles='$dsnombre' and idactivo in (".$activo.")";
      	if($dsnombre<>"") $sql.=" and dsruta='$dsnombre'";
        if($id<>"") $sql.=" and id='$id'";
      	}
      	//echo $sql;


        $result=$db->Execute($sql);
        if(!$result->EOF){
      	$id=reemplazar($result->fields[0]);
      	$idblog=reemplazar($result->fields[0]);

        $dsm=reemplazar($result->fields[1]);
        $dsd=reemplazar(preg_replace("/\n/","<br>",$result->fields[2]));
     	//$dsd=str_replace("../","",$dsd);
     	$idcategoria=$result->fields[3];
     	$idautor=$result->fields[5];
     	$dsfechain=$result->fields[6];
     	$dsimg=$result->fields[7];
     	$dsvideo=$result->fields[dsvideo];


		$dsautor=seldato("dsm","id","blogtblautores",$idautor,1);

     	$rutacategoria=seldato("dsruta","id","blogtblcategorias",$idcategoria,1);
     	$nombrecategoria=seldato("dsm","id","blogtblcategorias",$idcategoria,1);
     	//$rutamiga="http://localhost:8080/blog_holasa/holascategorias/".$rutacategoria;
     	$rutamiga="http://www.holasa.com.co/blog_holasa/holascategorias/".$rutacategoria;
     	$rutac="http://www.holasa.com.co/blog_holasa/holascategorias/".$rutacategoria;
        $dsruta=reemplazar($result->fields[4]);
        $dsrutablog=reemplazar($result->fields[4]);

      ?>
 <?
 $m=3;
 //include("incluidos_sitio/miga/miga.php");
 ?>




	<article class="txt_qsomos">
	<h2><? echo $dsm ?></h2>
<? if($idblogx<>""){ ?>

	<a href="modulos/blog/editar.php?idx=<? echo $idblogx ?>">Regresar</a>
	<? }else{ ?>
<!--a href="<? echo $rutac ?>" class="seguir_leyendo">Regresar a las categorías</a-->
	<? } ?>
	<!--p>Donec vitae nisl turpis, vitae interdum nisl. Nulla sed sollicitudin nunc. Proin rhoncus purus ut erat rhoncus at iaculis
	enim dapibus. Mauris sed eros in sem porta adipiscing in a arcu.</p-->

	<p class="fecha"><? echo $dsfechain?></p>

	<?  if($_SESSION['idioma']==1){?>
	<p class="nombre_autor">Autor: <? echo $dsautor?></p>
	<?}?>

	<?  if($_SESSION['idioma']==2){?>
	<p class="nombre_autor">Authors: <? echo $dsautor?></p>
	<?}?>

	</article>
	<article class="cont_blog">

	  <article class="bloque_texto">
	  	<?if($dsimg<>""){?>
	  	<img src="<?echo $rutaImagen.$dsimg?>" >
	  	<?}?>
	  	<?   $idcapx=$_REQUEST['idcapx'];?>
	  	<p><?echo $dsd; ?></p>
	  	<div><?echo $dsvideo?></div>
	  	<?include("incluidos_sitio/carrusel/carrusel.php");?>
	</article>
	</article>
	<?
		}else{?>

		<?  if($_SESSION['idioma']==1){?>
		<p>En estos momentos no hay temas disponibles</p>
		<?}?>

		<?  if($_SESSION['idioma']==2){?>
		<p>At present there is no available themes.</p>
		<?}?>
	<?

		}
		$result->close();
	?>
	<!--nav class="cont_botenes">
		<ul class="botones">
			<li><a href="detalle.blog.php" class="btn_general">Seguir leyendo</a></li>
		</ul>
	</nav-->


<? if($idblogx==""){ ?>

<nav class="cont_botenes">
		<ul class="tabs">
			<?  $enviarblog=$rutablogcomnetario.$dsnombre ?>

			<li><a href="#comentar" class="btn_trayectoria"><p>
				<?  if($_SESSION['idioma']==1){?>
				Comentar
				<?}?>

				<?  if($_SESSION['idioma']==2){?>
				Comments
				<?}?>
				</p>
			</a>
			</li>
			<li><a href="#comentarios" class="btn_trayectoria"><p>
				<?  if($_SESSION['idioma']==1){?>
				Ver comentarios
				<?}?>

				<?  if($_SESSION['idioma']==2){?>
				View comments
				<?}?>
				</p>

			</a>
					<?//include("incluidos_sitio/blog/responder.php");?>
			</li>
		</ul>
	</nav>
	<? include("incluidos_sitio/blog/frm.comentar.php");?>
	<? include("incluidos_sitio/blog/comentarios.php");?>
			  <?include("incluidos_sitio/sindicacion/sindicacion.php");?>
<? } ?>
	<article class="separacion_blog"></article>
</article>
