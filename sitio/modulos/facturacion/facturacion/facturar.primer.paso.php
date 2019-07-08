<?
/*
| ----------------------------------------------------------------- |
MEGAPINTURAS LTDA
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2008
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- | 
 Proceso inicial de facturacion
*/
include ("../sessiones.php");
include ("../../incluidos/creditos.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
include ("../../incluidos/class.rc4crypt.php");
$rc4 = new rc4crypt();
include ("../../incluidos/func.calendario_2.php"); // funcion nueva del calendario
$tabla="tblfacturase";
$ref=$_REQUEST['ref']; // id del cliente

// CONSECUTIVO BASE 
$idconsec=seldato("idconsec","idempresa","tblempresa",$_SESSION['i_idempresa'],1);

// proceso de refacturacion
if ($_REQUEST['inn']==1){
	// variables de carga
	$idcliente=$_REQUEST['idcliente']; // id del cliente
	$dsfechac=$_REQUEST['dsfechac'];// Fecha de creacion
	$partir=explode("/",$dsfechac);
	$idfechac=$partir[0].$partir[1].$partir[2];
	$idformapago=$_REQUEST['idformapago']; // nombre
	$dsfechav=$_REQUEST['dsfechav']; // fecha de vencimientos
	$partir=explode("/",$dsfechav);
	$idfechav=$partir[0].$partir[1].$partir[2];
//	$idfechav=$_REQUEST['idfechav']; //
	$idusuario=$_REQUEST['idusuario']; // id usuario
	$idpedido=$_REQUEST['idpedido']; //
	$dsfechad=$_REQUEST['dsfechad'];// Fecha de despacho
	$partir=explode("/",$dsfechad);
	$idfechad=$partir[0].$partir[1].$partir[2];
	
	$idactivo=0; // en proceso	
	
	// datos de cliente en caso de no estar en la base de datos
	$idciudad=$_REQUEST['idciudad']; // ciudad
	$dsnit=$_REQUEST['dsnit']; // nit
	$dsnombre=$_REQUEST['dsnombre']; // nombre
	$dscomercial=$_REQUEST['dscomercial']; // nombre comercial
	$dscontacto1=$_REQUEST['dscontacto1']; // contacto1
	$dsfcontacto1=$_REQUEST['dsfcontacto1']; // dsfcontacto1
	
	$dsobs=$_REQUEST['dsobs']; // observaciones
	$dsobsfinal=$_REQUEST['dsobsfinal']; // observaciones finales
	
	$dslogin=$_REQUEST['dsnit']; // login
	$clavee = $rc4->encrypt($s3m1ll4, $_REQUEST['dsnit']);
	$clave = urlencode($clavee); // clave
	$dstel=$_REQUEST['dstel']; // telefono
	$dsdir=$_REQUEST['dsdir']; // direccion oficina
	$idtipo=$_REQUEST['idtipo']; // redireccionador
	
	$idorden=$_REQUEST['idorden']; // orden de pedido
	
	// fin datos del cliente
}
// validaciones de datos
	$mensajeData="Paso 1. Ingresando datos generales de la factura";
	// armando vector de campos
	// insertando
	if ($_REQUEST['inn']==1){
	
	//  insertando el cliente
	if ($dsnit<>"" && $dstel<>"" && $idcliente==""){
		$strSQL=" select dsnombre from tblclientes where dsnit='$dsnit' ";
		$strSQL.=" and dsnombre='$dsnombre' and idempresa=".$_SESSION['i_idempresa'];
		//echo $strSQL;
		$vermas=mysql_db_query($dbase,$strSQL,$db);
		if (mysql_affected_rows()>0){
			// actualizar
			$val=1;
		} else {
			$strSQL="insert into tblclientes ";
			$strSQL.="  (";
			$strSQL.=" id,idempresa,dscodf,idciclo,idciudad,dsnit";
			$strSQL.=" ,dsnombre,dscomercial,dslogin,dsclave";
			$strSQL.=" ,dstel,dsdir";
			$strSQL.=" ,dsbarrio,dscel,dsfax,dswb";
			$strSQL.=" ,dscorreo,dscorreo2,dscom,dshoravisita";
			$strSQL.=" ,idtipocliente,idorigencliente,dscontacto1,dscontacto2";
			$strSQL.=" ,dsfcontacto1,dsfcontacto2,dsaniver";
			$strSQL.=" ,idactivo,idusuario,idusuariootro";
			$strSQL.=" ,dsfechaingreso,dsfechaingresonum";			
			$strSQL.=" )";
			$strSQL.="  values (";
			$strSQL.="'',".$_SESSION['i_idempresa'].",'$dscodf',0,$idciudad,'$dsnit',";
			$strSQL.="'$dsnombre','$dscomercial','$dslogin','$clave',";
			$strSQL.="'$dstel','$dsdir',";
			$strSQL.="'$dsbarrio','$dscel','$dsfax','$dswb',";
			$strSQL.="'$dscorreo','$dscorreo2','$dscom','$dshoravisita',";			
			$strSQL.=" 0,0,'$dscontacto1','$dscontacto2',";			
			$strSQL.=" '$dsfcontacto1','$dsfcontacto2','$dsaniver',";
			$strSQL.=" 1,$idusuario,0,";
			$strSQL.="'$fechaBase','$fechaBaseNum'";
			$strSQL.=" )";
			//echo $strSQL;
			//exit();
			if (mysql_db_query($dbase,$strSQL,$db)) { 
				$val=2;
				$strSQL=" select id from tblclientes where dsnit='$dsnit' ";
				$strSQL.=" and dsnombre='$dsnombre' and idempresa=".$_SESSION['i_idempresa'];
				//echo $strSQL;
				//exit();
				$vermas1=mysql_db_query($dbase,$strSQL,$db);
				if (mysql_num_rows($vermas1)>0){
					$idcliente=mysql_result($vermas1,"0","id");
				}
				mysql_free_result($vermas1);
			} // fin de mysql_db_query	
		}
		mysql_free_result($vermas);
	}
	// fin insertando el cliente
	
		$strSQL=" select idpedido from ".$tabla." where idpedido='$idpedido' ";
		//echo $strSQL;
		$vermas=mysql_db_query($dbase,$strSQL,$db);
		if (mysql_num_rows($vermas)>0){
			$val=1;
		} else {
			$strSQL="insert into ".$tabla;
			$strSQL.="  (";
			$strSQL.=" id,idpedido,idusuario,idcliente,dsfechac,idfechac";
			$strSQL.=" ,dsfechav,idfechav,idformapago,idactivo";
			$strSQL.=",dsobs,dsobsfinal,idusuariocreador";
			$strSQL.=",dsfechad,idfechad,idorden";
			$strSQL.=" )";
			$strSQL.="  values (";
			$strSQL.="'','$idpedido','$idusuario','$idcliente',";
			$strSQL.="'$dsfechac','$idfechac',";
			$strSQL.="'$dsfechav','$idfechav','$idformapago','$idactivo',";
			$strSQL.="'$dsobs','$dsobsfinal',".$_SESSION['i_idusuario'];
			$strSQL.=",'$dsfechad','$idfechad','$idorden'";
			$strSQL.=" )";
			//echo $strSQL;
			//exit();
			if (mysql_db_query($dbase,$strSQL,$db)) { 
				 $val=2;
			} else { // fin si ingreso con éxito			
				$val=1;
			}
		}
		mysql_free_result($vermas);
	}	


if ($_REQUEST['inn']==2) { 
	$dsfechap=$_REQUEST['dsfechap'];// Fecha de creacion
	$dsobspago=$_REQUEST['dsobspago'];// Observaciones pago
	$partir=explode("/",$dsfechap);
	$idfechap=$partir[0].$partir[1].$partir[2];
	$sql="update $tabla set ";
	$sql.=" dsfechap='$dsfechap',idfechap=$idfechap,idactivo=3,dsobspago='$dsobspago'";	
	$sql.=" where idpedido=".$idpedido;
	//echo $sql;
	//exit();
	if (mysql_db_query($dbase,$sql,$db)) { 
		$val=4;
	} else { // fin si ingreso con éxito			
		$val=3;
	}
}
// Mensajes de resultado
if ($val==1) { 
	// no iongresa
	$Mensaje="La factura <strong>$idpedido</strong> ya existe en el sistema. Intente de nuevo";
}

if ($val==4) { 
	// no iongresa
	$Mensaje="La factura <strong>$idpedido</strong> se le agrego la fecha de pago y observaciones.";
}

// determinar en cque factura se encuentran
$mod=$_REQUEST['mod'];
if ($mod==1){
	$idcliente=$_REQUEST['idcliente'];
	$idpedido=$_REQUEST['idpedido'];
	$sql="select * from tblfacturase where idpedido=".$idpedido;
	$vermasx=mysql_db_query($dbase,$sql,$db);
	if (mysql_num_rows($vermasx)>0){
	$idpedidox=mysql_result($vermasx,"0","idpedido");
	$dsfechac=mysql_result($vermasx,"0","dsfechac");
	$dsfechav=mysql_result($vermasx,"0","dsfechav");
	$idusuario=mysql_result($vermasx,"0","idusuario");
	$idformapago=mysql_result($vermasx,"0","idformapago");
	$idplazo=mysql_result($vermasx,"0","idplazo");
	$idcontacto=mysql_result($vermasx,"0","dscontacto");
	$readonly="readonly";
	}
	mysql_free_result($vermasx);	
	$mensajeData="Agregando fecha de pago de la factura seleccionada";
} elseif ($ref=="1") {	 // refactura
	
	
	$idcliente=$_REQUEST['idcliente'];
	$idpedido=$_REQUEST['idpedido'];
	$sql="select * from tblfacturase where idpedido=".$idpedido;
	//echo $sql;
	//exit();
	$vermasx=mysql_db_query($dbase,$sql,$db);
	if (mysql_num_rows($vermasx)>0){
			
		$idpedidox1=mysql_result($vermasx,"0","idpedido");
		$dsfechac=date("Y/m/d"); // fecha actual
		$dsfechav=""; //fecha de vencimiento en blanco
		$idusuario=mysql_result($vermasx,"0","idusuario");
		$idformapago=mysql_result($vermasx,"0","idformapago");
		$idplazo=mysql_result($vermasx,"0","idplazo");
		$idcontacto=mysql_result($vermasx,"0","dscontacto");
		$idusuariox=mysql_result($vermasx,"0","idusuario");
		$dsobs=mysql_result($vermasx,"0","dsobs");
		$dsobsfinal=mysql_result($vermasx,"0","dsobsfinal");
	
		$readonly="";
		
		// 1. recalcular el idpedido
		$strSQL=" select max(idpedido) as t from ".$tabla." ";
		$vermasx=mysql_db_query($dbase,$strSQL,$db);
		
		if (mysql_num_rows($vermasx)>0){
		$idpedidox=mysql_result($vermasx,"0","t");
		if ($idpedidox==0) {
			 $idpedidox=$idconsec;
		}  else {
			$idpedidox=$idpedidox+1;
		}
		// $readonly="readonly";
		}
		mysql_free_result($vermasx);		
		// fin recalcular el idpedido
		// 2. extraer el cuerpo de la factura e insertarla con este nuevo idpedidox
		$sql="select * from tblfacturasc  where dspedido=".$idpedido;
		$vermasx=mysql_db_query($dbase,$sql,$db);
		if (mysql_num_rows($vermasx)>0){
			$r=0;
			$sql="delete from tblfacturasc where dspedido=".$idpedidox;
			while($filax=mysql_fetch_object($vermasx)) {
				$sql="insert into tblfacturasc values (";
				$sql.="'',$idpedidox,".$filax->idproducto;	
				$sql.=",".$filax->idproyecto;	
				$sql.=",'".$filax->idvalorproyecto."'";
				$sql.=",".$filax->idpos;
				$sql.=",".$filax->idcant;
				$sql.=",".$filax->idvalor1;
				$sql.=",".$filax->idvalor2;
				$sql.=",".$filax->idvalor3;
				$sql.=",".$filax->idimp;
				$sql.=",".$filax->iddesc;
				$sql.=")";
				//echo $sql."<br>";
				if (mysql_db_query($dbase,$sql,$db)) $r++;
			}
		}
		mysql_free_result($vermasx);
		//exit();
		if ($r<=0) die("Problemas al intentar refacturar pedido ($idpedido hacia $idpedidox)");
		// fin extraer el cuerpo de la factura e insertarla con este nuevo idpedidox
		
	}
} else { 
	$strSQL=" select max(idpedido) as t from ".$tabla;
	//echo $strSQL;
	$vermasx=mysql_db_query($dbase,$strSQL,$db);
	if (mysql_num_rows($vermasx)>0){
		$idpedidox=mysql_result($vermasx,"0","t");
		if ($idpedidox==0) {
			 $idpedidox=$idconsec;
		}  else {
			$idpedidox=$idpedidox+1;
		}
		$readonly="";
		}
	mysql_free_result($vermasx);	
	if ($_REQUEST['dsfechac']=="") $dsfechac=$fechaBase;
}	
?>
<html>
<head>
<title><? echo $AppNombre;?> Facturacion: Ingresando datos generales de la factura</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilos.css">	
<? include ("../../incluidos/javageneral.php"); ?>
<script language="javascript" src="../../incluidos/ajax.js"></script>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
<? if ($val==2){?>
location.href="facturar.segundo.paso.php?idpedido=<? echo $idpedido;?>&idcliente=<? echo $idcliente;?>&idusuariox=<? echo $idusuario;?>";
<? } ?>
     // validacion acceso
    function valI(){
	<? if ($mod=="") { ?>
	if (document.u.idpedido.value==""){
			alert("Por favor ingrese el numero de factura.");
			document.u.idpedido.focus();
			return false;
     }
	 
	 if (isNaN(document.u.idpedido.value)){
			alert("El numero de factura debe ser numerico.");
			document.u.idpedido.focus();
			return false;
     }
	 
	 if (document.u.idpedido.value<=0){
			alert("El numero de factura no puede ser menor o igual a cero.");
			document.u.idpedido.focus();
			return false;
     }
	 
	 	if (document.u.idorden.value==""){
			alert("Por favor ingrese la orden de pedido.");
			document.u.idorden.focus();
			return false;
     }
	 
	 if (isNaN(document.u.idorden.value)){
			alert("El numero de la orden de pedido debe ser numerico.");
			document.u.idorden.focus();
			return false;
     }
	 
	 if (document.u.idorden.value<=0){
			alert("El numero de la orden de pedido no puede ser menor o igual a cero.");
			document.u.idorden.focus();
			return false;
     }
	 
	 
	 
	 if (document.u.idcliente.value==""){
	 		dsnombre=document.u.dsnombre.value;
			dsnit=document.u.dsnit.value;
			dstel=document.u.dstel.value;
			dsdir=document.u.dsdir.value;
	 		if (dsnit==""){ 
				alert("Debe digitar el nit del nuevo cliente");
				document.u.dsnit.focus();
				return false;
			}
			
			if (dsnombre==""){ 
				alert("Debe digitar el nombre del nuevo cliente");
				document.u.dsnombre.focus();
				return false;
			}
			
			
	 		if (dstel==""){ 
				alert("Debe digitar el telefono del nuevo cliente");
				document.u.dstel.focus();
				return false;
			}
			
			if (dsdir==""){ 
				alert("Debe digitar la direccion del nuevo cliente");
				document.u.dsdir.focus();
				return false;
			}
     }
	
	if (document.u.dsfechac.value==""){
			alert("Por favor ingrese la fecha de creación");
			document.u.dsfechac.focus();
			return false;
     }
	
	if (document.u.dsfechav.value==""){
			alert("Por favor ingrese la fecha de vencimiento");
			document.u.dsfechav.focus();
			return false;
     }
	<? }  else { ?>
		if (document.u.dsfechap.value==""){
			alert("Por favor ingrese la fecha de pago");
			document.u.dsfechap.focus();
			return false;
       }
	   
	   	if (document.u.dsobspago.value==""){
			alert("Por favor ingrese las observaciones del pago");
			document.u.dsobspago.focus();
			return false;
       }
	   
	<? } ?>
	
	     return true;
  }
//-->
</SCRIPT>

</head>
<body color=#ffffff  topmargin=0 leftmargin=1>
<? include ("../../incluidos/encabezado.php");?>
	<table width=100% align=center  cellpadding=4 cellspacing=0>
		<tr align=left >
<td valign=top colspan=2 bgcolor="<? echo $fondos[3];?>" class="textnegrotit"> <? echo $mensajeData;?></td>
		</tr>
	</table>
<? include ("../../incluidos/resultoperaciones.php"); ?>	
		<table width=100% align=center  cellpadding=4 cellspacing=1 style="border-bottom:<? echo $fondos[20];?>" >
		<form action="<? echo $pagina;?>" method=post name=u onSubmit="return valI();">
				<tr bgcolor="<? echo $fondos[4];?>" align=center>
			<td valign=top colspan=4 class="forma2">
			<? if ($mod=="") { ?>
				<input type=SUBMIT name=enviar value="Ingresar" class=formabot1 >
			<? } else { ?>
				<input type=SUBMIT name=enviar value="Actualizar" class=formabot1 >
			<? } ?>
			  	<input type=button name=enviar value="Regresar" class=formabot1 onClick="irAPaginaD('default.php');">
<? if ($idpedido<>"" && $idcliente<>"") {?>				
						<input type=button name=enviar value="Ver factura" class=formabot1 onClick="irAPaginaD('facturar.cuarto.paso.php?idpedido=<? echo $idpedido;?>&idcliente=<? echo $idcliente;?>');">	
<? } ?>

				</td>
				
		</tr>
		<tr bgcolor="<? echo $fondos[4];?>" >
		<td valign=top class="forma2" colspan="2">
		Factura Numero <br>
<input type="text" name="idpedido" class="forma2"  value="<? echo $idpedidox;?>" maxlength="10" size="10" <? echo $readonly;?>>

<input type=button name=enviar value="Ver otras facturas" class=formabot1 onClick="irAPaginaDN('default.php?enca=1','','');" title="">


		</td>
		<td valign=top class="forma2" colspan="2">
		Orden de Pedido Nro.<br>
<input type="text" name="idorden" class="forma2"  value="<? echo $idorden;?>" maxlength="10" size="10">

		</td>
		</tr>		
		
		<tr bgcolor="<? echo $fondos[4];?>" >
		<td valign=top class="forma2" colspan="4">
		Seleccione cliente:
<br>
		<select name="idcliente" class="forma2">
		<option value="">...</option>
		<? combosclientesp($idcliente,$_SESSION['i_idempresa']);?>
		</select>

<input type=button name=enviar value="Ver los clientes" class=formabot1 onClick="javascript:irAPaginaDN('../clientes/default.php?enca=1','','');" title="">
			</td>
		</tr>
		
			<tr bgcolor="<? echo $fondos[4];?>" align=LEFT>
			<td valign=top colspan=4 class="forma2" bgcolor="#CCCCCC">
			<strong>SI EL CLIENTE NO SE ENCUENTRA EN EL LISTADO, POR FAVOR INGRESELO CON LOS CAMPOS QUE SE ENCUENTRAN A CONTINUACION</strong>
</td>
		</tr>
		
		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class="forma2" >C&eacute;dula o NIT * </td>
		<td valign=top class="forma2">			<input type="text" name="dsnit" class="forma2"  value="<? echo $dsnit;?>" maxlength="20">
			<?
				$ruta="../../incluidos/validarcedula.php?basecampo=dsnit&tabla=tblclientes&tipo=2&camporec=dsnit&datocampo=dsnombre";
				$forma="u";
				$valorbase="dsnit";
				$irAPaginaDNC="f3";
				include ("../../incluidos/nuevadatacedula.php");
				?></td>
		
		<td valign=top class="forma2" >Ciudad Asociado *</td>
		<td valign=top class="forma2">	<select name="idciudad" class="forma2" >
			<option value="0">----</option>
			<?
			combosciudades($idciudad,$_SESSION['i_idempresa']);			
			?>
				</select>	</td>
		</tr>

		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class="forma2" >Razon social * </td>
		<td valign=top class="forma2"><input type="text" name="dsnombre" class="forma2"  value="<? echo $dsnombre;?>" maxlength="150"></td>
		<td valign=top class="forma2" >Nombre Comercial</td>
		<td valign=top class="forma2"><input type="text" name="dscomercial" class="forma2"  value="<? echo $dscomercial;?>" maxlength="150"></td>
		</tr>

		
		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class="forma2" >
			Dirección	*	</td>
		<td valign=top class="forma2">
<input type="text" name="dsdir" class="forma2"  value="<? echo $dsdir;?>" maxlength="100">		</td>
		<td valign=top class="forma2"  bgcolor="<? echo $fondos[4];?>">
			Teléfono  *		</td>
		<td valign=top bgcolor="<? echo $fondos[4];?>" class="forma2">
		<input type="text" name="dstel" class="forma2"  value="<? echo $dstel;?>" maxlength="20">		</td>
		</tr>
		
			<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class="forma2" >
			Contacto 1	*	</td>
		<td valign=top class="forma2">
<input type="text" name="dscontacto1" class="forma2"  value="<? echo $dscontacto1;?>" maxlength="100">		</td>
		<td valign=top class="forma2"  bgcolor="<? echo $fondos[4];?>">
			Cumpleaños 1</td>
		<td valign=top bgcolor="<? echo $fondos[4];?>" class="forma2">
			<input type="text" name="dsfcontacto1" class="forma2"  value="<? echo $dsfcontacto1;?>" maxlength="10" size="10">
<img align="absmiddle" SRC="../../temas/iconos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfcontacto1', this);" language="javaScript">		</td>
		</tr>
		
		
		
			<tr bgcolor="<? echo $fondos[4];?>" align=LEFT>
			<td valign=top colspan=4 class="forma2" bgcolor="#CCCCCC">
			<strong>DATOS DE FACTURACION</strong>
</td>
		</tr>
		
		
			<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class="forma2" >
		Fecha de Creación	*</td>
		<td valign=top class="forma2">
		
		<input type="text" name="dsfechac" class="forma2"  value="<? echo $dsfechac;?>" maxlength="10" size="10">
<img align="absmiddle" SRC="../../temas/iconos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechac', this);" language="javaScript">			

</td>
		<td valign=top class="forma2"  bgcolor="<? echo $fondos[4];?>">	Fecha de vencimiento * </td>
		<td valign=top bgcolor="<? echo $fondos[4];?>" class="forma2">
		
		<input type="text" name="dsfechav" class="forma2"  value="<? echo $dsfechav;?>" maxlength="10" size="10">
<img align="absmiddle" SRC="../../temas/iconos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechav', this);" language="javaScript">	


			</td>
		</tr>
		
		
		<tr bgcolor="<? echo $fondos[4];?>">
		
			<td valign=top class="forma2"  bgcolor="<? echo $fondos[4];?>">	Fecha de despacho * </td>
		<td valign=top bgcolor="<? echo $fondos[4];?>" class="forma2">
		
		<input type="text" name="dsfechad" class="forma2"  value="<? echo $dsfechad;?>" maxlength="10" size="10">
<img align="absmiddle" SRC="../../temas/iconos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechad', this);" language="javaScript">	


			</td>
		
		<td valign=top class="forma2"  bgcolor="<? echo $fondos[4];?>">Forma de pago	</td>
		<td valign=top bgcolor="<? echo $fondos[4];?>" class="forma2" >
			<select name="idformapago" class="forma2">
			<option value="">....</option>
			<? combosfpagos($idformapago,$_SESSION['i_idempresa']);?>
			</select>
		</td>
		</tr>
		<? if ($mod<>"") { ?>
			<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class="forma2" >
		Fecha de Pago	*</td>
		<td valign=top class="forma2">
		
		<input type="text" name="dsfechap" class="forma2"  value="<? echo $dsfechap;?>" maxlength="10" size="10">
<img align="absmiddle" SRC="../../temas/iconos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechap', this);" language="javaScript">			

</td>
		<td valign=top class="forma2"  bgcolor="<? echo $fondos[4];?>">OBSERVACIONES DEL PAGO</td>
		<td valign=top bgcolor="<? echo $fondos[4];?>" class="forma2">
		<textarea name="dsobspago" class="forma2" cols="60" rows="4"><? echo $dsobspago;?></textarea>

		</td>
		</tr>
		
		<? } ?>
		
		
		<tr bgcolor="<? echo $fondos[4];?>" align=center>
			<td valign=top colspan=4 class="forma2">
			<? if ($mod=="") { ?>
				<input type=SUBMIT name=enviar value="Ingresar" class=formabot1 >
				<input type=hidden name=inn value="1">
			<? } else { ?>
				<input type=SUBMIT name=enviar value="Actualizar" class=formabot1 >
				<input type=hidden name=inn value="2">
				<input type=hidden name=idpedido value="<? echo $idpedido?>">
				<input type=hidden name=idcliente value="<? echo $idcliente?>">
				<input type=hidden name=mod value="<? echo $mod?>">
			<? } ?>
			<? if ($ref=="1") { ?>
				<input type=hidden name=dsobs value="<? echo $dsobs?>">
				<input type=hidden name=dsobsfinal value="<? echo $dsobsfinal;?>">
			<? } ?>
			
				<input type=button name=enviar value="Regresar" class=formabot1 onClick="irAPaginaD('default.php');">	
<? if ($idpedido<>"" && $idcliente<>"") {?>				
		<input type=button name=enviar value="Ver factura" class=formabot1 onClick="irAPaginaD('facturar.cuarto.paso.php?idpedido=<? echo $idpedido;?>&idcliente=<? echo $idcliente;?>');">	
<?  } ?>			
</td>
		</tr>
		</form>
	</table>
<br>

	
<? include ("../../incluidos/inferior.php"); ?>
<? include ("../../incluidos/cerrarconexion.php"); ?>
</body>
</html>
