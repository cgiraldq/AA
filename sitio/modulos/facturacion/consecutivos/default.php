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
Principal listado de consecutivos
*/
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
$dsm="Concepto";
$tabla="tblresoluciones";
$titulomodulo="Consecutivos  de facturaci&oacute;n";
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


		if ($dsres<>"" &&$idconsecini<>""&&$idconsecfin){
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
if ($_REQUEST['enviar']=="Modificar")
{
	$contar=count($_REQUEST['id_']);
	$v=0;
	for ($j=0;$j<$contar;$j++)
	{
		if ($_REQUEST['id_'][$j]<>"")
		{
			$sqlm=" update ".$tabla. " set ";
			$sqlm.= "dsres='".$_REQUEST['dsres_'][$j]."'";				
			$sqlm.= ",idconsecini='".$_REQUEST['idconsecini_'][$j]."'";
			$sqlm.= ",idconsecfin='".$_REQUEST['idconsecfin_'][$j]."'";
			$sqlm.= ",dsnit='".$_REQUEST['dsnit_'][$j]."'";
			$sqlm.= ",dsciudad='".$_REQUEST['dsciudad_'][$j]."'";
			$sqlm.= ",dsnombre='".$_REQUEST['dsnombre_'][$j]."'";
			$sqlm.= ",dsdir='".$_REQUEST['dsdir_'][$j]."'";	
			$sqlm.= ",dstel='".$_REQUEST['dstel_'][$j]."'";
			$sqlm.= ",dsfecha='".$_REQUEST['dsfechax_'][$j]."'";
			$sqlm.= ",dsdesc='".$_REQUEST['dsdescx_'][$j]."'";
			$sqlm.= ",dsprefijo='".$_REQUEST['dsprefijo_'][$j]."'";
			$sqlm.= ",idactivo='".$_REQUEST['idactivo_'][$j]."'";					
			$sqlm.= " where id=".$_REQUEST['id_'][$j];
			//echo $sqlm."<BR>";
			//exit();
			if ($db->Execute($sqlm)) $v++;
		} // fin si
	} // fin for
	if ($v>0) $Mensaje="Modificaci&oacute;n realizada con &eacute;xito ".$mensajeData;	
} // fin inn
// nombre d elos campos en base de datos

$codigos[0]="dsres";
$codigos[1]="dsnit";
//nombre en el combo para el usuario	

$nombres[0]="Resolucion";
$nombres[1]="NIT";
// armando campos
$campos="dsm";
$condiciones="";
$nombreBase="dsm";
$name="med"; // el <a name>
if ($_REQUEST['enviar']=="Eliminar")
{ // eliminacion de datos
			$sqlm=" delete from  ".$tabla. "  ";
			$sqlm.= " where id=".$_REQUEST['idx'];
			//echo $sqlm;
			//exit();
			$vermas=$db->Execute($dbase,$sqlm,$db);
	$Mensaje="Eliminaci&oacute;n con exito del cliente seleccionado ";	
}	
?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<?
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	$rutamodulo="<a href='../../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	//$exportar=1; // permite exportar la tabla
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");


$ida=1;
// parametro adicional en caso que se lista por empresa
if($ida==1){
$bloqueabc=0;
//include ($rutxx."../../incluidos_modulos/buscador.php"); 
$strSQL="select ";
$strSQL.="id, dsres, idconsecini, idconsecfin";
$strSQL.=", idconsecactual, dsciudad, dsnombre";
$strSQL.=", dsnit, dsdir, dstel, dsfecha, dsdesc, dsprefijo, idactivo";
$strSQL.=" from $tabla a where a.id>0";
if($_REQUEST['param']<>""){
 	$strSQL.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";	
 	}
if($_REQUEST['letra']<>"") $strSQL.=" and a.dsm like '".$_REQUEST['letra']."%'";
$strSQL.=" order by  a.dsres ASC ";
if ($_REQUEST['pag']==""){ 
$pag = 1; // Por defecto, pagina 
}else { 
$pag=$_REQUEST['pag'];
}	
$cantidad1=$_REQUEST['cantidad'];
if ($cantidad1==""){ $cantidad1=$_REQUEST['cantidad']; }
if ($cantidad1==""){ 
$tampag = 30;
}else{
$tampag = $cantidad1;
}
$reg1 = ($pag-1) * $tampag;
if ($_REQUEST['pag']<>"-1"){ 
$strSQL.=" limit $reg1,$tampag";
}

//echo $strSQL;

$rutaPaginador=$pagina."?letra=".$_REQUEST['letra']."&param=".$_REQUEST['param']."&campo=$campo&idorigenclientex=$idorigenclientex&idlistax=$idlista&cargarfac=$cargarfac&cargarec=$cargarec&cantidad=$tampag&pag=";
// pintando cabecera de datos
$vermas=$db->Execute($strSQL);
//include ($rutxx."../../incluidos_modulos/func.paginador.php");	
//include ($rutxx."../../incluidos_modulos/func.tabla.paginador.php");	

?>
<br>
<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<form action="<? echo $pagina;?>" method=post name=u>								
<?
$nombrecampos="ID,Prefijo,Resolucion,Desde,Hasta,Actual,NIT,Ciudad,Nombre,Dir,Telefono,Fecha,Texto,Activar";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");

if (!$vermas->EOF) {
while(!$vermas->EOF) {

?>
<tr class=forma2  bgcolor="<? echo $fondo;?>" align="center" title="<? echo $mem;?>" onMouseOut="mOut(this,'<? echo $fondos[4];?>');" onMouseOver="mOvr(this,'<? echo $fondos[3];?>');">		
<td align="center" bgcolor="<? echo $fondos[12]?>" class="link_negro1" width="5%">
<? echo $vermas->fields[0];?>
</td>
<input type="hidden" name="id_[]" value="<?echo $vermas->fields[0]?>">
<td align="center" class="link_negro1">
<input type="text" name="dsprefijo_[]" value="<? echo $vermas->fields[12];;?>" size="5" class="link_numeros">
</td>


<td align="center" class="link_negro1">
<input type="text" name="dsres_[]" value="<? echo $vermas->fields[1];?>" size="10" class="link_numeros">
</td>

<td align="center" class="link_negro1">
<input type="text" name="idconsecini_[]" value="<? echo $vermas->fields[2];?>" size="4" class="link_numeros" >
</td>

<td align="center" class="link_negro1">
<input type="text" name="idconsecfin_[]" value="<? echo $vermas->fields[3];?>" size="4" class="link_numeros" >
</td>

<td align="center" class="link_negro1">
<input type="text" name="idconsecactual_[]" value="<? echo $vermas->fields[4];;?>"  readonly size="10" class="link_numeros" >
</td>


<td align="center" class="link_negro1">
<input type="text" name="dsnit_[]" value="<? echo $vermas->fields[7];;?>" size="9" class="link_numeros" >
</td>


<td align="center" class="link_negro1">
<input type="text" name="dsciudad_[]" value="<? echo $vermas->fields[5];;?>" size="20" class="link_numeros" >

</td>


<td align="center" class="link_negro1">
<input type="text" name="dsnombre_[]" value="<? echo $vermas->fields[6];;?>" size="25" class="link_numeros" >
</td>

<td align="center" class="link_negro1">
<input type="text" name="dsdir_[]" value="<? echo $vermas->fields[8];;?>" size="25" class="link_numeros" >
</td>

<td align="center" class="link_negro1">
<input type="text" name="dstel_[]" value="<? echo $vermas->fields[9];;?>" size="10" class="link_numeros" >
</td>

<td align="center" class="link_negro1">
<input type="text" name="dsfechax_[]" value="<? echo $vermas->fields[10];?>" size="20" class="link_numeros" >
</td>

<td align="center" class="link_negro1">
<textarea name="dsdescx_[]" class="link_numeros" cols="40" rows="6"><? echo $vermas->fields[11]?></textarea>
</td>


<td align="center">
					<select name="idactivo_[]" class=ddesingtex1>
		<option value="0" <? if ($vermas->fields[13]==0){ echo "selected";}?>>--</option>
		<option value="1" <? if ($vermas->fields[13]==1){ echo "selected";}?>>SI</option>
		<option value="2" <? if ($vermas->fields[13]==2){ echo "selected";}?>>NO</option>
				</select>	
					</td>


						
  <td align="center">
		  <?
		  $rutax=$pagina."?idx=".$vermas->fields[0]."&enviar=Eliminar";
		  $formax="";
		  include($rutxx."../../incluidos_modulos/enlace.eliminar.php");?>
		  </td>		
</tr>

<?
$vermas->MoveNext();
}
} // fin si 
$vermas->Close();
?>
</table>				
<table width=80% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed;">
<tr class=forma2  bgcolor="<? echo $fondos[4];?>" align="center">		
<td  onMouseOut="mOut(this,'<? echo $fondos[4];?>');" onMouseOver="mOvr(this,'<? echo $fondos[5];?>');">


<input type=submit name="enviar" class="botones" value="Modificar">
<input type="hidden" name="idlistax" value="<? echo $idlistax?>">
<input type="hidden" name="idorigenclientex" value="<? echo $idorigenclientex?>">

<? if ($iddel==1){?>
<!--input type=submit name="enviar" class=forma2 value="Eliminar"-->
<? } ?>
</td>
</tr>
</form>		
</table>
<br>

<?
} else {

}include("ingreso.php");
include ($rutxx."../../incluidos_modulos/cerrarconexion.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");
include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

?>
</body>
</html>
