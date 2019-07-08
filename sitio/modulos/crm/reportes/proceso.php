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

$dsm=$_REQUEST['dsm'];
if ($dsm<>"") {
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$dsm' ";
	 	//echo $sql;
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
		 } else {
		 	// insertar

			$sql="insert into $tabla (dsm,idactivo,idpos,dstabla,idfecha,idusuario,dsruta)";
			$sql.=" values ('$dsm','$idactivo','$idpos','".strtolower(limpiezatablas(utf8_decode($dstabla)))."',$idfecha,$idusuario,'$dsruta') ";
			//echo $sql;
			//exit();
			$dstitulo="Insercion $titulomodulo";
			$dsdesc=" El usuario ".$i_dsnombre." Ingreso $dsm en $titulomodulo";
			$mensajes=$funciones->ejecucionesSQL($sql,$dstitulo,$dsdesc,$dsruta,$titulomodulo,2);
		 }
		 $result->close();
}

//$db->debug=true;
// modificacion rapida
		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
					$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";
					$sql.= ",dstabla='".$_REQUEST['dstabla_'][$j]."'";
					$sql.= ",dsruta='".$_REQUEST['dsruta_'][$j]."'";

					$sql.= ",idusuario='".$_REQUEST['idusuario_'][$j]."'";
					$sql.= ",idfecha='".$_REQUEST['idfecha_'][$j]."'";

					$sql.= " where id=".$_REQUEST['id_'][$j];
					//echo $sql;
					if ($db->Execute($sql)){
						 $h++;
					}
				}
			} // fin for
		if ($h>0) $mensajes=$men[4];

// eliminar registro seleccionado
		if ($_REQUEST['idxe']<>"") {
		$sql="update $tabla set idactivo=9 where id='".$_REQUEST['idxe']."' ";
		$db->Execute($sql);


}
	if ($h>0) $mensajes=$men[4];
		?>