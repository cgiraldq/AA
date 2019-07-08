<?
$sinespacios=1;
$dsbusqueda=trim(($_REQUEST['dsbusqueda']));
$dsbusquedax=utf8_decode($dsbusqueda);
    $sql="select id,dsm,1 as valor,dsd,dsruta from  tblproductos  where ";
    $sql.=" (";
    $sql.="  dsm like '%".$dsbusquedax."%' or dsd like '%".$dsbusquedax."%'";
    $sql.=")";
    $sql.=" and idactivo<>2";

    $sql.=" union ";
    $sql.="select id,dsm,2 as valor,dsd,dsruta from tblservicios  where ";
    $sql.=" (";
    $sql.="  dsm like '%".$dsbusqueda."%' or dsd like '%".$dsbusqueda."%' or dsd like '%".reemplazar($dsbusqueda)."%' or dsm like '%".reemplazar($dsbusqueda)."%'";
    $sql.=")";
    $sql.=" and idactivo<>2";

    $sql.=" union ";
    $sql.="select id,dsm,3 as valor,dsd,dsruta from tblqsomos  where ";
    $sql.=" (";
    $sql.="  dsm like '%".$dsbusqueda."%' or dsd like '%".$dsbusqueda."%' or dsd like '%".reemplazar($dsbusqueda)."%' or dsm like '%".reemplazar($dsbusqueda)."%'";
    $sql.=")";
    $sql.=" and idactivo<>2";

    $sql.=" union ";
    $sql.="select id,dsm,4 as valor,dsd,dsruta from blogtblblog  where ";
    $sql.=" (";
    $sql.="  dsm like '%".$dsbusqueda."%' or dsd like '%".$dsbusqueda."%' or dsd like '%".reemplazar($dsbusqueda)."%' or dsm like '%".reemplazar($dsbusqueda)."%'";
    $sql.=")";
    $sql.=" and idactivo<>2";

     $sql.=" union ";
    $sql.="select id,dsm,5 as valor,dsd,dsruta from tblpremios  where ";
    $sql.=" (";
    $sql.="  dsm like '%".$dsbusqueda."%' or dsd like '%".$dsbusqueda."%' or dsd like '%".reemplazar($dsbusqueda)."%' or dsm like '%".reemplazar($dsbusqueda)."%'";
    $sql.=")";
    $sql.=" and idactivo<>2";



    $maxregistros=10;
    include("incluidos_modulos/paginar.variables.php");
//echo $maxregistros;
    $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
     $total=$result->RecordCount();
     //echo $sql;
    ?>

     <?
           if(!$result->EOF){
         ?>


<h3 class="barra_buscador">Resultados de Busqueda para: <span><? echo $dsbusqueda ?></span></h3>


<article class="cont_relacionado">
	<ul>

<?
    while(!$result->EOF){
    $id=$result->fields[0];
    $dsm=$result->fields[1];
    $valor=$result->fields[2];
    $dsd=reemplazar($result->fields[3]);
    $dsd=elliStr($result->fields[3],250);
    $dsruta=$result->fields[4];
    $dsrutax=$rutalocal."/gmproductos/".$dsruta;



    if($valor==1)  $dsrutax=$rutadetalle."mis_productos/".$dsruta;
    if($valor==2) $dsrutax=$rutadetalle="mis_servicios/".$dsruta;
    if($valor==3) $dsrutax=$rutadetalle="quienes_somos/".$dsruta;
    if($valor==4) $dsrutax=$rutadetalle="mis_blogs/".$dsruta;
    if($valor==5) $dsrutax=$rutadetalle="premios.php";

?>
		<li>
			<a href="<? echo $dsrutax ?>">
				<article>

					<h2><? echo reemplazar($dsm) ?></h2>
					<p><? echo reemplazar($dsd) ?></p>
					<div style="clear:both;"></div>
				</article>
			</a>
		</li>

	<?
		$result->MoveNext();
		}
        $rutaPaginacion="dsbusqueda";

		        include("incluidos_sitio/func.paginador.php");

		}else{
	?>


	</ul>
</article>

<?include("incluidos_sitio/buscador/frm.buscador.php");?>


  <?
        }
        $result->Close();
    ?>
