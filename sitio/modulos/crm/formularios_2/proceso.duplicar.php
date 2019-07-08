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


$dstiempo=date("Y/m/d H:i:s");

if ($_REQUEST["idduplicar"]<>"") {
		$idduplicar=$_REQUEST["idduplicar"];
	// consulta sobre los datos que se van a duplicar
		$sql="select id,dsm,idactivo,idpos,dstabla,dsasunto,dsasuntoar,dsenc,dsremate,dscorreo1,dscorreo2,dscorreo3,idtipo,iddes,idgaleria,idestilo ";
	 	$sql.=" from $tabla WHERE id=$idduplicar ";
	 	//echo $sql."<br>";
		 $result=$db->Execute($sql);
		 if (!$result->EOF) {

		  $dsm=$result->fields[1];
		  $dsm="copia-".$dsm;
		   $idactivo=$result->fields[2];
		    $idpos=$result->fields[3];
		     $dstabla=$result->fields[4];
		      $dsasunto=$result->fields[5];
		       $dsasuntoar=$result->fields[6];
		       	$dsenc=$result->fields[7];
		       	 $dsremate=$result->fields[8];
		       	  $dscorreo1=$result->fields[9];
		       	   $dscorreo2=$result->fields[10];
		       	    $dscorreo3=$result->fields[11];
		       	     $idtipo=$result->fields[12];
		       	      $iddes=$result->fields[13];
			       	    $idgaleria=$result->fields[14];
			       	      $idestilo=$result->fields[15];



// se insertan los campos duplicados pero se cambia el nombre
			$sqly="insert into $tabla (dsm,idactivo,idpos,dstabla,dsasunto,dsasuntoar,dsenc,dsremate,dscorreo1,dscorreo2,dscorreo3,idtipo,iddes,dstiempo,idpublicar,idgaleria,idestilo)";
			$sqly.=" values ('$dsm','$idactivo','$idpos','$dstabla','$dsasunto','$dsasuntoar','$dsenc','$dsremate','$dscorreo1','$dscorreo2','$dscorreo3','$idtipo','$iddes','$dstiempo',2,'$idgaleria','$idestilo' ) ";

			$resulty=$db->Execute($sqly);
			$resulty->close();
			 $id=mysql_insert_id();

		 }
		 $result->close();

//se selecionan los campos a duplicar
		$sqlx="select idtipoformulario,dsm,dscampo,dsmensaje,idactivo,idtipo,idoblig,idpos,idposn,idminimo,dsdes,id,idpublicar";
	 	$sqlx.=" from framecf_tbltiposformulariosxcampo WHERE idtipoformulario=$idduplicar";
	 	//echo $sqlx."<br>";
	 	 $resultx=$db->Execute($sqlx);
	 	 if (!$resultx->EOF) {
	 	 	while(!$resultx->EOF){
	 	 	$idtipoformulario=$resultx->fields[0];
	 	 	  $dsm=$resultx->fields[1];
	 	 	   $dscampo=$resultx->fields[2];
	 	 	    $dsmensaje=$resultx->fields[3];
	 	 	     $idactivo=$resultx->fields[4];
	 	 	      $idtipo=$resultx->fields[5];
	 	 	       $idoblig=$resultx->fields[6];
	 	 	        $idpos=$resultx->fields[7];
	 	 	         $idposn=$resultx->fields[8];
	 	 	          $idminimo=$resultx->fields[9];
	 	 	           $dsdes=$resultx->fields[10];
	 	 	             $idcampocopia=$resultx->fields[11];
	 	 	             	$idpublicar=$resultx->fields[12];


	 	 		$sql="insert into framecf_tbltiposformulariosxcampo (idtipoformulario,dsm,dscampo,dsmensaje,idactivo,idtipo,idoblig,idpos,idposn,idminimo,dsdes,dstiempo,idpublicar)";
	 	 		$sql.=" values ($id,'$dsm','$dscampo','$dsmensaje','$idactivo','$idtipo','$idoblig','$idpos','$idposn','$idminimo','$dsdes','$dstiempo','$idpublicar'); ";
	 	 		$result=$db->Execute($sql);
	 	 		$idx=mysql_insert_id();
	 	 		 //echo $sql."<br>";
	 	 		 $sqlz="select dsm,idactivo,idpos,idcampo,dsvalor,idtipoformulario";
			 	$sqlz.=" from framecf_tbltiposformulariosxcampos WHERE idcampo=$idcampocopia;";
			 	//echo $sqlz."<br>";
			 	 $resultz=$db->Execute($sqlz);
			 	 if (!$resultz->EOF) {

	 	 	while(!$resultz->EOF){
	 	 	$dsm=$resultz->fields[0];
	 	 	  $idactivo=$resultz->fields[1];
	 	 	   $idpos=$resultz->fields[2];
	 	 	   $idcampo=$resultz->fields[3];
	 	 	     $dsvalor=$resultz->fields[4];
	 	 	      $idtipoformulario =$resultz->fields[5];



	 	 		$sql="insert into framecf_tbltiposformulariosxcampos (dsm,idactivo,idpos,idcampo,dsvalor,idtipoformulario)";
	 	 		$sql.=" values ('$dsm','$idactivo','$idpos','$idx','$dsvalor','$id'); ";
	 	 		 $result=$db->Execute($sql);
	 	 		// echo $sql;


	 	 		 $resultz->MoveNext();

	 	 	}


	 	 }
	 	 $resultz->close();

	 	 		$resultx->MoveNext();



	 	 	}


	 	 }
	 	 $resultx->close();

//exit();

	 /*	 //se selecionan los campos del seleccionado a duplicar
	 	 $sqlz="select dsm,idactivo,idpos,idcampo,dsvalor,idtipoformulario";
	 	$sqlz.=" from framecf_tbltiposformulariosxcampos WHERE idtipoformulario=$idduplicar";
	 	echo $sqlz."<br>";
	 	 $resultz=$db->Execute($sqlz);
	 	 if (!$resultz->EOF) {

	 	 	while(!$resultz->EOF){
	 	 	$dsm=$resultz->fields[0];
	 	 	  $idactivo=$resultz->fields[1];
	 	 	   $idpos=$resultz->fields[2];
	 	 	   $idcampo=$resultz->fields[3];
	 	 	     $dsvalor=$resultz->fields[4];
	 	 	      $idtipoformulario =$resultz->fields[5];



	 	 		$sql="insert into framecf_tbltiposformulariosxcampos (dsm,idactivo,idpos,idcampo,dsvalor,idtipoformulario)";
	 	 		$sql.=" values ('$dsm','$idactivo','$idpos','$idcampo','$dsvalor','$id'); ";
	 	 		 $result=$db->Execute($sql);
	 	 		 echo $sql;


	 	 		 $resultz->MoveNext();

	 	 	}


	 	 }
	 	 $resultz->close(); */

//exit();
}


$mensajes=$men[4];


?>