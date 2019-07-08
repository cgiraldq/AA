<?
/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2011Medellin - Colombia
=====================================================================
  Autores:  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- | 
Operaciones con el rutero dependiendo de la opcion
*/
include ("../sessiones.php");
include ("../../incluidos/creditos.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
// mensajes de recuperacion de claves
$opt=$_REQUEST['opt'];
$rr=$_REQUEST['rr'];
$tabla="tblvisitas";
if ($opt==1){ 
	$mensaje2=" Médicos";
}
if ($opt==2){ 
	$mensaje2=" Farmacias";
}
if ($opt==3){ 
	$mensaje2=" Otros canales";
}

$idciclo=$_REQUEST['idciclo'];
$diaciclo=$_REQUEST['diaciclo'];
$dsciclo=$_REQUEST['dsciclo'];
$totalciclo=$_REQUEST['totalciclo'];
$dataciclo=$_REQUEST['dataciclo'];
if ($_REQUEST['tipo']<>""){
	$tipo=$_REQUEST['tipo'];
	if ($opt==1 || $opt==2 || $opt==3){
		if ($tipo==1){ // copiar del dia seleccionado al mismo dia pero del ccilo seleccionado
			$idciclodestino=$_REQUEST['idciclodestino'];
			$sql="select a.id,a.dso,a.idmedico from $tabla a";
			$sql.=" where a.iddia=".$diaciclo;
			$sql.=" and a.idciclo=".$idciclo;
			$sql.=" and a.idusuario=".$_SESSION['i_idusuario'];
			$sql.=" and a.idcanal=".$opt;
			//echo $sql;
			//exit();
			$vermas=mysql_db_query($dbase,$sql,$db);
			if(mysql_affected_rows()>0){
				while($fila=mysql_fetch_object($vermas)){
				$sql2="select a.id from $tabla a";
				$sql2.=" where a.iddia=".$diaciclo;
				$sql2.=" and a.idciclo=".$idciclodestino;
				$sql2.=" and a.idmedico=".$fila->idmedico;
				$sql2.=" and a.idusuario=".$_SESSION['i_idusuario'];	
				$sql2.=" and a.idcanal=".$opt;							
				$vermas1=mysql_db_query($dbase,$sql2,$db);
				// verificar por cada uno 
				$resultado=@mysql_result($vermas1,"0","nombre");
					if ($resultado==""){
						$strSQL="insert into $tabla";
						$strSQL.="  (";
						$strSQL.="id,idmedico,idusuario,iddia,dshora";
						$strSQL.=",idciclo,idestado,dso,dsr,idcanal,dsfecha";
						$strSQL.=") values (";
						$strSQL.="'',".$fila->idmedico.",".$_SESSION['i_idusuario'].",".$diaciclo.",'',".$idciclodestino.",0";
						$strSQL.=",'".$fila->dso."','',$opt";
						$strSQL.=",''";
						$strSQL.=" )";
						//echo $strSQL."<br>";
						//exit();
						mysql_db_query($dbase,$strSQL,$db);
					} // fin si 
				} // fin while
				@mysql_free_result($vermas1);					
			} // fin si affected	
			@mysql_free_result($vermas);
		$Mensaje="Datos procesados. Copiando del día selecccionado a otro ciclo";	
		}else if($tipo==2) { // copiar el dia al otro dia del mismo ciclo
		$iddiadestino=$_REQUEST['iddiadestino'];
			$sql="select a.id,a.dso,a.idmedico from $tabla a";
			$sql.=" where a.iddia=".$diaciclo;
			$sql.=" and a.idciclo=".$idciclo;
			$sql.=" and a.idusuario=".$_SESSION['i_idusuario'];		
			$sql.=" and a.idcanal=".$opt;				
			//echo $sql;
			//exit();
			$vermas=mysql_db_query($dbase,$sql,$db);
			if(mysql_affected_rows()>0){
				while($fila=mysql_fetch_object($vermas)){
				$sql2="select a.id from $tabla a";
				$sql2.=" where a.iddia=".$iddiadestino;
				$sql2.=" and a.idciclo=".$idciclo;
				$sql2.=" and a.idmedico=".$fila->idmedico;
				$sql2.=" and a.idusuario=".$_SESSION['i_idusuario'];		
				$sql2.=" and a.idcanal=".$opt;						
				$vermas1=mysql_db_query($dbase,$sql2,$db);
				// verificar por cada uno 
				$resultado=@mysql_result($vermas1,"0","id");
					if ($resultado==""){
						$strSQL="insert into $tabla";
						$strSQL.="  (";
						$strSQL.="id,idmedico,idusuario,iddia,dshora";
						$strSQL.=",idciclo,idestado,dso,dsr,idcanal,dsfecha";
						$strSQL.=") values (";
						$strSQL.="'',".$fila->idmedico.",".$_SESSION['i_idusuario'].",".$iddiadestino.",'',".$idciclo.",0";
						$strSQL.=",'".$fila->dso."','',$opt";
						$strSQL.=",''";
						$strSQL.=" )";
						// echo $strSQL."<br>";
						mysql_db_query($dbase,$strSQL,$db);
					} // fin si 
				} // fin while
				@mysql_free_result($vermas1);									
			} // fin si affected	
			@mysql_free_result($vermas);
			$Mensaje="Datos procesados. Copiando del día selecccionado a otro día del mismo ciclo";	
		}else if($tipo==3){ // copiando todo el ciclo al otro ciclo
		$idciclodestino=$_REQUEST['idciclodestino'];
			$sql="select a.id,a.dso,a.idmedico,a.iddia from $tabla a";
			$sql.=" where ";
			$sql.=" a.idciclo=".$idciclo;
			$sql.=" and a.idusuario=".$_SESSION['i_idusuario'];			
			$sql.=" and a.idcanal=".$opt;			
			//echo $sql;
			$vermas=mysql_db_query($dbase,$sql,$db);
			if(mysql_affected_rows()>0){
				while($fila=mysql_fetch_object($vermas)){
				$sql2="select a.id from $tabla a";
				$sql2.=" where a.iddia=".$fila->iddia;
				$sql2.=" and a.idciclo=".$idciclodestino;
				$sql2.=" and a.idmedico=".$fila->idmedico;
				$sql2.=" and a.idusuario=".$_SESSION['i_idusuario'];		
				$sql2.=" and a.idcanal=".$opt;						
				$vermas1=mysql_db_query($dbase,$sql2,$db);
				// verificar por cada uno 
				$resultado=@mysql_result($vermas1,"0","id");
					if ($resultado==""){
						$strSQL="insert into $tabla";
						$strSQL.="  (";
						$strSQL.="id,idmedico,idusuario,iddia,dshora";
						$strSQL.=",idciclo,idestado,dso,dsr,idcanal,dsfecha";
						$strSQL.=") values (";
						$strSQL.="'',".$fila->idmedico.",".$_SESSION['i_idusuario'].",".$fila->iddia.",'',".$idciclodestino.",0";
						$strSQL.=",'".$fila->dso."','',$opt";
						$strSQL.=",''";
						$strSQL.=" )";
						// echo $strSQL."<br>";
						mysql_db_query($dbase,$strSQL,$db);
					} // fin si 
				} // fin while
				@mysql_free_result($vermas1);									
			} // fin si affected	
			@mysql_free_result($vermas);
			$Mensaje="Datos procesados. Copiando todo el ciclo seleccionado al ciclo destino";	
	}else if ($tipo==4){ // mover del dia seleccionado al mismo dia pero del ccilo seleccionado
			$idciclodestino=$_REQUEST['idciclodestino'];
			$sql="select a.id,a.dso,a.idmedico from $tabla a";
			$sql.=" where a.iddia=".$diaciclo;
			$sql.=" and a.idciclo=".$idciclo;
			$sql.=" and a.idusuario=".$_SESSION['i_idusuario'];		
			$sql.=" and a.idcanal=".$opt;				
			//echo $sql;
			$vermas=mysql_db_query($dbase,$sql,$db);
			if(mysql_affected_rows()>0){
				while($fila=mysql_fetch_object($vermas)){
				$sql2="select a.id from $tabla a";
				$sql2.=" where a.iddia=".$diaciclo;
				$sql2.=" and a.idciclo=".$idciclodestino;
				$sql2.=" and a.idmedico=".$fila->idmedico;
				$sql2.=" and a.idusuario=".$_SESSION['i_idusuario'];		
				$sql2.=" and a.idcanal=".$opt;						
				// echo $sql2;
				$vermas1=mysql_db_query($dbase,$sql2,$db);
				// verificar por cada uno 
				$resultado=@mysql_result($vermas1,"0","id");
					if ($resultado==""){ //actualizar
						$sqlm=" update $tabla set ";
						$sqlm.= "idciclo=".$idciclodestino;
						$sqlm.= " where id=".$fila->id;
//						 echo $sqlm."<br>";
//						 exit();
						mysql_db_query($dbase,$sqlm,$db);
					} // fin si 
				} // fin while
				@mysql_free_result($vermas1);									
			} // fin si affected	
			@mysql_free_result($vermas);
		$Mensaje="Datos procesados. Moviendo del día selecccionado a otro ciclo";	
	}else if($tipo==5) { // mover el dia al otro dia del mismo ciclo
	$iddiadestino=$_REQUEST['iddiadestino'];
		$sql="select a.id,a.dso,a.idmedico from $tabla a";
		$sql.=" where a.iddia=".$diaciclo;
		$sql.=" and a.idciclo=".$idciclo;
		$sql.=" and a.idusuario=".$_SESSION['i_idusuario'];		
		$sql.=" and a.idcanal=".$opt;		
		//echo $sql;
		$vermas=mysql_db_query($dbase,$sql,$db);
		if(mysql_affected_rows()>0){
			while($fila=mysql_fetch_object($vermas)){
			$sql2="select a.id from $tabla a";
			$sql2.=" where a.iddia=".$iddiadestino;
			$sql2.=" and a.idciclo=".$idciclo;
			$sql2.=" and a.idmedico=".$fila->idmedico;
			$sql2.=" and a.idusuario=".$_SESSION['i_idusuario'];			
			$sql2.=" and a.idcanal=".$opt;			
			$vermas1=mysql_db_query($dbase,$sql2,$db);
			// verificar por cada uno 
			$resultado=@mysql_result($vermas1,"0","id");
				if ($resultado==""){ // actualizar
				$sqlm=" update $tabla set ";
				$sqlm.= "iddia=".$iddiadestino;
				$sqlm.= " where id=".$fila->id;
				// echo $strSQL."<br>";
				mysql_db_query($dbase,$sqlm,$db);
				} // fin si 
			} // fin while
			@mysql_free_result($vermas1);								
		} // fin si affected	
		@mysql_free_result($vermas);
		$Mensaje="Datos procesados. Moviendo del día selecccionado a otro día del mismo ciclo";			
	}else if($tipo==6){ // moviendo todo el ciclo al otro ciclo
		$idciclodestino=$_REQUEST['idciclodestino'];
		$sql="select a.id,a.dso,a.idmedico,a.iddia from $tabla a";
		$sql.=" where ";
		$sql.=" a.idciclo=".$idciclo;
		$sql.=" and a.idusuario=".$_SESSION['i_idusuario'];		
		$sql.=" and a.idcanal=".$opt;		
		// echo $sql;
		$vermas=mysql_db_query($dbase,$sql,$db);
		if(mysql_affected_rows()>0){
			while($fila=mysql_fetch_object($vermas)){
			$sql2="select a.id from $tabla a";
			$sql2.=" where a.iddia=".$fila->iddia;
			$sql2.=" and a.idciclo=".$idciclodestino;
			$sql2.=" and a.idmedico=".$fila->idmedico;
			$sql2.=" and a.idusuario=".$_SESSION['i_idusuario'];	
			$sql2.=" and a.idcanal=".$opt;					
			$vermas1=mysql_db_query($dbase,$sql2,$db);
			// verificar por cada uno 
			$resultado=@mysql_result($vermas1,"0","id");
				if ($resultado==""){
					$sqlm=" update $tabla set ";
					$sqlm.= "idciclo=".$idciclodestino;
					$sqlm.= " where id=".$fila->id;
					// echo $sqlm."<br>";
					// exit();
					mysql_db_query($dbase,$sqlm,$db);
				} // fin si 
			} // fin while
		@mysql_free_result($vermas1);								
		} // fin si affected	
		@mysql_free_result($vermas);
		$Mensaje="Datos procesados. Moviendo todo el ciclo seleccionado al ciclo destino";			
	}		
		
	} //  fin opt
$val=1;	
}
// exit();
?>
<html>
<head>
	<title><? echo $AppNombre;?> Asociaciones en el rutero</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilos.css">
<meta http-equiv="REFRESH" content="2; URL=detallerutero.php?idciclo=<? echo $idciclo;?>&dsciclo=<? echo $dsciclo;?>&diaciclo=<? echo $diaciclo;?>&totalciclo=<? echo $totalciclo;?>&dataciclo=<? echo $dataciclo;?>&opt=<? echo $opt;?>&rr=<? echo $rr;?>">
<?
include ("../../incluidos/javageneral.php");
?>
</head>
<body color=#ffffff  topmargin=0 leftmargin=0>
<?
include ("../../incluidos/encabezado.php");
?>
<br>
<? include ("../../incluidos/resultoperaciones.php"); ?>	
<?
include ("../../incluidos/inferior.php");
include ("../../incluidos/cerrarconexion.php"); 
?>
</body>
</html>

