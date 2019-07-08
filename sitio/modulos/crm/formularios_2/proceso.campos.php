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
//echo "entra";
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$dsm' and idtipoformulario='$idx' ";
	 	//echo $sql;
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
		 } else {
		 	//*********inicio consulta posicion campo*********//
		 	$sqlx="select max(idpos) ";
		 	$sqlx.=" from $tabla WHERE idtipoformulario='$idx'";
			 $resultx = $db->Execute($sqlx);
			 $idposx=$resultx->fields[0];
			 $resultx->close();
			 //*********fin   consulta posicion campo*********//
			// insertar
			$idposxx=$idposx+1;
			$dscampo="dscampo".$idposxx;

			$sql="insert into $tabla (dsm,idactivo,idtipo,idoblig,idtipoformulario,idpos,dscampo,idposn,dsdes,dsmensaje,idpublicar,idref,idbuscador,idcodigo)";
			$sql.=" values ('$dsm','$idactivo','$idtipo','$idoblig','$idx','$idposxx','$dscampo','$idposn','$dsdes','$dsmensaje',2,2,'$idbuscador','$idcodigo') ";

			$dstitulo="Insercion $titulomodulo";
			$dsdesc=" El usuario ".$i_dsnombre." Ingreso $dsm en $titulomodulo";
			$mensajes=$funciones->ejecucionesSQL($sql,$dstitulo,$dsdesc,$dsruta,$titulomodulo,2);
			//echo $sql;
	 	//exit();
		 }
		 $result->close();
		  $idcampo=mysql_insert_id();


}


if($idtipo==6){ //inici insert de paises
	$idcampo=mysql_insert_id();
	$sql="select iso1_code,name_caps,num_code,idactivo ";
	 	$sql.=" from framecf_tblmaestropaises WHERE 1 ";
	 	 $result = $db->Execute($sql);
	 	  if (!$result->EOF) {
	 	  	 while (!$result->EOF) {
			  $dsvalor=$result->fields[0];
			  $dsm=$result->fields[1];
			    $id=$result->fields[2];
			     $idactivo=$result->fields[3];
				     $sqlx="insert into framecf_tbltiposformulariosxcampos (dsm,idactivo,idcampo,dsvalor,idtipoformulario)";
					 $sqlx.=" values ($dsm','$idactivo','$idcampo','$dsvalor','$idx'); ";


					 $db->Execute($sqlx);

			 $result->MoveNext();
	 	 }

	 	}
	 	$result->close();
	 	echo $sqlx;
			exit();
} #fin insert de paises

if($idtipo==8){ // inicio insert departamentos
	$idcampo=mysql_insert_id();
	$sql="select dsciudad,idactivo";
	 	$sql.=" from framecf_tblmaestrociudades WHERE 1 ";
	 	 $result = $db->Execute($sql);
	 	  if (!$result->EOF) {
	 	  	while (!$result->EOF) {
			 $dsm=$result->fields[0];
			 $idactivo=$result->fields[1];

		     $sqlx="insert into framecf_tbltiposformulariosxcampos (dsm,idactivo,idcampo,idtipoformulario)";
			 $sqlx.=" values ('$dsm','$idactivo','$idcampo','$idx'); ";
			 $resultx=$db->Execute($sqlx);
			 //echo $sqlx;
			 $result->MoveNext();
	 	 }
			//exit();
	 	}
	 	$result->close();
} // fin insert departaentos

if($idtipo==7){ // inicio insert ciudades
	$idcampo=mysql_insert_id();
	$sql="select dsdep,idactivo";
	 	$sql.=" from framecf_tblmaestrociudades WHERE 1 group by dsdep";
	 	 $result = $db->Execute($sql);
	 	  if (!$result->EOF) {
	 	  	while (!$result->EOF) {
			 $dsm=$result->fields[0];
			 $idactivo=$result->fields[1];

		     $sqlx="insert into framecf_tbltiposformulariosxcampos (dsm,idactivo,idcampo,idtipoformulario)";
			 $sqlx.=" values ('$dsm','$idactivo','$idcampo','$idx'); ";
			 $resultx=$db->Execute($sqlx);
			 //echo $sqlx;
			 $result->MoveNext();
	 	 }
			//exit();
	 	}
	 	$result->close();
} // fin insert ciudades


