<?
include($rutxx."../../incluidos_modulos/modulos.papelera.php");
			$dsdescuento=$_REQUEST['dsdescuento'];
			$dsdescuentov=$_REQUEST['dsdescuentov'];
			$iddistribuidor=$_REQUEST['iddistribuidor'];			
			$idcant=$_REQUEST['idcant'];			
			$idactivo=$_REQUEST['idactivo'];			
			if ($idactivo==3) $idcant=1; // cuando es codigo general
			$dsfechag=date("Y/m/d H:i:s a");
			$dsfechai=$_REQUEST['dsfechai'];
			if ($dsfechai<>"") $idfechai=str_replace("/","",$dsfechai);			
			$dsfechaf=$_REQUEST['dsfechaf'];			
			if ($dsfechaf<>"") $idfechaf=str_replace("/","",$dsfechaf);
			
if ($idcant<>"" && $dsdescuento<>"" && $dsdescuentov<>"") {


			for ($i=0; $i<$idcant; $i++) {
			$codigo=generarCodigo(7); //
			// encriptar
			$dscodigo=sha1($codigo);

			$sql= "select id from $tabla where  ";
			$sql.=" codigo='$codigo' ";
			$result = $db->Execute($sql);
		 	if (!$result->EOF) {
			$mensajes=$men[0];
			$error=1;
				} else {

					$sql= " insert into $tabla (codigo,dscodigo,iddistribuidor,";
					$sql.="idactivo,dsfechag,dsdescuento,dsdescuentov,dsfechai,dsfechaf,idfechai,idfechaf) ";
					$sql.=" values ( ";
					$sql.=" '$codigo','$dscodigo',$iddistribuidor,$idactivo,'".$dsfechag."','$dsdescuento','$dsdescuentov','$dsfechai','$dsfechaf','$idfechai','$idfechaf' ";
					$sql.=" ) ";					
					if ($db->Execute($sql))  {
						$mensajes="<strong>".$men[1]."</strong>";
						$dstitulo="Insercion $titulomodulo";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro";
						include($rutxx."../../incluidos_modulos/logs.php");
						$error=0;
					} else {
						$mensajes=$men[2].".<br><br>$sql<br>Error:".mysql_error();
						$error=1;
					}

				}$result->Close();

				// fin generacion de los codigos	
			}//  fin for











}

// modificacion rapida
		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){

					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
					$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";
					//$sql.= ",dsruta='".$dsrutaPagina."'";
					$sql.= ",idpos=".$_REQUEST['idpos_'][$j]."";
					//$sql.= ",idtienda=".$_REQUEST['idtienda_'][$j]."";

					$sql.= " where id=".$_REQUEST['id_'][$j];
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for
		if ($h>0) $mensajes=$men[4];

?>