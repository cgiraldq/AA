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

$rutx=1;
if($rutx==1) $rutxx="../";
include ($rutxx."../../incluidos_modulos/sessiones.php");
include ($rutxx."../../incluidos_modulos/creditos.php");
include ($rutxx."../../incluidos_modulos/vargenerales.php");
include ($rutxx."../../incluidos_modulos/varconexion.php");
include ($rutxx."../../incluidos_modulos/funciones.php");
$formabase="";
include ($rutxx."../../incluidos_modulos/func.calendario_2.php"); // funcion nueva del calendario
include($rutxx."../../incluidos_modulos/class.rc4crypt.php");
$rc4 = new rc4crypt();
//$db->debug=true;

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

$tabla="crmtblvisitas";

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
$sql="select iddiacal,idmescal,idaniocal,iddiaciclo,idciclo  from crmtblciclodiaxcal  where iddiaciclo=$diaciclo ";
$sql.=" and idciclo=".$idciclo;

} else {
	$partir=explode("/",$dsfechax1);
	$aniox=intval($partir[0]);
	$mesx=intval($partir[1]);
	$diax=intval($partir[2]);
	//echo $mesx;
	//exit();
	$sql="select iddiacal,idmescal,idaniocal,iddiaciclo,idciclo  ";
	$sql.="from crmtblciclodiaxcal  where ";
	$sql.=" idaniocal=$aniox and iddiacal=$diax and idmescal=$mesx";

}
// si se cambia la fecha, se cambia el dida
//echo $sql;
 //exit();
$result = $db->Execute($sql);
if (!$result->EOF) {

$dia=$result->fields[0];
$mes=$result->fields[1];
$anio=$result->fields[2];
$diaciclo=$result->fields[3];
$idciclo=$result->fields[4];


		if ($dia<10) $dia="0".$dia;
		if ($mes<10) $mes="0".$mes;
		$dsfechaix=$anio."/".$mes."/".$dia;
	} else {
		$mensajea="Configure los ciclos de visitas para entrar al agendamiento de actividades ";
		$mensajea.="o el dia en el que esta agenda no es valido. Cambie de dia e intente de nuevo<br>";
		$mensajea.="<a href='' onclick='window.close()'>Cerrar esta ventana</a><br>";

		die ($mensajea);
		//exit();
	}
$result->Close();

if($_REQUEST['enviar']=="Ingresar" || $_REQUEST['enviar1']=="Modificar" && $_REQUEST['idformulario']<>""){


	$idclientex=$_REQUEST['idcliente'];//tercero asociado a la gestion
	$idformulario=$_REQUEST['idformulario'];

	$tipocliente=$_REQUEST['tipocliente'];
	$camposform=$_REQUEST['camposform'];
	$camposformx= explode(",",$camposform);
	$total=count($camposformx);

	if($idclientex==""){
		$sql="select id,$camposform from crm_clientes where id>0 and ";
		for ($i=0; $i < $total; $i++) {
			$sqlxx.=" ".$camposformx[$i]."='".$_REQUEST[$camposformx[$i]]."' and ";
		}

		$sql.=$sqlxx;

		$sql.=" idusuario='".$_SESSION['i_idusuario']."'";

		$result = $db->Execute($sql);
		if (!$result->EOF) {
		 $idclientex="0|".$result->fields[0];
		}else{
		$sql="insert into crm_clientes ($camposform,idactivo,clave_de_acceso,idfecha,dsfecha,idusuario)";

		$sql.="values(";

		for ($i=0; $i < $total; $i++) {
			$sqlxy.="'".$_REQUEST[$camposformx[$i]]."',";
		}
		$sqlxy = trim($sqlxy,',');
		$sql.=$sqlxy;
		// manejo de clave
		$clavee1 = $rc4->encrypt($s3m1ll4,"@acceso".date("Y"));
		$clave1 = urlencode($clavee1);



		$sql.=",1,'".$clave1."','$fechaBaseNum','$fechaBaseLarga','".$_SESSION['i_idusuario']."') ";
		//echo $sql;
		//exit();
			$result = $db->Execute($sql);
			//echo $sql;
		//////////////////////////////////////////////////////////////////////////////////
		$sqlxx="select id from crm_clientes where id>0  ";
		for ($i=0; $i < $total; $i++) {
			$sq.=" and ".$camposformx[$i]."='".$_REQUEST[$camposformx[$i]]."'  ";
		}
		$sqlxx.=$sq;
		//$sqlxx.=" idformulario=$idformulario; ";
		//echo $sqlxx;
			//$sql="select id from framecf_tblregistro_formularios where dscampo2='$dsnit'";
		$sql.="  idusuario='".$_SESSION['i_idusuario']."'";


			//echo $sql;
			//echo "<br><br><br>";
			$resultz = $db->Execute($sqlxx);
			if (!$resultz->EOF) {

			$idclientex="0|".$resultz->fields[0];

			}
			$resultz->Close();
		}
	}
	//echo $idclientex;
	$idc=explode('|',$idclientex);
	 $idclientexx=$idc[1];



}