// modificacion rapida
				$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){


	 	$sqlduplicados.=" select id from $tabla WHERE dsm='".$_REQUEST['dsm_'][$j]."' and idtipoformulario='$idx'; ";

	 	//echo $sqlduplicados;
	 	//echo "<br>";
	 	 $resultduplicados=$db->Execute($sqlduplicados);
	 	  if (!$resultduplicados->EOF) {
	 	  		 $idduplicados=$resultduplicados->fields[0];
	 	  }
	 	  //$resultduplicados->Close();




					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
//if ($idduplicados=="")
					$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";
					$sql.= ",idcodigo='".$_REQUEST['idcodigo_'][$j]."'";
					$sql.= ",dsmensaje='".$_REQUEST['dsmensaje_'][$j]."'";
					$sql.= ",dsdes='".$_REQUEST['dsdes_'][$j]."'";
					$sql.= ",idposn='".$_REQUEST['idposn_'][$j]."'";
					$sql.= ",idoblig='".$_REQUEST['idoblig_'][$j]."'";

					$sql.= ",idref='".$_REQUEST['idref_'][$j]."'";
					$sql.= ",idselect='".$_REQUEST['idselect_'][$j]."'";
					$sql.= ",idpublicar='".$_REQUEST['idpublicar_'][$j]."'";
					$sql.= ",idpublicardetalle='".$_REQUEST['idpublicardetalle_'][$j]."'";
					$sql.= ",idtipo=".$_REQUEST['idtipo_'][$j]."";
					$sql.= ",idbuscador=".$_REQUEST['idbuscador_'][$j]."";

					$sql.=" where id=".$_REQUEST['id_'][$j].";";
					//echo $sql;
					$db->Execute($sql);
					if ($_REQUEST['idtipo_'][$j]<>$_REQUEST['idtipoactual_'][$j] && $_REQUEST['idtipo_'][$j]<>"") {
					// eliminar los datos basado en actulizacion
					$idtipo=$_REQUEST['idtipo_'][$j];
					$idtipoactual=$_REQUEST['idtipoactual_'][$j];
					$idcampo=$_REQUEST['id_'][$j];

						if($idtipoactual==6 || $idtipoactual==7 || $idtipoactual==8){
							$sqlz="delete from framecf_tbltiposformulariosxcampos where idcampo=".$_REQUEST['id_'][$j];
							 //echo $sqlz;
							$resultz=$db->Execute($sqlz);
						}


						if($idtipo==6){ // inicio insert paises
						$sqly="select iso1_code,name_caps,num_code,idactivo ";
						 	$sqly.=" from framecf_tblmaestropaises WHERE 1 ";
						 	//echo $sqly;
						 	//echo "<br>";
						 	 $result = $db->Execute($sqly);

						 	  if (!$result->EOF) {
						 	  	 while (!$result->EOF) {
								  $dsvalor=$result->fields[0];
								  $dsm=$result->fields[1];
								   $id=$result->fields[2];
								   $idactivo=$result->fields[3];

							     $sqlx="insert into framecf_tbltiposformulariosxcampos (dsm,idactivo,idcampo,dsvalor,idtipoformulario)";
								 $sqlx.=" values ('$dsm','$idactivo','$idcampo','$dsvalor','$idx'); ";
							    // echo $sqlx;
								 $resultx=$db->Execute($sqlx);

							 $result->MoveNext();
					 	 }

					 	}
					 	$result->close();
						} // fin insert paises

						if($idtipo==8){ // inicio insert departamentos

							$sqlx="select dsciudad,idactivo";
							 	$sqlx.=" from framecf_tblmaestrociudades WHERE 1 ";
							 	 $result = $db->Execute($sqlx);
							 	  if (!$result->EOF) {
							 	  	while (!$result->EOF) {
									 $dsm=$result->fields[0];
									 $idactivo=$result->fields[1];

								     $sqlx="insert into framecf_tbltiposformulariosxcampos (dsm,idactivo,idcampo,idtipoformulario)";
									 $sqlx.=" values ('$dsm','$idactivo','$idcampo','$idx'); ";
									 $resultx=$db->Execute($sqlx);
									// echo $sqlx;
						            // exit();
									 $result->MoveNext();
							 	 }

							 	}
							 	$result->close();
						} // fin insert departaentos

						if($idtipo==7){ // inicio insert ciudades

						$sqlx="select dsdep,idactivo";
						 	$sqlx.=" from framecf_tblmaestrociudades WHERE 1 group by dsdep";
						 	 $result = $db->Execute($sqlx	);
						 	  if (!$result->EOF) {
						 	  	while (!$result->EOF) {
								 $dsm=$result->fields[0];
								 $idactivo=$result->fields[1];

							     $sqlx="insert into framecf_tbltiposformulariosxcampos (dsm,idactivo,idcampo,idtipoformulario)";
								 $sqlx.=" values ('$dsm','$idactivo','$idcampo','$idx'); ";
								 $resultx=$db->Execute($sqlx);
								 //echo $sqlx;
								 $result->MoveNext();
						 	 }
							//exit();
						 	}
						 	$result->close();
					} // fin insert ciudades


					}
//

					$sql.= ",idposn=".$_REQUEST['idposn_'][$j]."";
					$sql.= ",idoblig=".$_REQUEST['idoblig_'][$j]."";
					$sql.= ",idminimo=".$_REQUEST['idminimo_'][$j]."";
					$sql.= " where id=".$_REQUEST['id_'][$j].";";

					if ($db->Execute($sql)) $h++;
					//echo $sql;
				} // fin si
			} // fin for
		if ($h>0) $mensajes=$men[4];

		$sql="delete from $tabla where id=".$_REQUEST['idy'];

		$db->Execute($sql);

		$mensajes=$men[4];

		?>