<?
/*
| ----------------------------------------------------------------- |
-SISTEMA INTEGRADO DE GESTION  E INFORMACION ADMINISTRATIVA-
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2010
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando FernÃƒÂ¡ndez <consultorweb@comprandofacil.com>
  Juan Felipe SÃƒÂ¡nchez <graficoweb@comprandofacil.com>
  JosÃƒÂ© Fernando PeÃƒÂ±a <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- | 
 Ingresar datos
*/
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
$rc4 = new rc4crypt();
$tabla="tblresoluciones";
	// variables de carga
	$dsres=$_REQUEST['dsres'];
	$idconsecini=$_REQUEST['idconsecini'];
	$idconsecfin=$_REQUEST['idconsecfin'];
	$dsnit=$_REQUEST['dsnit'];
	$idciudad=$_REQUEST['idciudad'];
	$dsnombre=$_REQUEST['dsnombre'];
	$dsdir=$_REQUEST['dsdir'];
	$dstel=$_REQUEST['dstel'];
	$idactivo=$_REQUEST['idactivo'];
	
	$dsdescx=$_REQUEST['dsdescx'];
	$dsfechax=$_REQUEST['dsfechax'];
	$dsprefijo=$_REQUEST['dsprefijo'];

	
	
	$mensajeData="Ingresando una resolucion al sistema";
	if ($_REQUEST['inn']==1){
		$strSQL=" select id from ".$tabla." where ";
		$strSQL.=" dsres ='$dsres' and idconsecini=$idconsecini and idconsecfin=$idconsecfin ";
		
		$vermas=$db->Execute($strSQL);
		if (!$vermas->EOF) {
			$val=1;
		} else {
			$strSQL="insert into ".$tabla;
			$strSQL.="  (";
			$strSQL.=" id,dsres,idconsecini,idconsecfin,dsciudad,dsnombre,dsnit,dsdir,dstel,dsfecha,dsdesc,idactivo,dsprefijo";	
			$strSQL.=" )";
			$strSQL.="  values (";
			$strSQL.="0,'$dsres',$idconsecini,$idconsecfin,'$dsciudad','$dsnombre','$dsnit','$dsdir','$dstel','$dsfechax','$dsdescx',1,'$dsprefijo'";					
			$strSQL.=" )";
			//echo $strSQL;
			//exit();
			if ($db->Execute($strSQL)) { 
				 $val=2;
				//////////////////////////////////////////////			
				// si es multiple, generarlo aca
			} else { // fin si ingreso con ÃƒÂ©xito			
				$val=1;
			}
		}
		$vermas->Close();
	}	

// Mensajes de resultado
if ($val==1) { 
	// no iongresa
		$Mensaje="Los Datos no pueden ser ingresados en el sistema ya que se encuentran registrado para otro concepto. Verifique los datos:<br>".mysql_error();
} elseif ($val==2) { 
	// ingresa
		$Mensaje="Datos ingresados en el sistema para (".$_REQUEST['name']."). Presione 'Cerrar' para recargar los datos.";
}
//$fac=$_REQUEST['fac'];
$rutax=$_REQUEST['rutax'];
?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
     // validacion acceso
     function valU()
     {
     	if (document.u.dsres.value==""){
			alert("Por favor ingrese la resolucion");
			document.u.dsres.focus();
			return; 			
		}

		
		document.u.submit();
	}
	//-->
</SCRIPT>

