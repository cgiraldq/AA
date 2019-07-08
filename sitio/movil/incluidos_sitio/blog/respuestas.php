
<?   $numrespuestax=$_REQUEST['numrespuestax'];
if($numrespuestax==$e){

$resp="bloc";

}else{

$resp="none";

}



?>

<article id='respuestas<? echo $e ?>' class="respuestas" style="display:<? echo $resp ?>;" >
		<article class="txt_qsomos">
		<h2>Respuestas</h2>
		<p></p>
		</article>
		<?
		$sql="select b.id,b.dsm,b.dscom,b.dsciudad from blogtblcomentarios a,  blogtblrespuestas b  where  a.id=b.idc and a.id=$idc";
		//	echo $sql;
		//$maxregistros=30;
		 //include($rut."incluidos_sitio/paginar_variables.php");
		//$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
		$result=$db->Execute($sql);
		if(!$result->EOF){
	?>
	<?
		$i=0;
		while(!$result->EOF){
		 $id=reemplazar($result->fields[0]);
		$dsm=reemplazar($result->fields[1]);
		$dscom=reemplazar(preg_replace("/\n/","<br>",$result->fields[2]));
		$dsciudad=$result->fields[3];

	?>
				<article class="textos color_bg_azul color_bg_gris ">
				<article class="capa">
					<img src="<? echo $rutbase ?>/images/icono_comentario.png" alt="">
				</article>
					<article class="flecha"></article>
					<h2 class="usuario_respuesta"><? echo $dsm ?></h2>
					<!--h4>Medellín</h4-->

					<div id="comf">	<p><? echo $dscom ?></p></div>
				<nav class="cont_botones_respuesta">
					<ul class="botones">
						<?  $enviarblog="blog.php?".$dsnombre ?>
						<li><a href="<? echo $enviarblog ?>&idresp=1&idc=<? echo $idc ?>&res=<? echo $e ?>#comentar" class="btn_comentar btn_general_ico ico_pencil">Responder</a></li>
						<!--li><a href="#respuestas" class="ver_respuestas btn_general_ico ico_pencil">Ver respuestas</a></li-->
					</ul>
				</nav>
				</article>
				<article class="comentario_blog_100">
				<?//include("incluidos_sitio/blog/responder.php");?>
				</article>

<?
	$i++;
	$result->MoveNext();
	}
?>
<?
	}
	$result->Close();
?>
 <?    /*if($totalregistros>$maxregistros)
                    {
                        $rutaPaginacion=$pagina."?";
                        include ($rut."incluidos_sitio/panel.paginar.php");
                    }*/
?>

		<? //include("incluidos_sitio/paginador/paginador.php");?>
</article>