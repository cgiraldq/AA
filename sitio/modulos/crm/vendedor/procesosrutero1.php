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
Reporte de visitas - dependiendo del tipo de pintan los datos
*/
include ("../sessiones.php");
include ("../../incluidos/creditos.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
$formabase="";
include ("../../incluidos/func.calendario_2.php"); // funcion nueva del calendario

// mensajes de recuperacion de claves
$idclientex=$_REQUEST['idcliente'];
$idusuario=$_REQUEST['idusuario'];
$opt=$_REQUEST['opt'];
$rr=$_REQUEST['rr'];
/*$dshorai=$_REQUEST['hi'];
$dsmini=$_REQUEST['mi'];*/
$dsfechax1=$_REQUEST['dsfechax1'];

$agenda=$_REQUEST['agenda'];

if ($idusuario=="") $idusuario=$_SESSION['i_idusuario'];

$tabla="tblvisitas";
if ($opt==1){ 
	$mensaje2=" Cliente(s)";
	$mensaje3=" Cliente";
	$tipov=1;
}elseif ($opt==2){ 
	$mensaje2="";
	$mensaje3="";
	$tipov=2;
}elseif ($opt==3){ 
	$mensaje2="";	
	$mensaje3="";	
	$tipov=3;
}


$idciclo=$_REQUEST['idciclo'];
$diaciclo=$_REQUEST['diaciclo'];
$dsciclo=$_REQUEST['dsciclo'];
$totalciclo=$_REQUEST['totalciclo'];
$dataciclo=$_REQUEST['dataciclo'];
$idsact=$_REQUEST['idsact'];
$idr=$_REQUEST['idr']; // resultado
$iddetalle=$_REQUEST['iddetalle'];

if ($idsact=="") $idsact=0;
if ($idr=="") $idr=0;
$dsobs=$_REQUEST['dsobs']; // observaciones
if ($dsobs==""){ $dsobs="na";}
$idacomp=$_SESSION['i_idusuario']; // asesor encargado

$idra=$_REQUEST['idra']; // 
if ($idra=="") $idra=0;



// traer la fecha asociada al dia del ciclo
if ($dsfechax1=="") { 
$sql="select iddiacal,idmescal,idaniocal,iddiaciclo,idciclo  from tblciclodiaxcal  where iddiaciclo=$diaciclo ";
$sql.=" and idciclo=".$idciclo;
} else { 
	$partir=explode("/",$dsfechax1);
	$aniox=intval($partir[0]);
	$mesx=intval($partir[1]);
	$diax=intval($partir[2]);
	//echo $mesx;
	//exit();
	$sql="select iddiacal,idmescal,idaniocal,idciclo,iddiaciclo  ";
	$sql.="from tblciclodiaxcal  where ";
	$sql.=" idaniocal=$aniox and iddiacal=$diax and idmescal=$mesx";
}
// si se cambia la fecha, se cambia el dida
//echo $sql;
 //exit();
$vermas=mysql_db_query($dbase,$sql,$db);
	if (mysql_num_rows($vermas)>0){
		$dia=mysql_result($vermas,"0","iddiacal");
		$mes=mysql_result($vermas,"0","idmescal");
		$anio=mysql_result($vermas,"0","idaniocal");
		$diaciclo=mysql_result($vermas,"0","iddiaciclo");
		$idciclo=mysql_result($vermas,"0","idciclo");
		if ($dia<10) $dia="0".$dia;
		if ($mes<10) $mes="0".$mes;
		$dsfechaix=$anio."/".$mes."/".$dia;
	} else {
		$mensajea="Configure los ciclos de visitas para entrar al agendamiento de actividades ";
		$mensajea.="o el dia en el que esta agenda no es valido. Cambie de dia e intente de nuevo<br>";
		$mensajea.="<a href='' onclick='window.close()'>Cerrar esta ventana</a><br>";
		
		die ($mensajea);
		exit();
	}
mysql_free_result($vermas);	
if($_REQUEST['enviar']=="Ingresar" || $_REQUEST['enviar1']=="Modificar"){
	
	$dsnit=$_REQUEST['dsnit'];
	$idclientex=$_REQUEST['idcliente'];//tercero asociado a la gestion
	$dsnombre=$_REQUEST['dsnombre'];
	$dstelefono=$_REQUEST['dstelefono'];
	if($idclientex==""){
		$sql="select id from tblclientes where dsnit='$dsnit' and dsnombre1='$dsnombre'";
		$ver=mysql_db_query($dbase,$sql,$db);
		if(mysql_num_rows($ver)>0){
			$fila=mysql_fetch_object($ver);
			$idclientex="0|".$fila->id;
		}else{
			$sql="insert into tblclientes (dsnit,dsnombre1,dstel,idtipo)";
			$sql.="values('$dsnit','$dsnombre','$dstelefono',3)";
			//exit();
			mysql_db_query($dbase,$sql,$db);
			$sql="select id from tblclientes where dsnit='$dsnit' and dsnombre1='$dsnombre'";
			$ver=mysql_db_query($dbase,$sql,$db);
			if(mysql_num_rows($ver)>0){
				$fila=mysql_fetch_object($ver);
				$idclientex="0|".$fila->id;
			}
		}
	}
	//echo $idclientex;
	$idc=explode('|',$idclientex);
	$idcliente=$idc[1];
	//exit();
	$idsucursal=$idc[0];
	if($idsucursal=="")$idsucursal=0;
	if($idcliente<>""){
		$dsdepartamentocont=$_REQUEST['dsdepartamentocont'];
		$dsnombrecont=$_REQUEST['dsnombrecont'];
		$dsextcont=$_REQUEST['dsextcont'];
		$dscorreocont=$_REQUEST['dscorreocont'];
		$dscelularcont=$_REQUEST['dscelularcont'];
		if($dsnombrecont<>"" && $_REQUEST['dscontacto']==""){
			$sqlcon=" insert into tblclientescontacto (idcliente,dsdepartamento,dscontacto,dsext,dscorreo,dscelular)";
			$sqlcon.="values($idcliente,'$dsdepartamentocont','$dsnombrecont','$dsextcont','$dscorreocont','$dscelularcont')";
			if(mysql_db_query($dbase,$sqlcon,$db)){
				$sqlcon="select id from tblclientescontacto where dscorreo='$dscorreocont' and dscontacto='$dsnombrecont'";
				$ver=mysql_db_query($dbase,$sqlcon,$db);
				if(mysql_num_rows($ver)>0){
					$fila=mysql_fetch_object($ver);
					$idcontacto=$fila->id;
				}
			}
		}

	}
	
}
if ($_REQUEST['enviar']=="Ingresar"){		
		$idgestion=$_REQUEST['idgestion'];//forma como se obtuvo la gestion
		$idrecepcion=$_REQUEST['idrecepcion'];//medio por el cual se realizo o se recibio la gestion
	
	if ($opt==1 || $opt==2 || $opt==3 ){ // cualquiera
		$dsfechai=$_REQUEST['dsfechai']; // fecha gestion
		if ($dsfechai=="") $dsfechai=$_REQUEST['dsfechar'];//fecha de la gestion
		$partir=explode("/",$dsfechai);
		$idfecha=$partir[0].$partir[1].$partir[2];
		
		if ($dsfechar=="") $dsfechar=$_REQUEST['dsfechar'];//fecha de recepcion
		$partir=explode("/",$dsfechar);
		$idfechar=$partir[0].$partir[1].$partir[2];
		
		// combo de hora programada
		$dshorai=$_REQUEST['dshorai'];  
		$dsmini=$_REQUEST['dsmini'];
	
		/*if ($dshorai=="" && $dsmini=="") { 
			$dshorai=$_REQUEST['dshoraai'];  
			$dsmini=$_REQUEST['dsminaai'];
		}*/
		$dshorai1=$dshorai.":".$dsmini;
		$idhorai1=intval($dshorai.$dsmini);
		//
		
		$dshoraf=$_REQUEST['dshoraf'];  
		$dsminf=$_REQUEST['dsminf'];
		
		/*if ($dshoraf=="" && $dsminf=="") { 
			$dshoraf=$_REQUEST['dshoraaf'];  
			$dsminf=$_REQUEST['dsminaaf'];
		}*/
		
		$dshoraf1=$dshoraf.":".$dsminf;
		$idhoraf1=intval($dshoraf.$dsminf);

		/*// combo de hora actividad
		$dshoraai=$_REQUEST['dshoraai'];  
		$dsminaai=$_REQUEST['dsminaai'];
		$dshoraai1=$dshoraai.":".$dsminaai;
		// hora final
		$dshoraaf=$_REQUEST['dshoraaf'];  
		$dsminaaf=$_REQUEST['dsminaaf'];
		$dshoraaf1=$dshoraaf.":".$dsminaaf;*/
		
		$idusuario=$_REQUEST['idusuario'];//asesor encargada de ejecutar la gestion
		if ($idacomp=="") $idacomp=0;
		$idtipo=$_REQUEST['idtipo'];//tipo de gestion
		//$idcliente=$_REQUEST['idcliente'];//tercero asociado a la gestion
		/* poner opcion de agregar nuevo cliente*/
		
				
		if($idcontacto=="")$idcontacto=$_REQUEST['dscontacto'];//contacto del tercero asociado a la gestion
		//exit();
		/*poner opciones de agregar un contacto*/
		$dsproducto=$_REQUEST['dsproducto'];
		$dsfechap=$_REQUEST['dsfechap'];
		
		$idreportes=$_REQUEST['idreportes'];
		$idreportesmail=$_REQUEST['idreportesmail'];
		$idplanos=$_REQUEST['idplanos'];
		$idmateriales=$_REQUEST['idmateriales'];
		$dsresena=$_REQUEST['dsresena'];
		$dsobs=$_REQUEST['dsobs'];
		$idra=$_REQUEST['idra'];//calificacion
		$idactivo=$_REQUEST['idactivo'];//
		
		$sql="select a.id,b.dsnombre1,b.dsnombre2,b.dsapell,b.dsapell2";
		$sql.=",a.dshorai,a.dshoraf";
		$sql.=" from $tabla a,tblclientes b ";
		$sql.=" where a.idcliente=b.id ";
		$sql.=" and a.iddia=".$diaciclo;
		$sql.=" and a.idciclo=".$idciclo;
		$sql.=" and a.idusuario=".$idusuario;
		$sql.=" and a.idcanal=".$opt;
		$sql.=" and a.dsfechai='".$dsfechai."'";
		// agreqar calculo con los limites de hora inicial y hora final
		$sql.=" and ((";
		$sql.=" a.idhorai=".$idhorai1;
		$sql.=" or a.idhorai between ".$idhorai1." and ".($idhoraf1-1)." ";
		$sql.=" or a.idhorai = ".($idhoraf1-1)." ";
		$sql.=" ) or ( ";
		$sql.=" a.idhoraf =".$idhoraf1;
		$sql.=" or a.idhoraf between ".($idhorai1+1)." and ".$idhoraf1." ";
		$sql.=" or a.idhoraf = ".($idhorai1+1)." ";
		$sql.=" ))";

		//echo $sql;
		//exit();
		$vermas=mysql_db_query($dbase,$sql,$db);
			if (mysql_num_rows($vermas)>0){
				$dsnombre1=mysql_result($vermas,"0","dsnombre1");
				$dsnombre2=mysql_result($vermas,"0","dsnombre2");
				$dsapell=mysql_result($vermas,"0","dsapell");
				$dsapell2=mysql_result($vermas,"0","dsapell2");
				$dshorai=mysql_result($vermas,"0","dshorai");
				$dshoraf=mysql_result($vermas,"0","dshoraf");
				$dsnombre=$dsnombre1." ".$dsnombre2." ".$dsapell." ".$dsapell2;
				$Mensaje="Este dato ya se encuentra asociado a $dsnombre1 de $dshorai a $dshoraf. <br>Intente de nuevo";
			} else { 
			
				
				$strSQL="insert into $tabla";
				$strSQL.="  (";
				$strSQL.="id,idcliente,idusuario,iddia,dsfechai,dshorai,idhorai";
				$strSQL.=",dshoraf,idhoraf,idciclo,idestado,dsobs,idcanal,dsfecha";
				$strSQL.=",idfecha,idacomp,idra,dsproducto,dsfactura,idgestion,idmedio,idtipo,idcontacto,dsfechaf,dsfechap";
				$strSQL.=",idreportes,idreportesmail,idplanos,idmateriales,dsresena,idactivo,idsucursal";
				/*$strSQL.=",dsfechaa,dshoraai,dshoraaf,idtotal,dsfechac,idfechac,dshorac,idhorac";
				$strSQL.=",dscobroc";	*/
				
				//strSQL.=",dslugar,idpostventa,idgarantia,idasesoria,idproyecto,dsreportes,dsplanos,dsmateriales,dscotizacion,dsresena,dstiempo,idfacturar,dsdorso";
				
				$strSQL.=" ) values (";
				$strSQL.="'',".$idcliente.",".$idusuario.",".$diaciclo.",'".$dsfechai."','".$dshorai1."','".$idhorai1."'";
				$strSQL.=",'".$dshoraf1."','".$idhoraf1."','".$idciclo."',0,'$dsobs','$opt','$fechaBaseLarga'";
				$strSQL.=",$idfecha,'".$_SESSION['i_idusuario']."','$idra','$dsproducto','$dsfactura','$idgestion','$idrecepcion','$idtipo','$idcontacto','$dsfechar','$dsfechap'";
				$strSQL.=",'$idreportes','$idreportesmail','$idplanos','$idmateriales','$dsresena',$idactivo,$idsucursal";
				/*$strSQL.=",'".$dsfechaa."','".$dshoraai1."'";
				$strSQL.=",'".$dshoraaf1."','".$idtotal."'";
				$strSQL.=",'".$dsfechac."','".$idfechac."'";
				$strSQL.=",'".$dshorac1."','".$idhorac1."'";
				$strSQL.=",'".$dscobroc."'";*/
				
				//$strSQL.=",'$dslugar','$idpostventa','$idgarantia','$idasesoria','$idproyecto','$dsreportes','$dsplanos','$dsmateriales','$dscotizacion','$dsresena','$dstiempo','$idfacturar','$dsdorso'";
				$strSQL.=" )";
				//exit();
				//echo $strSQL;
				//exit();
				if (mysql_db_query($dbase,$strSQL,$db)) { 
					$sql="select a.id";
					$sql.=" from $tabla a,tblclientes b ";
					$sql.=" where a.idcliente=b.id ";
					$sql.=" and a.iddia=".$diaciclo;
					$sql.=" and a.idciclo=".$idciclo;
					$sql.=" and a.idusuario=".$idusuario;
					$sql.=" and a.idcanal=".$opt;
					$sql.=" and a.dsfechai='".$dsfechai."'";
					$sql.=" and ((";
					$sql.=" a.idhorai=".$idhorai1;
					$sql.=" or a.idhorai between ".$idhorai1." and ".($idhoraf1-1)." ";
					$sql.=" or a.idhorai = ".($idhoraf1-1)." ";
					$sql.=" ) or ( ";
					$sql.=" a.idhoraf =".$idhoraf1;
					$sql.=" or a.idhoraf between ".($idhorai1+1)." and ".$idhoraf1." ";
					$sql.=" or a.idhoraf = ".($idhorai1+1)." ";
					$sql.=" ))";
					$vermas=mysql_db_query($dbase,$sql,$db);
					if (mysql_num_rows($vermas)>0){
						$fila=mysql_fetch_object($vermas);
						$iddetalle=$fila->id;
						//array de actividades
						$dsnumero=$_REQUEST['dsnumero'];
						$dscompromiso=$_REQUEST['dscompromiso'];
						$dsresponsable=$_REQUEST['dsresponsable'];
						$dsfechaini=$_REQUEST['dsfechaini'];
						$dsfechaest=$_REQUEST['dsfechaest'];
						for($i=0;$i<count($dsnumero);$i++){
							if($dsnumero[$i]<>""){
							$str="insert into tblvisitasactividades(idvisita,dsnumero,dsactividad,dsresponsable,dsfechaini,dsfechafin)values";
							echo $str.="($iddetalle,'".$dsnumero[$i]."','".$dscompromiso[$i]."','".$dsresponsable[$i]."','".$dsfechaini[$i]."','".$dsfechaest[$i]."')";
							mysql_db_query($dbase,$str,$db);
							}
						}
						$idservicio=$_REQUEST['idservicio'];//tipo de servicio (insertar en otra tabla)
						$con=count($idservicio);
						for($i=0;$i<$con;$i++){
							if($idservicio[$i]<>""){
								$str=" insert into tblvisitasxservicio(idvisita,idservicio)";
								$str.="values($iddetalle,".$idservicio[$i].")";
								mysql_db_query($dbase,$str,$db);
							}
						}
					}
					$Mensaje="Datos ingresados con exito para el rutero y cargado en el listado";
				} else { 
					$Mensaje="Los datos no se pueden ingresar por problema en la base de datos";
				}
				// envio de correo
			}
			mysql_free_result($vermas);
	}
}
if ($_REQUEST['enviar']=="Actualizar"){
	if ($opt==1 || $opt==2 || $opt==3){ // medicos
			$contar=count($_REQUEST['id']);
			for ($j=0;$j<$contar;$j++){
				if ($_REQUEST['dsres'][$j]<>""){
					$sqlm=" update $tabla set idestado=".$_REQUEST['idestado'][$j];
					$sqlm.= ",dsr='".$_REQUEST['dsres'][$j]."'";
					$sqlm.= " where id=".$_REQUEST['id'][$j];
					// echo $sqlm;
					mysql_db_query($dbase,$sqlm,$db);
				} // fin si
			} // fin for
	}
		$Mensaje="Rutero actualizado con éxito y cambiado en el listado";	
}

if($_REQUEST['enviar1']=="Modificar"){
	
	$idgestion=$_REQUEST['idgestion'];//forma como se obtuvo la gestion
		$idrecepcion=$_REQUEST['idrecepcion'];//medio por el cual se realizo o se recibio la gestion
		
	
	if ($opt==1 || $opt==2 || $opt==3 ){ // cualquiera
		$dsfechai=$_REQUEST['dsfechai']; // fecha gestion
		if ($dsfechai=="") $dsfechai=$_REQUEST['dsfechar'];//fecha de la gestion
		$partir=explode("/",$dsfechai);
		$idfecha=$partir[0].$partir[1].$partir[2];
		
		if ($dsfechar=="") $dsfechar=$_REQUEST['dsfechar'];//fecha de recepcion
		$partir=explode("/",$dsfechar);
		$idfechar=$partir[0].$partir[1].$partir[2];
		
		// combo de hora programada
		$dshorai=$_REQUEST['dshorai'];  
		$dsmini=$_REQUEST['dsmini'];
	
		$dshorai1=$dshorai.":".$dsmini;
		$idhorai1=intval($dshorai.$dsmini);
		//
		
		$dshoraf=$_REQUEST['dshoraf'];  
		$dsminf=$_REQUEST['dsminf'];
		
		/*if ($dshoraf=="" && $dsminf=="") { 
			$dshoraf=$_REQUEST['dshoraaf'];  
			$dsminf=$_REQUEST['dsminaaf'];
		}*/
		
		$dshoraf1=$dshoraf.":".$dsminf;
		$idhoraf1=intval($dshoraf.$dsminf);

		/*// combo de hora actividad
		$dshoraai=$_REQUEST['dshoraai'];  
		$dsminaai=$_REQUEST['dsminaai'];
		$dshoraai1=$dshoraai.":".$dsminaai;
		// hora final
		$dshoraaf=$_REQUEST['dshoraaf'];  
		$dsminaaf=$_REQUEST['dsminaaf'];
		$dshoraaf1=$dshoraaf.":".$dsminaaf;*/
		
		$idusuario=$_REQUEST['idusuario'];//asesor encargada de ejecutar la gestion
		if ($idacomp=="") $idacomp=0;
		$idtipo=$_REQUEST['idtipo'];//tipo de gestion
		//$idcliente=$_REQUEST['idcliente'];//tercero asociado a la gestion
		/* poner opcion de agregar nuevo cliente*/
		$idcontacto=$_REQUEST['dscontacto'];//contacto del tercero asociado a la gestion
		/*poner opciones de agregar un contacto*/
		
		$dsproducto=$_REQUEST['dsproducto'];
		$dsfechap=$_REQUEST['dsfechap'];
		
		$idreportes=$_REQUEST['idreportes'];
		$idreportesmail=$_REQUEST['idreportesmail'];
		$idplanos=$_REQUEST['idplanos'];
		$idmateriales=$_REQUEST['idmateriales'];
		$dsresena=$_REQUEST['dsresena'];
		$dsobs=$_REQUEST['dsobs'];
		$idra=$_REQUEST['idra'];//calificacion
		$dsfactura=$_REQUEST['dsfactura'];//
		$idactivo=$_REQUEST['idactivo'];//
		
		
		$sql="select a.id,b.dsnombre1,b.dsnombre2,b.dsapell,b.dsapell2";
		$sql.=",a.dshorai,a.dshoraf";
		$sql.=" from $tabla a,tblclientes b ";
		$sql.=" where a.idcliente=b.id ";
		$sql.=" and a.iddia=".$diaciclo;
		$sql.=" and a.idciclo=".$idciclo;
		// $sql.=" and a.idcliente=".$idcliente; // cualquier cliente
		// $sql.=" and a.dsobs='".$dsobs."'";
		$sql.=" and a.idusuario=".$idusuario;
		$sql.=" and a.idcanal=".$opt;
		$sql.=" and a.dsfechai='".$dsfechai."'";
		//$sql.=" and a.idsact=".$idsact;
		//$sql.=" and a.idr=".$idr;
		//$sql.=" and a.idra=".$idra;
		// agreqar calculo con los limites de hora inicial y hora final
		$sql.=" and ((";
		$sql.=" a.idhorai=".$idhorai1;
		$sql.=" or a.idhorai between ".$idhorai1." and ".($idhoraf1-1)." ";
		$sql.=" or a.idhorai = ".($idhoraf1-1)." ";
		$sql.=" ) or ( ";
		$sql.=" a.idhoraf =".$idhoraf1;
		$sql.=" or a.idhoraf between ".($idhorai1+1)." and ".$idhoraf1." ";
		$sql.=" or a.idhoraf = ".($idhorai1+1)." ";
		$sql.=" )) and a.id<>$iddetalle";

		//echo $sql;
		//exit();
		$vermas=mysql_db_query($dbase,$sql,$db);
			if (mysql_num_rows($vermas)>0){
				$Mensaje="Es posible que la hora de visita que se propone ya este ocupada, por favor revise los datos";
			} else { 
				$strSQL="update $tabla set idcliente=$idcliente";
				$strSQL.=",idusuario=$idusuario";
				$strSQL.=",iddia='$diaciclo'";
				$strSQL.=",dsfechai='$dsfechai'";
				$strSQL.=",dshorai='$dshorai1'";
				$strSQL.=",idhorai='$idhorai1'";
				$strSQL.=",dshoraf='$dshoraf1'";
				$strSQL.=",idhoraf='$idhoraf1'";
				$strSQL.=",idciclo='$idciclo'";
				//$strSQL.=",idestado='0'";
				$strSQL.=",dsobs='$dsobs'";
				$strSQL.=",idcanal='$opt'";
				/*$strSQL.=",dsfecha='$fechaBaseLarga'";
				$strSQL.=",idfecha='$idfecha'";*/
				$strSQL.=",idacomp='".$_SESSION['i_idusuario']."'";
				$strSQL.=",idra='$idra'";
				$strSQL.=",dsproducto='$dsproducto'";
				$strSQL.=",dsfactura='$dsfactura'";
				$strSQL.=",idgestion='$idgestion'";
				$strSQL.=",idmedio='$idrecepcion'";
				$strSQL.=",idtipo='$idtipo'";
				$strSQL.=",idcontacto='$idcontacto'";
				$strSQL.=",dsfechaf='$dsfechar'";
				$strSQL.=",dsproducto='$dsproducto'";
				$strSQL.=",dsfechap='$dsfechap'";
				$strSQL.=",idreportes='$idreportes'";
				$strSQL.=",idreportesmail='$idreportesmail'";
				$strSQL.=",idplanos='$idplanos'";
				$strSQL.=",idmateriales='$idmateriales'";
				$strSQL.=",dsresena='$dsresena'";
				$strSQL.=",dsfactura='$dsfactura'";
				$strSQL.=",dsobs='$dsobs'";
				$strSQL.=",idactivo='$idactivo'";
				$strSQL.=",idsucursal='$idsucursal'";
				$strSQL.=" where id=$iddetalle";
				//echo $strSQL;
				//exit();
				if (mysql_db_query($dbase,$strSQL,$db)) { 
						$sql="delete from tblvisitasactividades where idvisita=$iddetalle";
						mysql_db_query($dbase,$sql,$db);
						//array de actividades
						$dsnumero=$_REQUEST['dsnumero'];
						$dscompromiso=$_REQUEST['dscompromiso'];
						$dsresponsable=$_REQUEST['dsresponsable'];
						$dsfechaini=$_REQUEST['dsfechaini'];
						$dsfechaest=$_REQUEST['dsfechaest'];
						for($i=0;$i<count($dsnumero);$i++){
							if($dsnumero[$i]<>""){
							$str="insert into tblvisitasactividades(idvisita,dsnumero,dsactividad,dsresponsable,dsfechaini,dsfechafin)values";
							$str.="($iddetalle,'".$dsnumero[$i]."','".$dscompromiso[$i]."','".$dsresponsable[$i]."','".$dsfechaini[$i]."','".$dsfechaest[$i]."')";
							mysql_db_query($dbase,$str,$db);
							}
						}
						$sql="delete from tblvisitasxservicio where idvisita=$iddetalle";
						mysql_db_query($dbase,$sql,$db);
						$idservicio=$_REQUEST['idservicio'];//tipo de servicio (insertar en otra tabla)
						$con=count($idservicio);
						for($i=0;$i<$con;$i++){
							if($idservicio[$i]<>""){
								$str=" insert into tblvisitasxservicio(idvisita,idservicio)";
								$str.="values($iddetalle,".$idservicio[$i].")";
								mysql_db_query($dbase,$str,$db);
							}
						}

					$Mensaje="Datos ingresados con exito para el rutero y cargado en el listado";
				} else { 
					$Mensaje="Los datos no se pueden ingresar por problema en la base de datos";
				}
				// envio de correo
			}
			mysql_free_result($vermas);
	}

}

if($iddetalle<>"" && $_REQUEST['idcopia']==1){
	$partir=explode("/",$dsfechai);
	$sql=" select a.dsnombre1,a.dsapell,a.dscorreo,b.dscorreo as correocon from tblclientes a left join tblclientescontacto b on a.id=b.idcliente and b.id='$idcontacto'";
	$sql.=" where a.id=$idcliente";
	$ver=mysql_db_query($dbase,$sql,$db);
	if(mysql_num_rows($ver)>0){
		$fila=mysql_fetch_object($ver);
		$dsnombre=$fila->dsnombre1." ".$fila->dsapell;	
		$dscorreo=$fila->dscorreo;
		if($fila->correocon<>"")$dscorreo=$fila->correocon;
	}
	$dscorreo="amunoz@comprandofacil.com";
	$asunto="Agendamiento actividad ".$autorizado;
	$cuerpo.="<font face='Arial' size=-1>Apreciado <strong> </strong>".$dsnombre." :<br><br>";	
	$cuerpo.="Aseragro le envia la cita o actividad a realizar con usted el dia ";	
	$cuerpo.=$partir[2]." de ".nombre_mes($partir[1])." de ".$partir[0];
	$cuerpo.=" a las ".$dshorai1.", si desea ver mas informaci&oacute;n ";
	$cuerpo.=" haga clic <a href='//aseragro.com/gcomercial/modulos/agenda/agenda.imprimir.html.php?id=$iddetalle'>aqu&iacute;</a>";
	$cuerpo.="<br>==============================================================<br>";	
	$cuerpo.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
	$cuerpo.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";
	
	include_once('../../../sitio/PHPMailer_v5.1/class.phpmailer.php');
	include("../../../sitio/PHPMailer_v5.1/class.smtp.php"); 
	$mail=new PHPMailer();
	$cuerpo=eregi_replace("[\]",'',$cuerpo);
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPAuth = true; // turn on SMTP authentication
	$mail->Username = $correobase; // SMTP username
	$mail->Password = $clavebase; // SMTP password
	$mail->Port=$dsport;// 
	
	$mail->Host       = $smtpbase; // SMTP server
	$mail->From       = $correobase;
	$mail->FromName   = "Aseragro";
	$mail->Subject    = $asunto;
	$mail->IsHTML(true);
	$mail->MsgHTML($cuerpo);
	if(trim($dscorreo)<>"")$mail->AddAddress($dscorreo, "Aseragro"); 
	if(!$mail->Send()) {
		
	} else {
		
	}

}

?>
<html>
<head>
	<title><? echo $AppNombre;?> Agendamiento</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilos.css">
<script language="JavaScript" src="../../incluidos/dhtmllib.js"></script>
<script language="JavaScript" src="../../incluidos/scroller.js"></script>
<script language="javascript" src="../../incluidos/ajax.js"></script>

<?
include ("../../incluidos/javageneral.php");
// cuando termine, recargar la pantalla anterior
if ($Mensaje<>""){
?>
<script language="JavaScript" type="text/javascript">
<!--
<? if ($dsfechax1<>"") { ?>
CargarPagina1('<? echo $rr;?>?dsfechax1=<? echo $dsfechax1;?>&idusuariox=<? echo $idusuariox;?>&enca=<? echo $enca;?>');

<? } else { ?>
// funciones unicas de esta pagina
CargarPagina1('detallerutero.php?idciclo=<? echo $idciclo;?>&dsciclo=<? echo $dsciclo;?>&diaciclo=<? echo $diaciclo;?>&totalciclo=<? echo $totalciclo;?>&dataciclo=<? echo $dataciclo;?>&opt=<? echo $opt;?>&rr=<? echo $rr;?>');
<? } ?>
//-->
</script>
<? } ?>
</head>
<body color=#ffffff  topmargin=0 leftmargin=0>
<?
// scroll con indicadores
$dsnit=seldato("dsnit","id","tblclientes",$idcliente,2);
$dsdiv=seldato("dscodf","id","tblclientes",$idcliente,2);
include ("../../incluidos/mensajes.indicadores.php");
?>
		<table width="100%" cellspacing="0" cellpadding="1" class=textnegro2 ID="Table2">
		<form action="<? echo $_SERVER['PHP_SELF'];?>" name="t3" method="post">
			<tr >
					<td valign=top align=left class="fondoprincipal2">
<input type="button" name="enviar1" value="Cerrar Ventana" class=formabot onClick="window.close();">

					</font>
					</td>
		</tr>					
		</form>
		</table>
<? include ("../../incluidos/resultoperaciones.php"); ?>	
			<? 
			if ($opt==1 || $opt==2 || $opt==3){
			include ("../../incluidos/func.innasocmed.php");
			}
			?>
		
<?
//include ("../../incluidos/inferior.php");
include ("../../incluidos/cerrarconexion.php"); 
?>
</body>
</html>
<script language="javascript">
	function cargarcontactos(idclientex){
	document.getElementById('datoscontacto').innerHTML="";

		if(idclientex!=""){
		//alert(idclientex);	 
		 // cargar cliente y colocar las variables seleccionadas
		 conexion=AjaxObj();
		 conexion.open("POST","cliente.contactos.php?idclientex="+idclientex,true);
	     conexion.onreadystatechange =function() {
	                 //	aalert(conexion.readyState);
				 if (conexion.readyState==4) {
				 var _resultado = conexion.responseText;
				 	// partir el resultado
					if (_resultado!="") { 
						//alert(_resultado);
						//alert(_resultado);
						document.getElementById('datoscontacto').innerHTML=_resultado;
						// descuentos
					} // fin _resultado
		        } // fin funcion
		      } // fin conexion
		    //contenedor.innerHTML ="";		   
		    conexion.send(null) // limpia conexion	
		}
	}
	function mostrarcapax(capa,tipo){
		if(document.getElementById(capa))document.getElementById(capa).style.display="";
		if(tipo==1){
			document.t1.idcliente.value="";
		}else{
			document.t1.idcontacto.value="";
		}
	}
	function ocultarx(capa){
		if(document.getElementById(capa)){
			document.getElementById(capa).style.display="none";
			
		}
		
	}
</script>