</head>
<body color=#ffffff  topmargin=0 leftmargin=1>
	<table width="100%" cellpadding="0" cellspacing="0" align="center"  class="cont_general">
		<tr>
			<td aling=center>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
        <tr>
        <td width="615" align="left" valign="middle">
        <img src="../../../img_modulos/modulos/edicion.png">
        <h1>LISTADO DE RESOLUCION</h1>
        </td>
        </tr>
		</table>
		</td></tr>
		<tr><td>
		<table width=80% align=center  cellpadding=4 cellspacing=1 bgcolor="#CCCCCC" class="textbold" style="border-bottom:<? echo $fondos[20];?>">
				
		<form action="<? echo $pagina;?>" method=post name=u>
				<tr bgcolor="<? echo $fondos[4];?>" align=center>
			<td colspan=4 valign=top bgcolor="#FFFFFF" class="link_negro1">
			&nbsp;<? if ($fac<>""){?>
				<? } else {?>
			&nbsp;</td>
			<? }?>
		</tr>
		
		<tr bgcolor="<? echo $fondos[4];?>" align="center">
		<td valign=top class="link_negro1"bgcolor="#FFFFFF" >Resolucion</td>
		<td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
				<input type="text" name="dsres" class="link_negro1" value="<? echo $dsres;?>" maxlength="20" size="20"></td>
		</tr>
	
		<tr bgcolor="<? echo $fondos[4];?>" align="center">
		<td valign=top class="link_negro1"bgcolor="#FFFFFF" >Desde</td>
		<td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
		<input type="text" name="idconsecini" class="link_negro1" value="<? echo $idconsecini;?>" maxlength="9" size="9"></td>
		</tr>


		<tr bgcolor="<? echo $fondos[4];?>" align="center">
		<td valign=top class="link_negro1"bgcolor="#FFFFFF" >Hasta</td>
		<td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
		<input type="text" name="idconsecfin" class="link_negro1" value="<? echo $idconsecfin;?>" maxlength="9" size="9"></td>
		</tr>
		
		<tr bgcolor="<? echo $fondos[4];?>" align="center">
		<td valign=top class="link_negro1"bgcolor="#FFFFFF" >Fecha de resolucion</td>
		<td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
				<input type="text" name="dsfechax" class="link_negro1" value="<? echo $dsfechax;?>" maxlength="20" size="20"></td>
		</tr>

	<tr bgcolor="<? echo $fondos[4];?>" align="center">
		<td valign=top class="link_negro1"bgcolor="#FFFFFF" >Descripcion de la factura</td>
		<td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
				<textarea name="dsdescx" class="link_negro1" cols="50" rows="6"><? echo $dsdescx;?></textarea> </td>
		</tr>



		
			<tr bgcolor="<? echo $fondos[4];?>" align="center">
		<td valign=top class="link_negro1"bgcolor="#FFFFFF" >NIT</td>
		<td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
				<input type="text" name="dsnit" class="link_negro1" value="<? echo $dsnit;?>" maxlength="20" size="20"></td>
		</tr>
		
		<tr bgcolor="<? echo $fondos[4];?>" align="center">
		<td valign=top class="link_negro1"bgcolor="#FFFFFF" >Ciudad</td>
		<td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
		<input type="text" name="dsciudad" class="link_negro1" value="<? echo $dsciudad;?>" maxlength="255" size="30">
				</td>
		</tr>
	
	<tr bgcolor="<? echo $fondos[4];?>" align="center">
		<td valign=top class="link_negro1"bgcolor="#FFFFFF" >Nombre que aparece en la resolucion</td>
		<td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
				<input type="text" name="dsnombre" class="link_negro1" value="<? echo $dsnombre;?>" maxlength="150" size="35"></td>
		</tr>

<tr bgcolor="<? echo $fondos[4];?>" align="center">
		<td valign=top class="link_negro1"bgcolor="#FFFFFF" >Direccion que aparece en la resolucion</td>
		<td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
				<input type="text" name="dsdir" class="link_negro1" value="<? echo $dsdir;?>" maxlength="150" size="35"></td>
		</tr>


<tr bgcolor="<? echo $fondos[4];?>" align="center">
		<td valign=top class="link_negro1"bgcolor="#FFFFFF" >Telefono que aparece en la resolucion</td>
		<td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
				<input type="text" name="dstel" class="link_negro1" value="<? echo $dstel;?>" maxlength="150" size="35"></td>
		</tr>


<tr bgcolor="<? echo $fondos[4];?>" align="center">
		<td valign=top class="link_negro1"bgcolor="#FFFFFF" >Prefijo que aparece en la resolucion</td>
		<td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
				<input type="text" name="dsprefijo" class="link_negro1" value="<? echo $dsprefijo;?>" maxlength="4" size="5"></td>
		</tr>


	
		<tr bgcolor="<? echo $fondos[4];?>" align=center>
			<td colspan=4 valign=top bgcolor="#FFFFFF" class="link_negro1">
			<input type="button" name=enviar value="Ingresar" class="formbt2" onclick="valU()">
			<? if ($fac<>""){?>
				<input type=button name=enviar value="Cerrar" class="formbt2" onClick="window.close()" >
			<? } else {?>
				<input type=button name=enviar value="Cerrar" class="formbt2" onClick="CargarPagina('../concecutivos/default.php');" >
			<? } ?>
			&nbsp;<input type=hidden name=inn value="1">
					</td>
		</tr>
		</form>
</table>
</td></tr>
</table>
<br>
<?include ($rutxx."../../incluidos_modulos/cerrarconexion.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");
include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");?>
</body>
</html>
