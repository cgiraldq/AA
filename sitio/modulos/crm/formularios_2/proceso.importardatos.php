<?//$db->debug=true;
// capturar el idcategoria
			if ($nomcategoria<>"") {
					$sqlx="select id ";
				 	$sqlx.=" from tblcategoria WHERE dsm='$nomcategoria' ";
					 $resultc = $db->Execute($sqlx);
					 if (!$resultc->EOF) {

							$idcategoria=$resultc->fields[0];		 	// no insertar
					 } else {
					 	// insertar
						$sqlx="insert into tblcategoria (dsm,idpos,idactivo,idnat,idtipo,dsalias,dsruta)";
						$sqlx.=" values ('$nomcategoria',0,1,1,1,'$nomcategoria','".limpieza(strtolower($nomcategoria))."') ";
						if ($db->Execute($sqlx))  {
										$sqlx="select id ";
									 	$sqlx.=" from tblcategoria WHERE dsm='$nomcategoria' ";
										 $resultcc = $db->Execute($sqlx);
										 if (!$resultcc->EOF) {
										$idcategoria=$resultcc->fields[0];		 	// no insertar

										 }
										$resultcc->close();
						}
					}
		 $resultc->close();
		}
			if ($nomsubcategoria<>"") {
					$sqlx="select id ";
				 	$sqlx.=" from tblsubcategoriasxcategoria WHERE dsm='$nomsubcategoria' ";
					 $resultc = $db->Execute($sqlx);
					 if (!$resultc->EOF) {
						$idsubcategoria=$resultc->fields[0];		 	// no insertar
					 } else {
					 	// insertar
					$sqlx="insert into tblsubcategoriasxcategoria (dsm,idpos,idactivo,idcategoria,dsalias,idtipo,dsruta)";
						$sqlx.=" values ('$nomsubcategoria',0,1,'$idcategoria','$nomsubcategoria',1,'".limpieza(strtolower($nomsubcategoria))."') ";
						if ($db->Execute($sqlx))  {

										$sqlx="select id ";
									 	$sqlx.=" from tblsubcategoriasxcategoria WHERE dsm='$nomsubcategoria' ";
										 $resultcc = $db->Execute($sqlx);
										 if (!$resultcc->EOF) {
										$idsubcategoria=$resultcc->fields[0];		 	// no insertar

										 }
										$resultcc->close();
						}
					}
		 $resultc->close();
	}
				if ($nombresubcate2<>"") {
					$sqlx="select id ";
				 	$sqlx.=" from tblsubcategoriasxsubcategoria WHERE dsm='$nombresubcate2' ";
					$resultc = $db->Execute($sqlx);
					if (!$resultc->EOF) {
					$idsubcate=$resultc->fields[0];		 	// no insertar
					} else {
					// insertar
					$sqlx="insert into tblsubcategoriasxsubcategoria (dsm,idpos,idactivo,idcategoria,dsalias,idtipo,dsruta)";
					$sqlx.=" values ('$nombresubcate2',0,1,'$idcategoria','$nombresubcate2',1,'".limpieza(strtolower($nombresubcate2))."')";
					if ($db->Execute($sqlx))  {
					$sqlx="select id ";
				 	$sqlx.=" from tblsubcategoriasxsubcategoria WHERE dsm='$nombresubcate2' ";
            	    $resultcc = $db->Execute($sqlx);
					if (!$resultcc->EOF) {
					$idsubcate=$resultcc->fields[0];		 	// no insertar
					}
					$resultcc->close();
					}
					}
		 			$resultc->close();
				}
		/*		
		$sqlxD="delete from tblrelacionproducto where idproducto='$id'";
		$db->Execute($sqlxD);
		$sqlx="insert into tblrelacionproducto (idproducto,idsubcategoria,idsubcategoria2,idcategoria,dsproducto,dssubcategoria,dssubcategoria2,dscategoria)";
		$sqlx.=" values($idx,'".$idsubcategoria."','".$idsubcate."','".$idcategoria."','".$dsm."','".$nomsubcategoria."','".$nombresubcate2."','".$nomcategoria."')";
		$db->Execute($sqlx);
		*/	


		$sqlxD="delete from tblcategoriaxsubcategoria where iddestino='".$idcategoria."'";
		$db->Execute($sqlxD);
		$sqlx="insert into tblcategoriaxsubcategoria (idorigen,iddestino) values(".$idsubcategoria.",".$idcategoria.")";
		$db->Execute($sqlx);


		$sqlxD="delete from tblrelacionsubcategoria where idorigen='".$idsubcate."'";
		$db->Execute($sqlxD);
		$sqlx="insert into tblrelacionsubcategoria (idorigen,iddestino) values(".$idsubcate.",".$idsubcategoria.")";
		$db->Execute($sqlx);
		
		$sqlxD="delete from tblsubcategoriaxtblproducto where idorigen='$idx'";
		$db->Execute($sqlxD);
		$sqlx="insert into tblsubcategoriaxtblproducto (idorigen,iddestino,dscategoria) values($idx,".$idsubcate.",'".$nombresubcate2."')";
		$db->Execute($sqlx);
		
		$sqlxD="delete from tbltblproductoxcategoria where iddestino='$idx'";
		$db->Execute($sqlxD);
		$sqlx="insert into tbltblproductoxcategoria (idorigen,iddestino,dscategoria) values(".$idcategoria.",$idx,'".$nomcategoria."')";
		$db->Execute($sqlx);
		//$db->debug=false;
?>