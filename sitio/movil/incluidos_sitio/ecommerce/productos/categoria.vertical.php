<?
// listar categorias de la tienda          $db->debug=true;
	$sql="select a.id,a.dsalias,a.dsimg1,a.dsd,dsruta from ecommerce_tblcategoria a ";
	$sql.=" where a.idactivo not in (2,9) ";
	$sql.=" order by idpos ASC";
//echo $sql;

            $maxregistros=15;
            include("../incluidos_modulos/paginar.variables.php");
            $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
            if(!$result->EOF){
			 $rutaImagen=$rutaFuenteImagenes."/../contenidos/images/ecommerce_categoria/";


?>

<article class="ecommece_categorias">
	<ul>


			<?
	        $contar=0;
            while (!$result->EOF && ($contar<$maxregistros)) {
			$idm=$result->fields[0];
			$dsm=reemplazar($result->fields[1]);
			$dsimg1=$result->fields[2];
			$dsd=reemplazar(preg_replace("/\n/","<br>",$result->fields[3]));
			$dsruta=$result->fields[4];
			$dsrutax="ecommerce.subcategorias.php?idrelacion=".$idm;
			?>
		<li>

			<?
			if ($dsimg1<>""){?>
				<a href="<? echo $dsrutax?>"><img src="<? echo $rutaImagen.$dsimg1?>" alt=""></a>
			<?}else{?>
			<a href="<? echo $dsrutax?>"><img src="../images/img_sin.png" alt=""></a>
			<?}?>
			<div>
				<a href="<? echo $dsrutax ?>"><h2><? echo $dsm?></h2></a>
			</div>

		</li>
		<?
        $contar++;

        $result->MoveNext();
        }

		?>

	</ul>

</article>


<?
// fin listar lkas categorias de la tienda
			}
			$result->Close();

?>
