<?
/*
CF-INFORMER
ADMINISTRADOR DE CONTENIDOS

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
 Validacion de datos al ingresar y manejo de perfiles
*/
session_start();
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/class.rc4crypt.php");
$login=trim($_REQUEST['l']);
$clave=trim($_REQUEST['c']);
$idempresa=$_REQUEST['idempresa'];
$rc4 = new rc4crypt();
$clavee = $rc4->encrypt($s3m1ll4, $clave);
$clave = urlencode($clavee);
		// ACCESO SUPER ROOT
		// cargar el super root
		$sql="select idadmon,dsnombre,dslogin ";
	 	$sql.=" from tblsuperadmon WHERE dslogin='$login' and dsclave='$clave' ";
		//echo $sql;
	 	//exit();
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 while (!$result->EOF) {
		  	$idadmon=$result->fields[0];
			$dsnombre=$result->fields[1];
			$dslogin=$result->fields[2];
			$result->MoveNext();
		 }
		 $result->close();


			$_SESSION['i_idusuario']= $idadmon;
			$_SESSION['i_idperfil']= "-1";
			$_SESSION['i_dsnombre'] = $dsnombre;
			$_SESSION['i_dslogin'] = $dslogin;
			$_SESSION['i_idempresa'] = $idadmon;
			$_SESSION['i_dsempresa']="Root sistema";
			$tipo=-1;
		} else {
			// administrador
			$sql="select id,dsnombre,dslogin ";
		 	$sql.=" from tblempresa WHERE dslogin='$login' and dsclave='$clave' ";

			 $result = $db->Execute($sql);
			 if (!$result->EOF) {
			 while (!$result->EOF) {
				$id=$result->fields[0];
				$dsnombre=$result->fields[1];
				$dslogin=$result->fields[2];
				$result->MoveNext();
			 }
			 $result->close();
			 $_SESSION['i_idusuario']= $id;
			 $_SESSION['i_idperfil']= "1";
			 $_SESSION['i_dsnombre'] = $dsnombre;
			 $_SESSION['i_dslogin'] = $dslogin;
			 $_SESSION['i_idempresa'] = $id;
			 $_SESSION['i_dsempresa']="Empresa Autorizada";

			 $tipo=1;
			} else { //usuarios finales
			$sql="select id,dsm,dslogin ";
		 	$sql.=" from tblusuarios WHERE dslogin='$login' and dsclave='$clave' ";
			//echo $sql;
			//exit();
			 $result = $db->Execute($sql);
			 if (!$result->EOF) {
			 while (!$result->EOF) {
				$id=$result->fields[0];
				$dsnombre=$result->fields[1];
				$dslogin=$result->fields[2];
				$idhab=$result->fields[3];
				$idhab2=$result->fields[4];
				$result->MoveNext();
			 }
			 $result->close();
			 $_SESSION['i_idusuario']= $id;
			 $_SESSION['i_idperfil']= "4";
			 $_SESSION['i_dsnombre'] = $dsnombre;
			 $_SESSION['i_dslogin'] = $dslogin;
			 $_SESSION['i_idempresa'] = $id;
			 $_SESSION['i_dsempresa']="Empresa Autorizada";
			 $_SESSION['i_idhab']=$idhab;
			 $_SESSION['i_idhab2']=$idhab2;
			 $tipo=1;
			}
			}
			// demo
		}
