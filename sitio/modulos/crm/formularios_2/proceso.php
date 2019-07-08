<?
/*
| ----------------------------------------------------------------- |
FrameWork Cf Para CMS CRM ECOMMERCE
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Area Investigacion y Desarrollo
  Area Diseno y Maquetacion
  Area Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// principal


if ($dsm<>"") {
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$dsm' ";

		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
		 } else {
		 	// insertar

			$sql="insert into $tabla (dsm,idactivo,idpos,iddes,iddesplegable,idestilo,idformclientes,idgaleria)";
			$sql.=" values ('$dsm','1','$idpos','$idtipo',$iddesplegable,$idestilo,2,'$idgaleria') ";
			//echo $sql;
			//exit();

			$dstitulo="Insercion $titulomodulo";
			$dsdesc=" El usuario ".$i_dsnombre." Ingreso $dsm en $titulomodulo";
			$mensajes=$funciones->ejecucionesSQL($sql,$dstitulo,$dsdesc,$dsruta,$titulomodulo,2);
			//echo $sql;
		 }
		 $result->close();
}


// modificacion rapida
		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
					$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";
					//$sql.= ",idpos=".$_REQUEST['idpos_'][$j]."";
					$sql.= ",idactivo='".$_REQUEST['idactivo_'][$j]."'";
					$sql.= ",idpublicar=".$_REQUEST['idpublicar_'][$j]."";
					$sql.= ",iddesplegable=".$_REQUEST['iddesplegable_'][$j]."";
					$sql.= ",idestilo=".$_REQUEST['idestilo_'][$j]."";
					$sql.= ",idformclientes=".$_REQUEST['idformclientes_'][$j]."";
					$sql.= ",idgaleria=".$_REQUEST['idgaleria_'][$j]."";

					$sql.= " where id=".$_REQUEST['id_'][$j];
					//echo $sql;
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for
		if ($h>0) $mensajes=$men[4];

// eliminar registro seleccionado
		if ($_REQUEST['idx']<>"") {
		$sql="update $tabla set idactivo=9 where id='".$_REQUEST['idx']."' ";
		$db->Execute($sql);


}
	if ($h>0) $mensajes=$men[4];
		?>