if ($_REQUEST['enviar']=="Ingresar" || $_REQUEST['enviar3']=="Ingresar"){

		$idgestion=$_REQUEST['idgestion'];//forma como se obtuvo la gestion

		$idrecepcion=$_REQUEST['idrecepcion'];//medio por el cual se realizo o se recibio la gestion

	if ($opt==1 || $opt==2 || $opt==3 ){ // cualquiera


		$dsfechai=$_REQUEST['dsfechai']; // fecha gestion
		$idgestionx=$_REQUEST['idgestionx']; // fecha gestion
		if ($dsfechai=="") $dsfechai=$_REQUEST['dsfechar'];//fecha de la gestion
		$partir=explode("/",$dsfechai);
		$idfecha=$partir[0].$partir[1].$partir[2];

		if ($dsfechar=="") $dsfechar=$_REQUEST['dsfechar'];//fecha de recepcion
		$partir=explode("/",$dsfechar);
		$idfechar=$partir[0].$partir[1].$partir[2];

		// combo de hora programada
		$dshorai=$_REQUEST['dshorai'];
		$dsmini=$_REQUEST['dsmini'];
		$idusuario=$_REQUEST['idusuario'];//asesor encargada de ejecutar la gestion

		if ($idclientex=="") $idclientex=$_REQUEST['idcliente'];
		$partir=explode("|",$idclientex);
		$idcliente=$partir[1];


		$dshorai1=$dshorai.":".$dsmini;
		$idhorai1=intval($dshorai.$dsmini);
		$dshoraf=$_REQUEST['dshoraf'];
		$dsminf=$_REQUEST['dsminf'];
		$idcotizarcomp=$_REQUEST['idcotizarcomp'];
		$dshoraf1=$dshoraf.":".$dsminf;
		$idhoraf1=intval($dshoraf.$dsminf);

		if ($idacomp=="") $idacomp=0;
		$idtipo=$_REQUEST['idtipo'];//tipo de gestion
		//$idcliente=$_REQUEST['idcliente'];//tercero asociado a la gestion
		/* poner opcion de agregar nuevo cliente*/
		if($idcontacto=="")$idcontacto=$_REQUEST['dscontacto'];//contacto del tercero asociado a la gestion

		/*poner opciones de agregar un contacto*/
		$dsproducto=$_REQUEST['dsproducto'];
		$dsfechap=$_REQUEST['dsfechap'];
		$dshorap=$_REQUEST['dshorap'];
		$dsminip=$_REQUEST['dsminip'];
		$dshorap1=$dshorap.":".$dsminip;
		$idhorap1=intval($dshorap.$dsminip);


		$idreportes=$_REQUEST['idreportes'];
		$idreportesmail=$_REQUEST['idreportesmail'];
		$idplanos=$_REQUEST['idplanos'];
		$idmateriales=$_REQUEST['idmateriales'];
		$dsresena=$_REQUEST['dsresena'];

		$idra=$_REQUEST['idra'];//calificacion
		$dsfactura=$_REQUEST['dsfactura'];
		$idactivo=$_REQUEST['idactivo'];//

		$sql="select a.id,b.nombre_o_razn_social,b.apellido_o_nombre_comercial,telfono_1,correo_email";
		$sql.=",a.dshorai,a.dshoraf";
		$sql.=" from $tabla a,crm_clientes b ";
		$sql.=" where a.idcliente=b.id ";

		//$sql.=" and b.idformulario='$idfom1'";

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
	//echo "sss".$sql;
		//exit();
				$result = $db->Execute($sql);
				if (!$result->EOF) {

				$dsnombre1=$result->fields[1];
				$dsnombre2=$result->fields[1];
				$dsapell=$result->fields[2];
				$dsapell2=$result->fields[3];
				$dshorai=$result->fields[5];
				$dshoraf=$result->fields[6];
				//$dsnombre=$dsnombre1." ".$dsnombre2." ".$dsapell." ".$dsapell2;
				$Mensaje="Este dato ya se encuentra asociado a $dsnombre1 de $dshorai a $dshoraf. <br>Intente de nuevo";
			}else {


				$strSQL="insert into $tabla";
				$strSQL.="  (";
				$strSQL.="idcliente,idusuario,iddia,dsfechai,dshorai,idhorai";
				$strSQL.=",dshoraf,idhoraf,idciclo,idestado,dsobs,idcanal,dsfecha";
				$strSQL.=",idfecha,idacomp,idra,dsproducto,dsfactura,idgestion,idmedio,idtipo,idcontacto,dsfechaf,dsfechap";
				$strSQL.=",idreportes,idreportesmail,idplanos,idmateriales,dsresena,idactivo,gestionxagenda";
				$strSQL.=",dshorap,idhorap";

				$strSQL.=" ) values (";
				$strSQL.=" ".$idcliente.",".$idusuario.",".$diaciclo.",'".$dsfechai."','".$dshorai1."','".$idhorai1."'";
				$strSQL.=",'".$dshoraf1."','".$idhoraf1."','".$idciclo."',0,'$dsobs','$opt','$fechaBaseLarga'";
				$strSQL.=",$idfecha,'".$_SESSION['i_idusuario']."','$idra','$dsproducto','$dsfactura','$idgestion','$idrecepcion','$idtipo','$idcontacto','$dsfechar','$dsfechap'";
				$strSQL.=",'$idreportes','$idreportesmail','$idplanos','$idmateriales','$dsresena',$idactivo,'$idgestionx'";
				$strSQL.=",'$dshorap1','$idhorap1'";

				$strSQL.=" )";

				//echo "<br><br>";
				 //echo $strSQL;
				//exit();
				//$resultsql=$db->Execute($strSQL);

				//exit();
				if($db->Execute($strSQL)) {

					$sql="select a.id";
					$sql.=" from $tabla a,crm_clientes b ";
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

					//echo "<br><br>";
					//echo $sql;
					//exit();
					$resultx = $db->Execute($sql);
						if (!$resultx->EOF) {

						$iddetalle=$resultx->fields[0];

						//array de actividades
						$dsnumero=$_REQUEST['dsnumero'];
						$dscompromiso=$_REQUEST['dscompromiso'];
						$dsresponsable=$_REQUEST['dsresponsableusuario'];
						$dsfechaini=$_REQUEST['dsfechaini'];
						$dsfechaest=$_REQUEST['dsfechaest'];
						$idcotizar=$_REQUEST['idcotizar'];
						for($i=0;$i<count($dsnumero);$i++){

							$str="insert into crmtblvisitasactividades(idvisita,dsnumero,dsactividad,dsresponsable,dsfechaini,dsfechafin,idactivo)values";
							$str.="('$iddetalle','".$dsnumero[$i]."','".$dscompromiso[$i]."','".$dsresponsable[$i]."','".$dsfechaini[$i]."','".$dsfechaest[$i]."','1');";
							//echo $str;
							$db->Execute($str);

						}

						$idservicio=$_REQUEST['idservicio'];//tipo de servicio (insertar en otra tabla)
						 $con=count($idservicio);
						for($i=0;$i<$con;$i++){

								if($idservicio[$i]<>""){
								$str=" insert into crmtblvisitasxservicio(idvisita,idservicio)";
								$str.="values('$iddetalle','".$idservicio[$i]."');";
								//echo $str;
								$db->Execute($str);
							}
						}
					}
					//exit();
					$resultx->Close();
					$Mensaje="Datos ingresados con exito para el rutero y cargado en el listado";
					$cambio=1;
				} else {
					$Mensaje="Los datos no se pueden ingresar por problema en la base de datos";
				}

				// envio de correo
			}
			$result->Close();
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
					$db->Execute($sqlm);
				} // fin si
			} // fin for
	}
		$Mensaje="Rutero actualizado con éxito y cambiado en el listado";
}

