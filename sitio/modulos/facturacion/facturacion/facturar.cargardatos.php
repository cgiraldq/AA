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
 Carga el ultimo numero de factura
*/
include ("../sessiones.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
$tabla="tblfacturase";
$dsprod=$_REQUEST['dsprod'];

$idpedido=$_REQUEST['idpedido'];
$sql=" select * from tblproductos where id=$dsprod order by dsp asc ";
echo $sql;
$vermas=mysql_db_query($dbase,$sql,$db);
if (mysql_num_rows($vermas)>0) { 
	$data="<table width=100% align=center  cellpadding=4 cellspacing=1 bgcolor=".$fondos[12]."  style='table-layout:fixed'>";
	$x=0;
	while($fila=mysql_fetch_object($vermas)) {
	$idvalor1=$fila->dsvalor1;
	$idvalor2=$fila->dsvalor2;
	$idvalor3=$fila->dsvalor3;
	$idvalor4=$fila->dsvalor4;
	$dsun1=$fila->dsun1;
	$dsun2=$fila->dsun2;
	$dsun3=$fila->dsun3;
	$dsun4=$fila->dsun4;
	$idimp=$fila->dsimp;
	
	// traer datos de la db
	$sql="select a.*, b.dsref";
	$sql.=" from tblfacturasc a,tblproductos b ";
	$sql.="  where a.dspedido='$idpedido' and a.idproducto=".$fila->id;;
	$sql.=" and b.id=a.idproducto order by dsref asc limit 0,1 ";
	//echo $sql;
	$vermasx=mysql_db_query($dbase,$sql,$db);
	if (mysql_num_rows($vermasx)>0) { 	
		$filax=mysql_fetch_object($vermasx);
		$dsunidad=$filax->dsunidad;
		$dsvalor=$filax->idvalor1;
		$dsdesc=$filax->dsdesc;
		$idimp=$filax->idimp;
		$iddesc=$filax->iddesc;
		$idcant=$filax->idcant;
		// subtotal
		
	} else { 
		$idcant=0;
		$dsdesc=$fila->dsp;
		$iddesc=0;
	}
	
	mysql_free_result($vermasx);	


	
	
	$data.="<tr class='text' bgcolor='".$fondos[3]."' align=center>";
	$data.="<td width='10%'>".$fila->dsref."</td>";
	
		$data.="<td><textarea name='dsdesc[]' class='forma2' cols='22' rows=5 id='dsdesc$dsprod'>".$dsdesc."</textarea></td>";


	$data.="<td><select name='dsunidad[]' class='forma2'  onChange='cambiar($dsprod)' id='dsunidad$dsprod'>";
	if ($dsun1==$dsunidad) $x1="selected";	
	if ($dsun2==$dsunidad) $x2="selected";
	if ($dsun3==$dsunidad) $x3="selected";
	if ($dsun4==$dsunidad) $x4="selected";
	
	$data.="<option value='$dsun1' $x1>".$dsun1."</option>";
	if ($dsun2<>"") $data.="<option value='$dsun2' $x2>".$dsun2."</option>";
	if ($dsun3<>"") $data.="<option value='$dsun3' $x3>".$dsun3."</option>";
	if ($dsun4<>"") $data.="<option value='$dsun4' $x4>".$dsun4."</option>";
	$data.="</select>";
	$data.="</td>";

	
	$data.="<td><select name='idvalor1[]' class='forma2' onChange='cambiar($dsprod)' id='idvalor1$dsprod'>";
	
	if ($idvalor1==$dsvalor) $x11="selected";	
	if ($idvalor2==$dsvalor) $x12="selected";
	if ($idvalor3==$dsvalor) $x13="selected";
	if ($idvalor4==$dsvalor) $x14="selected";
	
	$data.="<option value='$idvalor1' $x11>$ ".number_format($idvalor1,0)."</option>";
	if ($idvalor2<>"" && $idvalor2<>"0") $data.="<option value='$idvalor2' $x12>$ ".number_format($idvalor2,0)."</option>";
	if ($idvalor3<>"" && $idvalor3<>"0") $data.="<option value='$idvalor3' $x13>$ ".number_format($idvalor3,0)."</option>";
	if ($idvalor4<>"" && $idvalor4<>"0") $data.="<option value='$idvalor4' $x14>$ ".number_format($idvalor4,0)."</option>";
	$data.="</select>";
	$data.="</td>";
	
	
	$data.="<td width='8%'><input type='text' name='idcant[]' class='forma2' value='".$idcant."' size='4' maxlength=10 id='idcant$dsprod' onBlur='cambiar($dsprod)'></td>";
	
	

	$data.="<td width='10%'><input type='text' name='idimp[]' class='forma2' value='".$idimp."' size='3' maxlength=3 id='idimp$dsprod' onBlur='cambiar($dsprod)'></td>";
	
	$data.="<td width='10%'><input type='text' name='iddesc[]' class='forma2' value='".$iddesc."' size='10' maxlength=10 id='iddesc$dsprod' onBlur='cambiar($dsprod)'></td>";
	

	$data.="<td width='10%'><input type='text' name='subtotal[]' class='forma2' value='".$subtotal."' size='10' maxlength=10 id='subtotal$dsprod' onBlur='cambiar($dsprod)'></td>";

	
	$data.="<td width='8%'><input type=button class='formabot1' value='Quitar' name='enviar' onClick='quitarcapa($dsprod)'>";
	$data.="<input type='hidden' name='idproducto[]' value='".$fila->id."'>";
	$data.="</td>";
	$data.="</tr>";
	}
	$data.="</table>";
}
mysql_free_result($vermas);	
echo $data;

include ("../../incluidos/cerrarconexion.php");
?>