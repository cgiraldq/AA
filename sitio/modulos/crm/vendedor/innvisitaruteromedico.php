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
 Ingresar Visita por medico y ciclo y dia y semana y año
*/
include ("../sessiones.php");
include ("../../incluidos/creditos.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
$tabla="tblvisitasmedicos";
$idsemana=$_REQUEST['idsemana'];
if ($idsemana==""){
	$idsemana=$_REQUEST['idsemana'];
}
$idr=$_REQUEST['idr'];
if ($idr==""){
	$idr=$_REQUEST['idr'];
}
$iddian=$_REQUEST['iddian'];
if ($iddian==""){
	$iddian=$_REQUEST['iddian'];
}
$idanio=$_REQUEST['idanio'];
if ($idanio==""){
	$idanio=$_REQUEST['idanio'];
}
// variables parent
$idciclo=$_REQUEST['idciclo'];
if ($idciclo==""){
	$idciclo=$_REQUEST['idciclo'];
}
$idrdetalle=$_REQUEST['idrdetalle'];
if ($idrdetalle==""){
	$idrdetalle=$_REQUEST['idrdetalle'];
}

$dsnombre=$_REQUEST['dsnombre'];
if ($dsnombre==""){
	$dsnombre=$_REQUEST['dsnombre'];
}
// fin variables parent

if ($_REQUEST['inn']==1){
	$iddia=$_REQUEST['iddia'];
	$dshora=$_REQUEST['dshora'];	
	$dsfecha=date("d-m-Y h:i:s");
	$idfecha=date("dmY");
	$dsdesc=$_REQUEST['dsdesc'];
	$idtipohora=$_REQUEST['idtipohora'];		
	
	$strSQL=" select id from ".$tabla." where idruterodetalle=".$idrdetalle;
	$strSQL.=" and dshora='".$dshora."'";
	$strSQL.=" and iddia=".$iddia;
	$strSQL.=" and idciclo=".$idciclo;
	$vermas=mysql_db_query($dbase,$strSQL,$db);
	$num=mysql_num_rows($vermas);
	if ($num==1){
		$Mensaje="La visita que intenta ingresar ya esta creada";			
		$val=1;
	} else {
		$strSQL="insert into ".$tabla;
		$strSQL.=" (";
		$strSQL.=" id,idruterodetalle,iddia,dshora,idtipohora,idciclo,dsdesc";
		$strSQL.=" ,dsfecha,idfecha";
		$strSQL.=" )";
		$strSQL.=" values (";
		$strSQL.=" '',$idrdetalle,$iddia,'$dshora',$idtipohora,$idciclo,'$dsdesc',";
		$strSQL.=" '$dsfecha',$idfecha";
		$strSQL.=" )";
		//echo $strSQL;
		//exit();
		@mysql_db_query($dbase,$strSQL,$db);
		$Mensaje="Visita ingresada con éxito al sistema.";			
	}
	@mysql_free_result($vermas);

	} // fin inn

if ($_REQUEST['enviar']=="Actualizar"){
	$idestado=$_REQUEST['iddia'];
	$idestado=$_REQUEST['idestado'];
	$strSQL="update $tabla set ";
	$strSQL.=" idestado=".$idestado;
	$strSQL.=" where id=".$idvisita;
	@mysql_db_query($dbase,$strSQL,$db);
	$Mensaje="Visita actualizada en su estado con éxito.";
}

// validaciones de datos
	$mensajeData="Ingresando visita al medico ". $dsnombre;
?>
<html>
<head>

	<title><? echo $AppNombre;?> Configuraciones: Ingresando visitas (Paso 3 de 3)</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilos.css">	
<? include ("../../incluidos/javageneral.php"); ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
     // validacion acceso
    function valI(){
	if (document.u.iddia.value==""){
			alert("<? echo $AppNombre;?>: Por favor seleccione el día de la visita para el ciclo seleccionado.");
			document.u.iddia.focus();
			return;
     }

	if (document.u.dshora.value==""){
			alert("<? echo $AppNombre;?>: Por favor ingrese la hora de la visita.");
			document.u.dshora.focus();
			return;
     }

	 
	     document.u.submit();
	  }
//-->
</SCRIPT>

</head>
<body color=#ffffff  topmargin=0 leftmargin=1>
	<table width=100% align=center  cellpadding=4 cellspacing=0>
		<tr align=left >
<td valign=top colspan=2 bgcolor="<? echo $fondos[3];?>" class="textnegrotit"> <? echo $mensajeData;?></td>
		</tr>
	</table>
<? include ("../../incluidos/resultoperaciones.php"); ?>		
		<table width=100% align=center  cellpadding=4 cellspacing=0 style="border-bottom:<? echo $fondos[20];?>">
		<form action="<? echo $pagina;?>" method=post name=u>
		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			Seleccione día de la visita dentro del ciclo <? echo $idciclo;?>
			(mes <? echo nombre_mes($idciclo);?>)
		</td>
		<td valign=top>
			<select name="iddia" class="text1">
				<option value="">--</option>
				<? for ($i=1;$i<=(UltimoDia(date("Y"),$idciclo));$i++){?>
					<option value="<? echo $i;?>"><? echo $i;?></option>
				<? } ?>
			</select>
		</td>
		<td valign=top class=textnegro2>
			Hora de visita (Formato HH:MM. Ejemplo: <? echo date("i:m")?>)
		</td>
		
			<td valign=top>
		<input type="text" name="dshora" class="text1" size=5 maxlength="5" value="<? echo $dshora;?>">
			
			<select name="idtipohora" class="text1">
					<option value="1" <? if ($idtipohora==1){ echo "SELECTED";}?>>A.M</option>
					<option value="2" <? if ($idtipohora==2){ echo "SELECTED";}?>>P.M</option>
			</select>
		</td>
		</tr>
		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			Descripción Visita:
		</td>
		<td valign=top colspan="3">
			<textarea name=dsdesc cols="80" rows="2" class="text1"><? echo $dsdesc;?></textarea>
		</td>
		</tr>
		<tr bgcolor="<? echo $fondos[12];?>" align=center>
			<td valign=top colspan="4">
			<input type=button name=enviar value="Ingresar" class=formabot onClick="valI();">
			<input type=button name=enviar value="Cerrar" class=formabot onClick="CargarPagina('detalleruteromedico.php?idr=<? echo $idr;?>&iddian=<? echo $iddian;?>&idsemana=<? echo $idsemana;?>&idanio=<? echo $idanio;?>');">
			<input type=hidden name=inn value="1">
			<input type=hidden name=iddian value="<? echo $iddian;?>">
			<input type=hidden name=idsemana value="<? echo $idsemana;?>">
			<input type=hidden name=idanio value="<? echo $idanio;?>">
			<input type=hidden name=idr value="<? echo $idr;?>">
			<input type=hidden name=idrdetalle value="<? echo $idrdetalle;?>">
			<input type=hidden name=dsnombre value="<? echo $dsnombre;?>">
			<input type=hidden name=idciclo value="<? echo $idciclo;?>">
			</td>
		</tr>
		</form>
	</table>
<?
$strSQL="select * ";
$strSQL.=" from tblvisitasmedicos ";
$strSQL.=" where ";
$strSQL.=" idciclo=".$idciclo;
$strSQL.=" and idruterodetalle=".$idrdetalle;
$strSQL.=" order by iddia,dshora ASC";
?>

<? // pintando cabecera de datos
	$vermas=mysql_db_query($dbase,$strSQL,$db);
?>
			<table width=100% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed;">
			<tr class=textnegro2 bgcolor="<? echo $fondos[12];?>" align="center">
			<td  width="5%"><strong>Día</strong></td>
			<td  width="10%"><strong>Hora</strong></td>			
			<td ><strong>Descripción</strong></td>
			<td ><strong>Estado</strong></td>
			<td ><strong>Opinión del superior</strong></td>
			<td ><strong>Opciones</strong></td>
			</tr>
			
				</table>
		<? 
		if (mysql_affected_rows()>0){
			while($fila=mysql_fetch_object($vermas)) {
					ob_start(); 
					?>
					<table width=100% align=center  cellpadding=2 cellspacing=1  style="table-layout:fixed;">
					<form action="<? echo $pagina;?>" method=post name=u1>
					<tr class=textnegro2  bgcolor="<? echo $fondos[4];?>" align="center">		
					<td align="center" width="5%"><? echo $fila->iddia;?></td>					
					<td width="10%"><? echo $fila->dshora;?> 
					<?
					if ($fila->idtipohora) { 
						echo "A.M";
					} else {
						echo "P.M";
					}	
					?>
					</td>
					<td align="left"><? echo $fila->dsdesc;?></td>
					<td>
					<? if ($fila->idestado==0 || $fila->idestado==""){?>
					<select name=idestado class="text1">
						<option value="0">--</option>
						<? combosestadosvisitas($fila->idestado);?>
					</select>
					<? } else { ?>
						<? echo seldato("dsev","idev","tblestadosvisitas",$fila->idestado,1);?>
					<? } ?>
					</td>
					<td align="left"><? echo $fila->dseval;?></td>
					<td>
					<? if ($fila->idestado==0 || $fila->idestado==""){?>
					<input type=submit name=enviar value="Actualizar" class="text1">
					<input type=hidden name=iddian value="<? echo $iddian;?>">
					<input type=hidden name=idsemana value="<? echo $idsemana;?>">
					<input type=hidden name=idanio value="<? echo $idanio;?>">
					<input type=hidden name=idr value="<? echo $idr;?>">
					<input type=hidden name=idrdetalle value="<? echo $idrdetalle;?>">
					<input type=hidden name=dsnombre value="<? echo $dsnombre;?>">
					<input type=hidden name=idciclo value="<? echo $idciclo;?>">	
					<input type=hidden name=idvisita value="<? echo $fila->id;?>">	
					<a href="<? echo $_SERVER['PHP_SELF'];?>?idvisita=<? echo $fila->id;?>&idr=<? echo $idr;?>&iddian=<? echo $iddian;?>&idsemana=<? echo $idsemana;?>&idanio=<? echo $idanio;?>&del=1" title="Eliminar esta visita. Si es evaluado por usted no se podrá eliminar">Eliminar</a></td>
					<? } else {?>
						<strong>EVALUADO</strong>
					<? } ?>
					</tr>
					</form>
					</table>
					<?
					ob_end_flush(); 	
				} // fin while
		} // fin si 
		?>
<br>
	
<? include ("../../incluidos/inferior.php"); ?>
<? include ("../../incluidos/cerrarconexion.php"); ?>
</body>
</html>