if($_REQUEST['enviar1']=="Modificar" || $_REQUEST['enviar2']=="Modificar"){

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

		$idgestionx=$_REQUEST['idgestionx'];
		$dshoraf1=$dshoraf.":".$dsminf;
		$idhoraf1=intval($dshoraf.$dsminf);

		$idusuario=$_REQUEST['idusuario'];//asesor encargada de ejecutar la gestion

		if ($idacomp=="") $idacomp=0;
		$idtipo=$_REQUEST['idtipo'];//tipo de gestion

		 $idcliente=$_REQUEST['idcliente'];//tercero asociado a la gestion
		//exit();
		$partir=explode("|",$idcliente);
		  $idcliente=$partir[1];

		/* poner opcion de agregar nuevo cliente*/
		$idcontacto=$_REQUEST['dscontacto'];//contacto del tercero asociado a la gestion
		/*poner opciones de agregar un contacto*/

		$dsproducto=$_REQUEST['dsproducto'];
		$dsfechap=$_REQUEST['dsfechap'];

		$dshorap=$_REQUEST['dshorap'];
		$dsminip=$_REQUEST['dsminip'];
		$dshorap1=$dshorap.":".$dsminip;
		$idhorap1=intval($dshorap.$dsminip);


		$idreportes=$_REQUEST['idreportes'];
		$idreportesmail=$_REQUEST['idreportesmail'];
		$idplanos=$_REQUEST['idplanos'];
		$idmateriales=$_REQUEST['idmateriales'];
		$dsresena=$_REQUEST['dsresena'];
		$dsobs=$_REQUEST['dsobs'];
		$idra=$_REQUEST['idra'];//calificacion
		$dsfactura=$_REQUEST['dsfactura'];//
		$idactivo=$_REQUEST['idactivo'];//


		 $sqlf=" select a.id from framecf_tbltiposformularios a where idformclientes=1";
					$resultf = $db->Execute($sqlf);
					if (!$resultf->EOF) {
						$idform=$resultf->fields[0];
					}
					$resultf->Close();


				 $sqlc=" select a.dsm,a.dscampo from framecf_tbltiposformulariosxcampo a where idselect=1 order by id";
				 //echo $sqlc;
				 //exit();
					$resultc = $db->Execute($sqlc);
					if (!$resultc->EOF) {
						while(!$resultc->EOF) {

						$campodsm=$resultc->fields[0];
							$campo.="b.".$resultc->fields[1].",";

						$resultc->MoveNext();
					}
					}
					$resultc->Close();

					//echo $campo.="b.".$resultc->fields[1].",";
			 $campos = trim($campo,',');


		$sql="select a.id,b.nombre_o_razn_social,b.apellido_o_nombre_comercial,telfono_1,correo_email";
		$sql.=",a.dshorai,a.dshoraf";
		$sql.=" from $tabla a,crm_clientes b ";
		$sql.=" where a.idcliente=b.id ";
		$sql.=" and a.iddia=".$diaciclo;
		$sql.=" and a.idciclo=".$idciclo;
		//$sql.=" and a.idcliente=".$idcliente; // cualquier cliente
		// $sql.=" and a.dsobs='".$dsobs."'";
		$sql.=" and a.idusuario=".$idusuario;
		$sql.=" and a.idcanal=".$opt;
		$sql.=" and a.dsfechai='".$dsfechai."'";
		//$sql.=" and a.idsact=".$idsact;
		//$sql.=" and a.idr=".$idr;
		$sql.=" and a.idra='".$idra."'";
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
		$result = $db->Execute($sql);
						if (!$result->EOF) {
				$Mensaje="Es posible que la hora de visita que se propone ya este ocupada, por favor revise los datos";
			} else {

				$strSQL="update $tabla set ";

				$strSQL.="idcliente='$idcliente'";
				$strSQL.=",idusuario='$idusuario'";
				$strSQL.=",iddia='$diaciclo'";
				$strSQL.=",dsfechai='$dsfechai'";
				$strSQL.=",dshorai='$dshorai1'";
				$strSQL.=",idhorai='$idhorai1'";
				$strSQL.=",dshoraf='$dshoraf1'";
				$strSQL.=",idhoraf='$idhoraf1'";
				$strSQL.=",idciclo='$idciclo'";
				//$strSQL.=",idestado='0'";
				//$strSQL.=",dsobs='$dsobs'";
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
				$strSQL.=",dshorap='$dshorap1'";
				$strSQL.=",idhorap='$idhorap1'";

				$strSQL.=",idreportes='$idreportes'";
				$strSQL.=",idreportesmail='$idreportesmail'";
				$strSQL.=",idplanos='$idplanos'";
				$strSQL.=",idmateriales='$idmateriales'";
				$strSQL.=",dsresena='$dsresena'";
				$strSQL.=",dsfactura='$dsfactura'";
				$strSQL.=",dsobs='$dsobs'";
				$strSQL.=",idactivo='$idactivo'";
				//$strSQL.=",idsucursal='$idsucursal'";
				$strSQL.=" where id='$iddetalle'";
				//echo $strSQL;
				//exit();
						if ($db->Execute($strSQL)) {
						$sql="delete from crmtblvisitasactividades where idvisita='$iddetalle'";
						$resulty = $db->Execute($sql);

						$sqlupdate=" UPDATE framecf_tblgestionesxusuario SET idactivo='$idactivo' WHERE id='$idgestionx' ";
						$resultupdate = $db->Execute($sqlupdate);
						if ($db->Execute($sql)) {
						//echo "sss";
						//array de actividades
						$dsnumero=$_REQUEST['dsnumero'];
						$dscompromiso=$_REQUEST['dscompromiso'];
						$dsresponsable=$_REQUEST['dsresponsableusuario'];
						$dsfechaini=$_REQUEST['dsfechaini'];
						$dsfechaest=$_REQUEST['dsfechaest'];
						$idcotizar=$_REQUEST['idcotizar'];
						for($i=0;$i<count($dsnumero);$i++){

							$str="insert into crmtblvisitasactividades(idvisita,dsnumero,dsactividad,dsresponsable,dsfechaini,dsfechafin,idactivo)values";
							$str.="('$iddetalle','".$dsnumero[$i]."','".$dscompromiso[$i]."','".$dsresponsable[$i]."','".$dsfechaini[$i]."','".$dsfechaest[$i]."',1);";
							//echo $str;
							//exit();
							$db->Execute($str);

						}
						$sql="delete from crmtblvisitasxservicio where idvisita='$iddetalle'";
						$db->Execute($sql);
						$idservicio=$_REQUEST['idservicio'];//tipo de servicio (insertar en otra tabla)
						$con=count($idservicio);
						for($i=0;$i<$con;$i++){

								$str=" insert into crmtblvisitasxservicio(idvisita,idservicio)";
								$str.="values('$iddetalle','".$idservicio[$i]."');";
								//echo $str;
								//exit();
								$db->Execute($str);
						}
				}
				$resulty->Close();
					$Mensaje="Datos actualizados con exito para el rutero y cargado en el listado";
					$cambio=1;
				} else {
					$Mensaje="Los datos no se pueden ingresar por problema en la base de datos";
				}
				$result->Close();
				// envio de correo
			}
			$result->Close();
	}
	if($_REQUEST['idcomp']<>""){
		$sql="update crmtblvisitasactividades set idactivo=2";
		$db->Execute($sql);
	}

} // fin modificar

