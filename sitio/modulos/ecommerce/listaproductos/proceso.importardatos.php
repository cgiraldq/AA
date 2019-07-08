<?
// capturar el idcategoria
			if ($nomcategoria<>"") {
					$sqlx="select id ";
				 	$sqlx.=" from ecommerce_tblcategoria WHERE dsm='$nomcategoria' ";
					 $resultc = $db->Execute($sqlx);
					 if (!$resultc->EOF) {

							$idcategoria=$resultc->fields[0];		 	// no insertar
					 } else {
					 	// insertar
						$sqlx="insert into ecommerce_tblcategoria (dsm,idpos,idactivo,idnat,idtipo)";
						$sqlx.=" values ('$nomcategoria',0,1,1,1) ";
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
				 	$sqlx.=" from ecommerce_tblsubcategoriasxcategoria WHERE dsm='$nomsubcategoria' ";
					 $resultc = $db->Execute($sqlx);
					 if (!$resultc->EOF) {
						$idsubcategoria=$resultc->fields[0];		 	// no insertar
					 } else {
					 	// insertar
					$sqlx="insert into ecommerce_tblsubcategoriasxcategoria (dsm,idpos,idactivo,idcategoria)";
						$sqlx.=" values ('$nomsubcategoria',0,1,$idcategoria) ";
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
		$sqlxD="delete from ecommerce_tblsubcategoriaxtblproducto where idorigen=$id";
		$db->Execute($sqlxD);
		$sqlx="insert into ecommerce_tblsubcategoriaxtblproducto (idorigen,iddestino) values($idx,".$idsubcategoria.")";
		$db->Execute($sqlx);

?>