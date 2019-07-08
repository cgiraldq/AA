<?
/*
| ----------------------------------------------------------------- |
MEGAPINTURAS LTDA
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>

=====================================================================
| ----------------------------------------------------------------- | 
Tabla generica de carga de datos del cliente cuando es nuevo y no son todos los datos
*/
		$dsnitnuevo=$_REQUEST['dsnitnuevo'];// 
		$dsnombrenuevo=$_REQUEST['dsnombrenuevo'];// 
		$dstelnuevo=$_REQUEST['dstelnuevo'];// 
		$dsdirnuevo=$_REQUEST['dsdirnuevo'];// 
		$dsretnuevo=$_REQUEST['dsretnuevo'];// 
		$dsretivanuevo=$_REQUEST['dsretivanuevo'];// 
		$dsdescuentonuevo=$_REQUEST['dsdescuentonuevo'];// 
		if ($idactivo=="") $idactivo=1; // tercero
		
		
		$strSQL=" select id,dsnombre from ".$tablabase." where dsnit='$dsnitnuevo' ";
		$strSQL.=" and dsnombre='$dsnombrenuevo' and idempresa=".$_SESSION['i_idempresa'];
		//echo $strSQL;

         $resultx = $db->Execute($strSQL);
         if (!$resultx->EOF) {
          $idcliente=$resultx->fields[0];
    	} else {
			$strSQL="insert into ".$tablabase;
			$strSQL.="  (";
			$strSQL.=" id,idempresa,dsreg,dscodf,idciclo,idciudad,dsnit";
			$strSQL.=" ,dsnombre,dscomercial,dslogin,dsclave";
			$strSQL.=" ,dstel,dsdir";
			$strSQL.=" ,dsbarrio,dscel,dsfax,dswb";
			$strSQL.=" ,dscorreo,dscorreo2,dscorreo3,dscorreo4,dscorreo5,dscorreo6";
			$strSQL.=",dscom,dshoravisita";
			$strSQL.=" ,idtipocliente,idorigencliente,dscontacto1,dscontacto2";
			$strSQL.=" ,dscontacto3,dscontacto4,dscontacto5,dscontacto6";
			$strSQL.=" ,dsfcontacto1,dsfcontacto2,dsfcontacto3,dsfcontacto4,dsfcontacto5";
			$strSQL.=" ,dsfcontacto6";
			$strSQL.=" ,idplazo,dsaniver";
			$strSQL.=" ,idactivo,idusuario,idusuariootro";
			$strSQL.=" ,dsfechaingreso,dsfechaingresonum";			
			$strSQL.=" ,dsret,dsretiva";			
			$strSQL.=" ,dsdescuento";			
			$strSQL.=" )";
			$strSQL.="  values (";
			$strSQL.="'',".$_SESSION['i_idempresa'];
			$strSQL.=",'$dsreg','$dscodf',0,0,'$dsnitnuevo',";
			$strSQL.="'$dsnombrenuevo','','','',";
			$strSQL.="'$dstelnuevo','$dsdirnuevo',";
			$strSQL.="'','','','',";
			$strSQL.="'','','','','',''";
			$strSQL.=",'','',";			
			$strSQL.="0,0,'','',";			
			$strSQL.="'','','','',";
			$strSQL.="'','','',";
			$strSQL.="'','','',";
			$strSQL.="'','',";
			$strSQL.="$idactivo,'0','0',";
			$strSQL.="'$fechaBase','$fechaBaseNum'";
			$strSQL.=" ,'$dsretnuevo','$dsretivanuevo'";						
			$strSQL.=" ,'$dsdescuentonuevo'";						
			$strSQL.=" )";
//			echo $strSQL;
//			exit();
			if ($db->Execute($strSQL)) { 
				$strSQL=" select id,dsnombre from ".$tablabase;
				$strSQL.=" where dsnit='$dsnitnuevo' ";
				$strSQL.=" and dsnombre='$dsnombrenuevo'";
				$strSQL.=" and idempresa=".$_SESSION['i_idempresa'];
				$vermasx=$db->Execute($strSQL);
				if (!$vermasx->EOF) {
					$idcliente=$vermasx->fields[0];
					} else { // fin si ingreso con éxito			
				}
				$vermasx->Close();	
		}
		
		}
		$resultx->Close();
		// limpiar campos
		$dsnitnuevo="";// 
		$dsnombrenuevo="";// 
		$dstelnuevo="";// 
		$dsdirnuevo="";// 
		$dsretnuevo="";// 
		$dsretivanuevo="";// 
		$dsdescuentonuevo="";// 
		// fin limpiar campos
		
		
?>

