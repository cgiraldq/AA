<?
/*
foreach($_POST as $name=>$val){ 
    echo($name.'='.$val.'<br>'); 
} 
*/
	/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2011
Medellin - Colombia
=====================================================================
  Autores:  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- | 
script general de ingreso de actividad
*/

if ($inn<>"" || $mod<>"") {		
$dshoraf=date("H:s");
$opt=1;
if($dsfecha<>"") $dsfechac=$dsfecha;

//$dsvendedor=$_REQUEST['dsvendedor'];
$idmedio=$_REQUEST['idmedio'];
//$dsfechac=$_REQUEST['dsfecha'];
if ($idsucursal=="") $idsucursal=0; 

	$partir=explode("/",$dsfechac);
	 $idfechac=$partir[0].$partir[1].$partir[2];

	//exit;
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
	// capturar datos del ciclo
	$partir=explode("/",$dsfechax1);
	$aniox=intval($partir[0]);
	$mesx=intval($partir[1]);
	$diax=intval($partir[2]);
	//echo $mesx;
	//exit();
	$sql="select iddiacal,idmescal,idaniocal,idciclo,iddiaciclo  ";
	$sql.="from tblciclodiaxcal  where ";
	$sql.=" idaniocal=$aniox and iddiacal=$diax and idmescal=$mesx";
	//echo $sql;
	//exit;
	$vermasa=mysql_db_query($dbase,$sql,$db);
	if (mysql_num_rows($vermasa)>0){
		$dia=mysql_result($vermasa,"0","iddiacal");
		$mes=mysql_result($vermasa,"0","idmescal");
		$anio=mysql_result($vermasa,"0","idaniocal");
		$diaciclo=mysql_result($vermasa,"0","iddiaciclo");
		$idciclo=mysql_result($vermasa,"0","idciclo");
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
	mysql_free_result($vermasa);	
	// 2. parametros de entrada de la actividad
		//echo "xxx";
		//exit;	
	if ($opt==1 || $opt==2 || $opt==3 ){ // cualquiera
		//echo "xx";
		//exit;
	//	$dsfechai=$_REQUEST['dsfechai']; // fecha gestion
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
		$idcotizarcomp=$_REQUEST['idcotizarcomp'];
		$dsvendedorx=$_SESSION['i_idusuario'];


		$dshoraf=date("H");
		$dsminf=date("i");
		
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
		//exit;
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
		$idra=$_REQUEST['idra'];//calificacion
		
	 	$idactivo=$_REQUEST['idactivo'];//
			
		$sql="select a.id,b.dsnombre1,b.dsnombre2,b.dsapell,b.dsapell2";
		$sql.=",a.dshorai,a.dshoraf";
		$sql.=" from tblvisitas a,tblclientes b ";
		$sql.=" where a.idcliente=b.id ";
		$sql.=" and a.iddia=".$diaciclo;
		$sql.=" and a.idciclo=".$idciclo;
		$sql.=" and a.idusuario=".$dsvendedorx;
		$sql.=" and a.idcanal=".$opt;
		$sql.=" and a.dsfechai='".$dsfechac."'";
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
		$vermasa=mysql_db_query($dbase,$sql,$db);
			if (mysql_num_rows($vermasa)>0){
				$dsnombre1=mysql_result($vermasa,"0","dsnombre1");
				$dsnombre2=mysql_result($vermasa,"0","dsnombre2");
				$dsapell=mysql_result($vermasa,"0","dsapell");
				$dsapell2=mysql_result($vermasa,"0","dsapell2");
				$dshorai=mysql_result($vermasa,"0","dshorai");
				$dshoraf=mysql_result($vermasa,"0","dshoraf");
				$dsnombre=$dsnombre1." ".$dsnombre2." ".$dsapell." ".$dsapell2;
				//$Mensaje="Este dato ya se encuentra asociado a $dsnombre1 de $dshorai a $dshoraf. <br>Intente de nuevo";
			} else { 
			

				$strSQL="insert into tblvisitas";
				$strSQL.="  (";
				$strSQL.="id,idcliente,idusuario,iddia,dsfechai,dshorai,idhorai";
				$strSQL.=",dshoraf,idhoraf,idciclo,idestado,dsobs,idcanal,dsfecha";
				$strSQL.=",idfecha,idacomp,idra,dsproducto,dsfactura,idgestion,idmedio,idtipo,idcontacto,dsfechaf,dsfechap";
				$strSQL.=",idreportes,idreportesmail,idplanos,idmateriales,dsresena,idactivo,idsucursal,idcotizar";
				/*$strSQL.=",dsfechaa,dshoraai,dshoraaf,idtotal,dsfechac,idfechac,dshorac,idhorac";
				$strSQL.=",dscobroc";	*/
				//strSQL.=",dslugar,idpostventa,idgarantia,idasesoria,idproyecto,dsreportes,dsplanos,dsmateriales,dscotizacion,dsresena,dstiempo,idfacturar,dsdorso";
				$strSQL.=" ) values (";
				$strSQL.="'',".$idcliente.",".$dsvendedorx.",".$diaciclo.",'".$dsfechac."','".$dshorai1."','".$idhorai1."'";
				$strSQL.=",'".$dshoraf1."','".$idhoraf1."','".$idciclo."',0,'$dsobsagenda','$opt','$fechaBaseLarga'";
				$strSQL.=",'".$idfechac."','".$_SESSION['i_idusuario']."','$idra','$dsproducto','$dsfactura','$idgestion','$idrecepcion','$idtipo','$idcontacto','$dsfechac','$dsfechap'";
				$strSQL.=",'$idreportes','$idreportesmail','$idplanos','$idmateriales','$dsresena',1,$idsucursal,'$idcotizarcomp'";
				/*$strSQL.=",'".$dsfechaa."','".$dshoraai1."'";
				$strSQL.=",'".$dshoraaf1."','".$idtotal."'";
				$strSQL.=",'".$dsfechac."','".$idfechac."'";
				$strSQL.=",'".$dshorac1."','".$idhorac1."'";
				$strSQL.=",'".$dscobroc."'";*/
				//$strSQL.=",'$dslugar','$idpostventa','$idgarantia','$idasesoria','$idproyecto','$dsreportes','$dsplanos','$dsmateriales','$dscotizacion','$dsresena','$dstiempo','$idfacturar','$dsdorso'";
				$strSQL.=" )";
					//echo $strSQL;
				//exit();
				mysql_db_query($dbase,$strSQL,$db);

				/*if (mysql_db_query($dbase,$strSQL,$db)) { 
					$sql="select a.id";
					$sql.=" from tblvisitas a,tblclientes b ";
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
						$dsresponsable=$_REQUEST['dsresponsableusuario'];
						$dsfechaini=$_REQUEST['dsfechaini'];
						$dsfechaest=$_REQUEST['dsfechaest'];
						$idcotizar=$_REQUEST['idcotizar'];
						for($i=0;$i<count($dsnumero);$i++){
							if($dsnumero[$i]<>""){
							$str="insert into tblvisitasactividades(idvisita,dsnumero,dsactividad,dsresponsable,dsfechaini,dsfechafin,idactivo,idcotizar)values";
							$str.="($iddetalle,'".$dsnumero[$i]."','".$dscompromiso[$i]."','".$dsresponsable[$i]."','".$dsfechaini[$i]."','".$dsfechaest[$i]."',1,'".$idcotizar[$i]."')";
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
				*/
				// envio de correo
			}
			mysql_free_result($vermasa);
	}
	if($_REQUEST['idcomp']<>""){
		//$sql="update tblvisitasactividades set idactivo=2";
		//echo $sql;
		//exit;
		//mysql_db_query($dbase,$sql,$db);
	}
}
?>