if($iddetalle<>"" && $_REQUEST['idcopia']==1){
	$partir=explode("/",$dsfechai);
	$sql=" select a.dscampo3,a.dscampo15,a.dscampo11,b.dscorreo as correocon from framecf_tblregistro_formularios a left join crmtblclientescontacto b on a.id=b.idcliente and b.id='$idcontacto'";
	$sql.=" where a.id=$idcliente";

	$result = $db->Execute($sql);
		if (!$result->EOF) {

		$dsnombre=$result->fields[0]." ".$result->fields[1];
		$dscorreo=$result->fields[2];

			if($result->fields[3])$dscorreo=$result->fields[3];
	}
	$result->Close();
	//$dscorreo="amunoz@comprandofacil.com";
	$asunto="Agendamiento actividad ".$autorizado;
	$cuerpo.="<font face='Arial' size=-1>Apreciado <strong> </strong>".$dsnombre." :<br><br>";
	$cuerpo.="$autorizado le envia la cita o actividad a realizar con usted el dia ";
	$cuerpo.=$partir[2]." de ".nombre_mes($partir[1])." de ".$partir[0];
	$cuerpo.=" a las ".$dshorai1." ";
	//$cuerpo.=" haga clic <a href='//$autorizado/gcomercial/modulos/agenda/agenda.imprimir.html.php?id=$iddetalle'>aqu&iacute;</a>";
	$cuerpo.="<br>==============================================================<br>";
	$cuerpo.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
	$cuerpo.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";

	if($dscorreo<>"")mail($dscorreo,$asunto,$cuerpo,$headers);
}
if($_REQUEST['idcomp']<>""){
	$sql="select idcotizar from tblvisitasactividades where id=".$_REQUEST['idcomp'];
	$result = $db->Execute($sql);
	if (!$result->EOF) {
		$idcotizarcomp=$result->fields[0];

	}
	$result->Close();
}
?>
<html>
<head>
	<title><? echo $AppNombre;?> Agendamiento</title>
	<!--link rel="stylesheet" type="text/css" href="../../incluidos/estilos.css"-->
	<link rel="stylesheet" href="<? echo $rutxx;?>../../css_modulos/style.agendamiento.css">

	<script language="javascript" src="../../../js_modulos/ajax.js"></script>


