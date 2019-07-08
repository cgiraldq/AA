    <h1><? echo reemplazar($dstituloPagina);?></h1>


<?
//$db->debug=true;
$idbuscador=$_REQUEST['idbuscador'];
$sinespacios=1;
$idcolores=($_REQUEST['idcolor']);
$idmarca=$_REQUEST['dsmarca'];
if($idmarca<>"")$dsmarca=seldato('dsm','id','ecommerce_tblmarcas',$idmarca,2);
$idcoloresy=count($idcolores);

for ($i=0; $i < $idcoloresy; $i++) { 
$idcoloresx=$idcoloresx.$idcolores[$i].",";
}
$idcoloresx=trim($idcoloresx,",");
$idpreciobase=$_REQUEST['idprecio_b'];
$idsubt=$_REQUEST['idsubt'];
$idcategoria=$_REQUEST['idcategoria'];

if($idpreciobase<>""){
$partir_p=explode("|",$idpreciobase);
$idpreciobase_1=$partir_p[0];
$idpreciobase_2=$partir_p[1];    
}
$dsbusquedax=trim(($_REQUEST['dsbusqueda']));
//$dsbusquedax=utf8_decode($dsbusqueda);
//$db->debug=true;
?>
<h3 class="barra_buscador">Resultados de Busqueda para: <span><? echo $dsbusqueda ?></span></h3>


<article class="cont_relacionado">
    <?
    $sql="select a.id,a.dsm,1 as valor,a.dsd2,a.dsruta from  ecommerce_tblproductos a";
    if($idcoloresx<>"")     $sql.="  inner join  ecommerce_tbltallasxtblproductos b  on a.id=b.idorigen";//  relacion colores por producto
    if($idcategoria<>"" && $idsubt=="")    $sql.="  inner join  tbltblproductoxcategoria c on  a.id=c.idorigen";// relaciones productos por categoria
    if($idsubt<>"")         $sql.="  inner join  ecommerce_tblsubcategoriaxtblproducto d  on a.id=d.idorigen";// relaciones con subcategorias
                            $sql.="  where a.idactivo not in (2,9) ";

    if($dsbusquedax<>"")    $sql.=" or   ( a.dsm like '%".$dsbusquedax."%' or a.dsd like '%".$dsbusquedax."%'  ";//   Buscar por palabra
    if($dsbusquedax<>"")    $sql.=" or a.dsd2 like '%".$dsbusquedax."%' or a.dscarac like '%".$dsbusquedax."%' ";//   Buscar por palabra 
    if($dsbusquedax<>"")    $sql.=" or  a.dsdp like '%".$dsbusquedax."%' or a.dskw like '%".$dsbusquedax."%' or a.dsreferencia like '%".$dsbusquedax."%' )";//   Buscar por palabra    

    if($idpreciobase_2<>"" && $idpreciobase_1<>"")$sql.=" and (a.precio1 between $idpreciobase_1 and $idpreciobase_2) "; //  rango de  precios
    if($idmarca<>"" && $dsmarca<>"") $sql.=" and dsmarca='".$dsmarca."'";//  marca 


    if($idcoloresx<>"")     $sql.="  and  b.idcolor  in ($idcoloresx) ";  //  por  colores
    if($idsubt<>"")         $sql.="  and  d.iddestino in ($idsubt) ";// subcategoria
    if($idcategoria<>"" && $idsubt=="")    $sql.="  and  c.iddestino in ($idcategoria)";// categorias
   //$sql.=" and idactivo not in (2,9) ";
    
    if($idbuscador<>1){// validacion cuando es  lateral  del ecommercer
    /*$sql.=" union ";
    $sql.="select id,dsm,2 as valor,dsd,dsruta from tblservicios  where ";
    $sql.=" (";
    $sql.="  dsm like '%".$dsbusquedax."%' or dsd like '%".$dsbusquedax."%' or dsd like '%".reemplazar($dsbusqueda)."%' or dsm like '%".reemplazar($dsbusqueda)."%'";
    $sql.=")";
    $sql.=" and idactivo not in (2,9)";

    $sql.=" union ";
    $sql.="select id,dsm,3 as valor,dsd,dsruta from tblqsomos  where ";
    $sql.=" (";
    $sql.="  dsm like '%".$dsbusquedax."%' or dsd like '%".$dsbusquedax."%' or dsd like '%".reemplazar($dsbusqueda)."%' or dsm like '%".reemplazar($dsbusqueda)."%'";
    $sql.=")";
    $sql.=" and idactivo not in (2,9)";
    */
    $sql.=" union ";
    $sql.="select id,dsm,4 as valor,dsd,dsruta from blogtblblog  where ";
    $sql.=" (";
    $sql.="  dsm like '%".$dsbusquedax."%' or dsd like '%".$dsbusquedax."%' or dsd like '%".reemplazar($dsbusqueda)."%' or dsm like '%".reemplazar($dsbusqueda)."%'";
    $sql.=")";
    $sql.=" and idactivo not in (2,9)";
    /*
    $sql.=" union ";
    $sql.="select id,dsm,5 as valor,dsd,dsruta from tbltiendas  where ";
    $sql.=" (";
    $sql.="  dsm like '%".$dsbusquedax."%' or dsd like '%".$dsbusquedax."%' or dsd like '%".reemplazar($dsbusqueda)."%' or dsm like '%".reemplazar($dsbusqueda)."%'";
    $sql.=")";
    $sql.=" and idactivo not in (2,9)";
    $sql.=" union ";
    $sql.="select id,dsm,6 as valor,dsd,dsruta from tbltips  where ";
    $sql.=" (";
    $sql.="  dsm like '%".$dsbusquedax."%' or dsd like '%".$dsbusquedax."%' or dsd like '%".reemplazar($dsbusqueda)."%' or dsm like '%".reemplazar($dsbusqueda)."%'";
    $sql.=")";
    $sql.=" and idactivo not in (2,9)";
    
    $sql.=" union ";
    $sql.="select id,dstit,7 as valor,dsd,dsm from tblpaginas  where ";
    $sql.=" (";
    $sql.="  dsm like '%".$dsbusquedax."%' or dsd like '%".$dsbusquedax."%' or dsd like '%".reemplazar($dsbusqueda)."%' or dsm like '%".reemplazar($dsbusqueda)."%'";
    $sql.=")";
    $sql.=" and idactivo not in (2,9)";
    */
    }
    //echo $sql;
     $maxregistros=10;
    include("incluidos_sitio/paginar_variables.php");
