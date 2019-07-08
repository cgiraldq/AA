		<? // validacion existencia del modulo
		if(validar_core($_SESSION['i_idusuario'],75)>0){
		$sql="select a.id,a.dsalias,a.dsruta from ecommerce_tblcategoria a ";
		$sql.=" where a.idactivo not in (2,9) and idmostrar=1 ";
		$sql.=" order by dsm asc ";
		$resultx=$db->Execute($sql);
		if(!$resultx->EOF){?>
		<nav class="menu_categorias menu_categorias2">
		<h2>CATEGORÍAS</h2>
		<ul>
		<?
		while (!$resultx->EOF) {
		$idm=$resultx->fields[0];
		$dsm=reemplazar($resultx->fields[1]);
		$dsruta=$resultx->fields[2];
		$dsrutax=$rutalocal."/categorias/".$dsruta;
  		if ($rutaAmiga>1) $dsrutax="ecommerce.subcategorias.php?idrelacion=".$idm;?>
		<li><a href="<? echo $dsrutax?>">
			<? echo $dsm?>
			</a>
		</li>
		<?
		$resultx->MoveNext();
		} // fin while*/
		?>
	    </ul>
		</nav>
		<?
		}
		$resultx->Close();
		?>

		<? } ?>