<?
include ($rutxx."../../incluidos_modulos/javageneral.php");
// cuando termine, recargar la pantalla anterior
if ($Mensaje<>""){
?>
<script language="JavaScript" type="text/javascript">
<!--
<? if ($dsfechax1<>"") { ?>
CargarPagina1('<? echo $rr;?>?dsfechax1=<? echo $dsfechax1;?>&idusuario=<? echo $idusuario;?>&enca=<? echo $enca;?>&Agendamiento=Agendamiento');

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
//include ($rutxx."../../incluidos_modulos/mensajes.indicadores.php");
?>
	<section class="cont_crm_opciones_agendamiento">

		<table width="100%" cellspacing="0" cellpadding="1" class=textnegro2 ID="Table2">
			<form action="<? echo $_SERVER['PHP_SELF'];?>" name="t3" method="post">
				<tr >
					<td valign=top align=center>
						<input type="button" name="enviar1" value="Cerrar Ventana"onClick="window.close();">
					</td>
				</tr>
			</form>
		</table>

		<? include ($rutxx."../../incluidos_modulos/resultoperaciones.php"); ?>
				<?
				//if ($opt==1 || $opt==2 || $opt==3){
				include ($rutxx."../../incluidos_modulos/func.innasocmed.php");
				//}
				?>
	<?
	//include ($rutxx."../../incluidos/inferior.php");
	?>

	</section>
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
	function mostrarcapax(capa,tipo,texto){
		if(document.getElementById(capa))document.getElementById(capa).style.display="";
		if(tipo==1){
			document.t1.idcliente.value="";
			document.t1.idcliente.value="";
			document.getElementById("titulo").innerHTML=texto;
			//document.getElementById("idformulario").value.text=form;
			//document.t1.idformulario.value=form;
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