//echo $maxregistros;
    $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
     $total=$result->RecordCount();
    // echo $sql;
    ?>

     <?
           if(!$result->EOF){
         ?>

	<ul>

<?  while(!$result->EOF){
    $id=$result->fields[0];
    $dsm=$result->fields[1];
    $valor=$result->fields[2];
    $dsd=reemplazar($result->fields[3]);
    $dsd=str_replace(">;<","><",$dsd);

    $dsd=str_replace("&nbsp;","",$dsd);
    $dsd=htmlspecialchars_decode($dsd);
    $dsd=utf8_decode($dsd);
    $dsd=html_entity_decode($dsd);
    $dsd=(reemplazar(preg_replace("/\n/","<br>",$dsd)));
    $dsd=elliStr($dsd,80);
    $dsruta=$result->fields[4];
    $dsrutax=$rutalocal."/productos/".$dsruta;
    


    if($valor==1){
    $rutaImagen="contenidos/images/ecommerce_productos/";
    $dsimg1=seldato('dsimg','iddestino','ecommerce_tblproductoximg',$id,1);   
    }

    if($rutaAmiga==1){
    if($valor==1) $dsrutax=$rutadetalle."producto/".$dsruta;
    if($valor==2) $dsrutax=$rutadetalle="mis_servicios/".$dsruta;
    if($valor==3) $dsrutax=$rutadetalle="quienes_somos/".$dsruta;
    if($valor==4) $dsrutax=$rutadetalle="mis_blogs/".$dsruta;
    if($valor==5) $dsrutax=$rutadetalle="mis-tiendas/".$dsruta;
    if($valor==6) $dsrutax=$rutadetalle="mis-tips/".$dsruta;
    if($valor==7) $dsrutax=$rutbase."/".$dsruta;   
    }else{
    if($valor==1) $dsrutax=$rutbase."ecommerce.productos.detalle.php?idrelacion=".$id;
    if($valor==2) $dsrutax=$rutbase.$rutadetalle="mis_servicios/".$dsruta;
    if($valor==3) $dsrutax=$rutbase."/qsomos.detalle.php?id=".$id;
    if($valor==4) $dsrutax=$rutbase."/blog.php?id=".$id;
    if($valor==5) $dsrutax=$rutbase."/tiendas.php";
    if($valor==6) $dsrutax=$rutbase."/tips.php"; 
    if($valor==7) $dsrutax=$rutbase."/".$dsruta;   
    }
?>
		<li>
			<a href="<? echo $dsrutax ?>">
				<article>
                    <?
                    
                    if($valor==1){
                    if (is_file($rutaImagen.$dsimg1)){
                    //if($dsimg1<>""){?>
                    <a href="<? echo $dsrutax?>">
                    <img src="<? echo $rutaImagen.$dsimg1?>" alt="">
                    </a>
                    <?}else{?>
                    <a href="<? echo $dsrutax ?>"><img src="contenidos/images/ecommerce_productos/" alt=""></a>
                    <?}
                    }

                    ?>
					<h2><? echo reemplazar($dsm) ?></h2>
					<p><? echo reemplazar($dsd) ?></p>
					<div style="clear:both;"></div>
				</article>
			</a>
		</li>

	<?
		$result->MoveNext();
		}
        $pagina="ecommerce.buscador.php?";
        $rutaPaginacion=$pagina."dsbusqueda=$dsbusquedax&page=";


                ?></ul><?

        }else{
    ?>




<?include("incluidos_sitio/buscador/frm.buscador.php");?>


  <?
        }
        $result->Close();
    ?>


        
</article>
<?include("incluidos_sitio/func.paginador.php");?>