/*
$sql="select idempresa,dsnombre,dscorreo1,dslogin, ";
$sql.=" dsclave,idactivo,idperfil,idfpago,idtipo ";
$sql.=" from tblempresa WHERE dslogin='$login' and idactivo in (1,3) and dsclave='$clave'";
//  echo $sql;
// exit();
$ssql=mysql_db_query($dbase,$sql,$db);
if (mysql_num_rows($ssql) == 1){
	// carga de variables de session
	session_register("i_idempresa");
	session_register("i_idusuario");
	session_register("i_idperfil");
	session_register("i_dsnombre");
	session_register("i_dslogin");
	session_register("i_idactivo");
	session_register("i_dscorreo1");
	session_register("i_idperfil");
	session_register("i_idcad");
	session_register("i_dias");
	session_register("i_idinn");
	session_register("i_idmod");
	session_register("i_iddel");
	session_register("i_dslogo");
	session_register("i_dsempresa");
	session_register("i_reg");
	session_register("i_idavi");
	session_register("i_dsclave");
	session_register("i_idfpago");
	session_register("i_idtipo");

	list($idempresa, $dsnombre,$dscorreo1,$dslogin,$dsclave,$idactivo,$idperfil,$idfpago,$idtipo) = mysql_fetch_row($ssql);
	$_SESSION['i_idempresa'] = $idempresa;
	$_SESSION['i_dsnombre'] = $dsnombre;
	$_SESSION['i_idactivo'] = $idactivo;
	$_SESSION['i_idperfil'] = $idperfil;
	$_SESSION['i_dscorreo1'] = $dscorreo1;
	$_SESSION['i_dslogin'] = $dslogin;
	$_SESSION['i_idinn'] = 1;
	$_SESSION['i_idmod'] = 1;
	$_SESSION['i_iddel'] = 1;
	$_SESSION['i_dslogo']=$idempresa;
	$_SESSION['i_dsempresa']=seldato("dsnombre","idempresa","tblempresa",$idempresa,1);
	$_SESSION['i_idperfil']=$perfil[0];
	$_SESSION['i_dsclave']=$_REQUEST['c'];
	$_SESSION['i_idfpago']=$idfpago;
	$_SESSION['i_idtipo']=$idtipo;
	$_SESSION['i_reg']="../administrador/default.php"; // variable que controla el regreso al core
	$valido="SI";
	$_SESSION['i_idusuario']=99999;
}else{
	mysql_free_result ($ssql);
	// consultar perfiles internos de la empresa
	$sql="select a.id,a.dsnombre,a.dslogin, ";
	$sql.=" a.dsclave,a.idtipo,a.idempresa,b.idtipo as tipoempresa";
 	$sql.=" from tblusuariose a, tblempresa b ";
	$sql.=" WHERE a.idempresa=b.idempresa and a.dslogin='$login' and a.idactivo not in (2) and a.dsclave='$clave'";
//	echo $sql;
//	exit();
	$ssql=mysql_db_query($dbase,$sql,$db);
	if (mysql_num_rows($ssql) == 1){
		session_register("i_idusuario");
		session_register("i_idperfil");
		session_register("i_dsnombre");
		session_register("i_dslogin");
		session_register("i_idactivo");
		session_register("i_idperfil");
		session_register("i_reg");
		session_register("i_idempresa");
		session_register("i_dsempresa");
		session_register("i_dslogo");
		session_register("i_dscorreoadmon");
		session_register("i_idvcliente");
		session_register("i_idfpago");
		session_register("i_idadmon");

		session_register("i_idtipoagente");
		session_register("i_idagente");
		session_register("i_idtipo");

		list($id, $dsnombre,$dslogin,$dsclave,$idtipo,$idempresa,$tipoempresa) = mysql_fetch_row($ssql);
		$_SESSION['i_idusuario']= $id;
		$_SESSION['i_dsnombre'] = $dsnombre;
		$_SESSION['i_dslogin'] = $dslogin;
		$_SESSION['i_idactivo'] = $idactivo;
		$_SESSION['i_idempresa']=$idempresa;
		$_SESSION['i_dslogo']=$idempresa;
		$_SESSION['i_dsempresa']=seldato("dsnombre","idempresa","tblempresa",$idempresa,1);
		$_SESSION['i_idfpago']=seldato("idfpago","idempresa","tblempresa",$idempresa,1);
		$valido="SI";
		$_SESSION['i_idperfil']=$idtipo; // variable que controla el acceso al core
		$_SESSION['i_idtipo']=$tipoempresa;
		$_SESSION['i_tipor']=$idr; // variable que controla el acceso al reporte
		$_SESSION['i_reg']="../administrador/default.php"; // variable que controla el regreso al core
		$_SESSION['i_dscorreoadmon'] = seldato("dscorreo1","idempresa","tblempresa",$idempresa,1);

		$_SESSION['i_idtipoagente']=0;
		$_SESSION['i_idagente'] =0;
		// aviso de correo al administrador
		$_SESSION['i_idvcliente']=1; // multiples visitas en el ciclo
		$_SESSION['i_dsclave']=$_REQUEST['c'];
		$_SESSION['i_idadmon']=0;
	} else {
		mysql_free_result ($ssql);
		// cargar el super root
		$sql="select idadmon,dsnombre,dslogin ";
	 	$sql.=" from tblsuperadmon WHERE dslogin='$login' and dsclave='$clave' ";
		$ssql=mysql_db_query($dbase,$sql,$db);
		if (mysql_num_rows($ssql) == 1){
			session_register("i_idusuario");
			session_register("i_idempresa");
			session_register("i_idperfil");
			session_register("i_dsnombre");
			session_register("i_dslogin");
			session_register("i_reg");
			session_register("i_idadmon");
			session_register("i_idtipoagente");
			session_register("i_idagente");

			list($idadmon, $dsnombre,$dslogin) = mysql_fetch_row($ssql);
			$_SESSION['i_idusuario']= $idadmon;
			$_SESSION['i_idperfil']= "-1";
			$_SESSION['i_dsnombre'] = $dsnombre;
			$_SESSION['i_dslogin'] = $dslogin;
			$_SESSION['i_idempresa'] = $idadmon;
			$_SESSION['i_dsempresa']=" Root sistema webcenter";
			$_SESSION['i_idadmon']=0;
			$_SESSION['i_idtipoagente']=0;
			$_SESSION['i_idagente'] =0;
			$valido="SI";
			$_SESSION['i_reg']="../superadmon/default.php"; // variable que controla el regreso al core
			$_SESSION['i_dsclave']=$_REQUEST['c'];
		} else {
			// acceso  a los agentes del sistema
			mysql_free_result ($ssql);
			$sql="select a.idexp,a.ds as agente,b.id,b.dsnombre,b.dscod,b.idagente,b.idactivo as idtipo ";
			$sql.=",a.idactivo as idtipoagente";
			$sql.=" from tblpaqueteo_agentes a,tblpaqueteo_agentes_usuarios b";
			$sql.=" WHERE b.dslogin='$login' and b.dsclave='$clave'";
			$sql.=" and a.id=b.idagente and b.idactivo not in (2) ";
//			echo $sql;
//			exit();
			$ssql=mysql_db_query($dbase,$sql,$db);
			if (mysql_num_rows($ssql) == 1){
				session_register("i_idusuario");
				session_register("i_idempresa");
				session_register("i_idagente");
				session_register("i_idtipoagente");
				session_register("i_dsnombre");
				session_register("i_dslogin");
				session_register("i_idadmon");
				session_register("i_idtipo");
				session_register("i_idtipoagente");
				session_register("i_idactivo");
				list($idexp,$agente,$id,$dsnombre,$dscod,$idagente,$idtipo,$idtipoagente) = mysql_fetch_row($ssql);
				$_SESSION['i_idusuario']= $id;
				$_SESSION['i_idperfil']= 99; // tipo agentes de paqueteo
				$_SESSION['i_dsnombre'] = $dsnombre;
				$_SESSION['i_dslogin'] = $dslogin;
				$_SESSION['i_idempresa'] = $idexp;
				$_SESSION['i_idagente'] = $idagente;
				$_SESSION['i_dsempresa']=$agente;
				$_SESSION['i_idadmon']=1;
				$_SESSION['i_idtipoagente']=$idtipoagente;
				$_SESSION['i_idtipo']=2; // tipo paqueteo
				$_SESSION['i_idactivo']=$idtipo; // tipo paqueteo
				$valido="SI";
				$_SESSION['i_reg']="../administrador/default.php"; // variable que controla el regreso al core
				$_SESSION['i_dsclave']=$_REQUEST['c'];
			} else {
				mysql_free_result ($ssql);
				$valido="NO";
				$error=2;
			}
		}
	}
}
*/
include("../../incluidos_modulos/cerrarconexion.php");
//exit();
?>
<html>
<head>
<title><? echo $AppNombre;?></title>
<script language="javascript">
<!--
<?
// redireccionadores
if ($tipo==-1)  $ruta="../root/default.php";
if ($tipo==1)  $ruta="../core/default.php";
if ($tipo==0)  $ruta="../admon/default.php?mensaje=1";
?>
location.href="<? echo $ruta?>";
//-->
</script>
?>
</head>
<body color=#ffffff  topmargin=10 leftmargin=0 class=text1></body></html>