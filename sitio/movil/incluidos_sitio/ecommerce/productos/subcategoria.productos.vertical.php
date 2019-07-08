<?


if ($idrelacion=="" ) $idrelacion=$_REQUEST['idrelacion'];
$idrelacionx=$_REQUEST['dscategoria'];
if($idrelacionx=="")$idrelacionx=seldato("id","dsruta","ecommerce_tblcategoria",$_REQUEST['dscategoria'],2);
$sql="select a.id,a.dsm,a.dsimg1,a.dsruta from ecommerce_tblsubcategoriasxcategoria a ,ecommerce_tblcategoriaxsubcategoria b";
$sql.=" where a.idactivo not in (";
$sql.="2,9";
$sql.=") ";
if ($pagina=="ecommerce.productos.php" && $idrelacionx<>""){
$sql.=" and b.iddestino=$idrelacionx";
}else{
$sql.=" and b.iddestino=$idrelacion";	
}
$sql.=" and a.id=b.idorigen order by a.idpos asc ";
//echo $sql;
$result=$db->Execute($sql);
if(!$result->EOF){
?>
<article class="ecommerce_subcategorias">
		<ul>
		<?
		$contar=0;
		while (!$result->EOF) {
		$idm=$result->fields[0];
		$dsm=reemplazar($result->fields[1]);
		$dsimg1=$result->fields[2];
		$dsruta=$result->fields[3];
		if($pagina=="ecommerce.subcategorias.php"){
		$dsrutax="../subcategorias/".$_REQUEST['dsnombre']."/".$dsruta;
		}else{
		$dsrutax="../".$_REQUEST['dscategoria']."/".$dsruta;	
		}
		if ($rutaAmiga>1) $dsrutax="ecommerce.productos.php?idrelacion=".$idm."&dscategoria=".$idrelacion;
		if ($rutaAmiga>1 && $idrelacionx<>"" && $pagina=="ecommerce.productos.php") $dsrutax="ecommerce.productos.php?idrelacion=".$idm."&dscategoria=".$idrelacionx;	
		$contar=contarx('ecommerce_tblsubcategoriaxtblproducto','ecommerce_tblproductos',$idm);
		$contar=2;
		if($contar >= "1"){


		?>
						<li>
						<div>
						<a href="<? echo $dsrutax ?>"><h2><? echo $dsm?></h2></a>
						</div>
						</li>

		<?
		}
		$contar++;

		$result->MoveNext();
		}
		?>
		</ul>
</article>
<?
}
$result->Close();
?>
