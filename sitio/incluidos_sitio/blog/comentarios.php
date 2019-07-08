<?

if($idcapx==1){
$comentario="bloc";
}else{
	$comentario="none";
}
?>

<article id='comentarios' class="comentarios_blog" style="display:<? echo $comentario ?>;">
		<article class="txt_qsomos">
		<?  if($_SESSION['idioma']==1){?>
		<h2>Comentarios</h2>
		<?}?>

		<?  if($_SESSION['idioma']==2){?>
		<h2>Comments</h2>
		<?}?>
		<p></p>
		</article>
		<?
		$sqlm="select b.id,b.dsm,b.dscom,b.dsciudad from blogtblblog a, blogtblcomentarios b  where  a.id=b.idr and a.id=$id and b.idactivo=1 ";
		//echo $sqlm;
		//$maxregistros=30;
		//include("incluidos_sitio/paginar_variables.php");
		//$resultm=$db->PageExecute($sqlm,$maxregistros,$pagina_actual);
		$resultm=$db->Execute($sqlm);
		if(!$resultm->EOF){
	?>
	<?
		$e=0;
		while(!$resultm->EOF){
	   $idc=reemplazar($resultm->fields[0]);
		$dsm=reemplazar($resultm->fields[1]);
		$dscom=reemplazar(preg_replace("/\n/","<br>",$resultm->fields[2]));
		$dsciudad=$resultm->fields[3];
	?>

				<article class="comentario_blog_100">
				<article class="textos color_bg_azul">
				<article class="capa">
					<img src="<? echo $rutbase ?>/images/icono_comentario.png" alt="">
				</article>
					<article class="flecha"></article>
					<h2><? echo $dsm ?></h2>
					<!--h4>Medellín</h4-->
						<p><? echo $dscom ?></p>
				<nav class="cont_botones_respuesta">
					<ul class="botones">
						<?  $enviarblog="blog.php?id=".$id ?>
						<li><a href="<? echo $enviarblog ?>&idresp=1&idc=<? echo $idc ?>&idx=1#comentar"class="btn_comentar btn_general_ico ico_pencil">Responder</a></li>
					<?	$tit="";
					$sqlx="select count(*) as total from blogtblrespuestas where idc=$idc";
					//echo $sqlx;
					$resultx=$db->Execute($sqlx);
						if(!$resultx->EOF){
						    $cantrespuestas=reemplazar($resultx->fields[0]);
							if ($tit=="") $tit=0;
						$tit="(".$tit.")";
					}
					$resultx->close()
					?>
						<li><a href="#respuestas<? echo $e ?>" class="ver_respuestas<? echo $e ?> btn_general_ico ico_pencil">Ver respuestas (<? echo $cantrespuestas ?>)</a></li>
					</ul>
				</nav>
				</article>
				<article class="respuestas_blog">
<?//include("incluidos_sitio/blog/frm.comentar.php");?>

				<?
				include("incluidos_sitio/blog/respuestas.php");?>
				</article>

		</article>
<?
	$e++;
	$resultm->MoveNext();
	}
?>
<? for ($e=0; $e <$idc ; $e++) { ?>
   <script type="text/javascript">
      $(".responder").click(function(){
            $("#responder").show();
            $("#respuestas<? echo $e ?>").hide();
       });
        $(".ver_respuestas<? echo $e ?>").click(function(){
            $("#responder<? echo $e ?>").hide();
            $("#respuestas<? echo $e ?>").show();
       });
         </script>
         <? } ?>
<?
	}
	$resultm->Close();
?>
 <?    /*if($totalregistros>$maxregistros)
                    {
                        $rutaPaginacion=$pagina."?";
                        include ($rut."incluidos_sitio/panel.paginar.php");
                    }*/
?>
		<? //include("incluidos_sitio/paginador/paginador.php");?>
   <script type="text/javascript">
       $(".btn_comentar").click(function(){
            $("#comentar").show();
            $("#comentarios").hide();
       });

       $(".btn_comentario").click(function(){
            $("#comentar").hide();
            $("#comentarios").show();
       });
<? if ($e>0) {?>
	document.getElementById('comentarios').style.display="";
    <? } ?>
                </script>

</article>