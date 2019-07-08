<?
/*
| ----------------------------------------------------------------- |
SISTEMA ADMINISTRATIVOS GERENCIALES
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2011
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- | 
 Proceso inicial de recibos de caja. Se seleccionan las 
 facturas para luego pasar al segundo paso
*/
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
$tabla="tblrecibos";
//$db->debug=true;
$mensajeData="Paso 1. Seleccionando tercero";
$dsnit=$_REQUEST['dsnit'];
$dsparam=$_REQUEST['dsparam'];

?>
?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>

<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<table width="100%" cellpadding="0" cellspacing="0" align="center"  class="cont_general">
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">
<table width="70%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
        <tr>
         	<td width="615" align="left" valign="middle">
        		<img src="../../../img_modulos/modulos/edicion.png">
         		<h1><?echo $mensajeData?></h1>
         	</td>
        </tr>
</table>
		<table width=100% align=center border=0 cellpadding=4 cellspacing=1 class="link_negro1" style="border-bottom:<? echo $fondos[20];?>" >
		<form action="ingresos.segundo.paso.php" method=post name=u> 
				<tr bgcolor="<? echo $fondos[4];?>" align=center>
			<td valign=top colspan=4 class="link_negro1">
			  	<input type=button name=enviar value="Regresar" class="botones" onClick="irAPaginaD('default.php');">
			  	<input type=button name=enviar value="RECIBO TEMPORAL" class="botones" onClick="irAPaginaD('ingresos.segundo.paso.temporal.php?temporal=1&enviar=Cargar');">
		
				</td>
				
		</tr>
		<tr bgcolor="<? echo $fondos[4];?>" >
		<td  valign=top class="link_negro1"colspan="4" align="center">
		Buscar por nombre o por NIT:</td></tr>
	
		<tr bgcolor="<? echo $fondos[4];?>" >
		<td  valign=top class="link_negro1"colspan="4" align="center">
		<input type="text" name="dsparam" value="<? echo $dsparam;?>" class="link_negro1" size="100" maxlength="255" onkeypress="Cargar_terceros();">	
		<input type="hidden" name="dsnit" value="<? echo $dsnit?>">
<br>
<div id="capa_resultados_destinatarios" style="display:none">		
		<iframe src="ingresos.cargar.terceros.php" height="100%" width="100%" marginheight="0" frameborder="no" allowtransparency="true" bordercolor="black" name="panelresultados" marginwidth="0" id="panelresultados"></iframe>
</div>		

		<br>
		</td>
		</tr>
		<tr bgcolor="<? echo $fondos[4];?>" >
		<td  valign=top class="link_negro1"colspan="4" align="center">
		
		(Cuando encuentra informacion haga doble click para cargar los datos). 

		<!--select name="dsnit" class="link_negro1">
		<option value="">...</option>
		<? // combosfacturasp($dsnit,$_SESSION['i_idempresa']);?>
		</select>
		<input type="button" name="enviar" value="Cargar" class="formbt1" onClick="cargarrecibo();"-->
		<input type="hidden" name="enviar" value="Cargar" class="formbt1" >
		


		  </td>
		  </tr>
	</table>

	<? if ($_REQUEST['enviar']=="Cargar") { 
?>
<table width=100% align=center  cellpadding=4 cellspacing=1 class="link_negro1" style="border-bottom:<? echo $fondos[20];?>" >
		<tr bgcolor="<? echo $fondos[4];?>" align=center>
		<td valign=top background="../../img/titu_fondo.jpg" bgcolor="#DADFE4" class="text_blanco"><strong>FACTURA / PEDIDO</strong></td>
		<td valign=top background="../../img/titu_fondo.jpg" bgcolor="#DADFE4" class="text_blanco"><strong>FECHA</strong></td>
		<td valign=top background="../../img/titu_fondo.jpg" bgcolor="#DADFE4" class="text_blanco"><strong>VENCIMIENTO</strong></td>
		<td valign=top background="../../img/titu_fondo.jpg" bgcolor="#DADFE4" class="text_blanco"><strong>DIAS</strong></td>				
		<td valign=top background="../../img/titu_fondo.jpg" bgcolor="#DADFE4" class="text_blanco"><strong>VALOR FACTURA</strong></td>
		<td valign=top background="../../img/titu_fondo.jpg" bgcolor="#DADFE4" class="text_blanco"><strong>PAGOS</strong></td>
		<td valign=top background="../../img/titu_fondo.jpg" bgcolor="#DADFE4" class="text_blanco"><strong>SALDO ACTUAL</strong></td>

		</tr>

<?		
$sql="Select a.id,a.idpedido,a.dstotal,a.idactivo,a.dsfechac,a.dsfechav ";
$sql.=" from tblfacturase a where  a.id>0 ";
$sql.=" and a.idactivo in ";
$sql.="(";
$sql.="0,1";	
$sql.=")";
$sql.=" and a.dsnit='$dsnit'" ;
$sql.=" order by a.idpedido asc ";
$result=$db->Execute($sql);
if (!$result->EOF){
	$i=0;
	$totaldatos=$result;
	$color=$fondos[4];
	$colorx=$fondos[3];
	?>
<?
$x="130505";	
$gtotal=0;
$gcreditos=0;
$stotal=0;
while(!$result->EOF) {
		$total=0;
		$cadval=explode("/",$result->fields[4]);
		$an = $cadval[2];
		$mes = $cadval[1];
		$dia = $cadval[0];
	
		if (strlen($dia)==4) {
		$an = $cadval[0];
		$mes = $cadval[1];
		$dia = $cadval[2];
		}

		$fechacmostrar=$dia."/".$mes."/".$an;
		$cadval=explode("/",$result->fields[5]);
		$an = $cadval[2];
		$mes = $cadval[1];
		$dia = $cadval[0];
	
		if (strlen($dia)==4) {
		$an = $cadval[0];
		$mes = $cadval[1];
		$dia = $cadval[2];
		}
		$fechavmostrar=$dia."/".$mes."/".$an;
		$an2 = date("Y");
		$mes2 = date("m");
		$dia2 = date("d");
				
		$timestamp = mktime(0, 0, 0, $mes, $dia, $an);
		$timestamp2 = mktime(0, 0, 0, $mes2, $dia2, $an2);
		$diasv = floor(($timestamp2 - $timestamp) / (3600 * 24));
	


			// recibos de caja
			$sql="select sum(dsvalor) as total from tblrecibos where dsfactura='".$result->fields[1]."'";
			$sql.=" and dsnaturaleza='2'  ";
			$creditos=0;
			$result_c=$db->Execute($sql);
			if (!$result_c->EOF){
			$creditos=$result_c->fields[0];
			}
			$result_c->Close();		

			// notas de credito

			$sql="select dsvalor as total,dsnaturaleza from tblnotasxcredito where dsfactura='".$result->fields[1]."'";
			$creditosnc=0;
			$resultx=$db->Execute($sql);
			if (!$resultx->EOF){
				while ($resultx->EOF) { 
					$x=$resultx->fields[0];
					//echo $x;
					if ($x=="") $x=0;
					$xnat=$resultx->fields[1];
					if ($xnat==1) $creditosnc=$creditosnc+$x;
					if ($xnat==2) $creditosnc=$creditosnc-$x;
					
					$resultx->MoveNext();
				}
				//$creditosnc=mysql_result($vermasr,"0","total");
			}
			$resultx->Close();	

			// depuracion de cartera
			$sql="select sum(dsvalor) as total from tbldepuracion_recibos where dsfactura='".$result->fields[1]."'";
			$sql.=" and dsnaturaleza='2'  ";
			$creditosdc=0;
			$resul=$db->Execute($sql);
			if (!$resul->EOF){
				$creditosdc=$resul->fields[0];
				if ($creditosdc=="") $creditosdc=0;
			}
			$resul->Close();


			
			$total=$result->fields[2]-$creditos-$creditosnc-$creditosdc;			

			// notascontables
			$sql="select sum(dscredito) as total from tblnotascc where dsfactura='".$result->fields[1]."'";
			$sql.=" and dscuentac='13050500001' ";
			$creditosnotac=0;
			$resultn=$db->Execute($sql);
			if (!$resultn->EOF){
				$creditosnotac=$resultn->fields[0];
				if ($creditosnotac=="") $creditosnotac=0;
			}$resultn->Close();


			
			$total=$result->fields[2]-$creditos-$creditosnc-$creditosdc-$creditosnotac;			

			
			
			
//echo "Factura: ".$result->fields[1]." -- Valor: ".$total."<br>";
if ($total>0) { 
	$gtotal=$gtotal+$result->fields[2];
	$gcreditos=$gcreditos+$creditos+$creditosnc;
	$stotal=$stotal+$total;
		?>
		<tr class=forma2  bgcolor="<? echo $color;?>" align="center" title="<? echo $mem;?>" onMouseOut="mOut(this,'<? echo $color;?>');" onMouseOver="mOvr(this,'<? echo $colorx;?>');">



		<td valign=top class="link_negro1">
		<input type=checkbox name="idpedido[]" value="<? echo $result->fields[1]?>">
		<? echo $result->fields[1];?>
		</td>
		<td valign=top class="link_negro1"><? echo $fechacmostrar;?></td>
		<td valign=top class="link_negro1"><? echo $fechavmostrar;?></td>		
		<td valign=top class="link_negro1"><? echo $diasv;?></td>				
		
		
		<td valign=top class="link_negro1"><? echo "$ ".number_format($result->fields[2],0,",",".");?></td>
		<td valign=top class="link_negro1"><? echo "$ ".number_format($creditos+$creditosnc+$creditosdc,0,",",".");?></td>

		<td valign=top class="link_negro1"><? echo "$ ".number_format($total,0,",",".");?></td>

		
		</tr>
<? 
	} // fin total
	$result->MoveNext();
}  // fin while 

	
}
$result->Close();
// ANTICIPOS
$sql="select sum(dsvalor) as total from tblrecibos where dsfactura='' and  iddescripcion=4 and dsnit='".$dsnit."' ";
//$sql.=" and dscuentacontable='$x'  ";
$sql.=" and dsnaturaleza='2'  ";
//echo $sql;
$anticipos=0;
$vermasx=$db->Execute($sql);
if (!$vermasx->EOF){
$anticipos=$vermasx->fields[0];
}
$vermasx->Close();	
if ($anticipos>0) { 
?>
<tr class=forma2  align="center">
		<td valign=top class="link_negro1">	<strong>ANTICIPOS</strong>
		</td>
		<td valign=top class="link_negro1">&nbsp;</td>		
		<td valign=top class="link_negro1">&nbsp;</td>				
		<td valign=top class="link_negro1">&nbsp;</td>						
		<td valign=top class="link_negro1"><strong></strong></td>
		<td valign=top class="link_negro1"><strong></strong></td>
		<td valign=top class="link_negro1"><strong><? echo "$ ".number_format($anticipos,0,",",".");?></strong></td>

		</tr>

<?
}

?>

<tr class=forma2  align="center">
		<td valign=top class="link_negro1">	<strong>TOTALES</strong>
		</td>
		<td valign=top class="link_negro1">&nbsp;</td>		
		<td valign=top class="link_negro1">&nbsp;</td>				
		<td valign=top class="link_negro1">&nbsp;</td>						
		<td valign=top class="link_negro1"><strong><? echo "$ ".number_format($gtotal,0,",",".");?></strong></td>
		<td valign=top class="link_negro1"><strong><? echo "$ ".number_format($gcreditos,0,",",".");?></strong></td>
		<td valign=top class="link_negro1"><strong><? echo "$ ".number_format($stotal-$anticipos,0,",",".");?></strong></td>

		</tr>
		
</table>


		<table width=100% align=center  cellpadding=4 cellspacing=1 class="link_negro1" style="border-bottom:<? echo $fondos[20];?>" >
		<tr bgcolor="<? echo $fondos[4];?>" align=right>
			<td valign=top colspan=4 class="link_negro1">
				<input type=submit name=enviarx value="Seleccionar y continuar" class="botones" >
				<input type=hidden name=idusuariox value="<? echo $idusuariox?>">
				<input type=hidden name=dsnitx value="<? echo $dsnit?>">				
				<input type=hidden name=enviar value="<? echo $_REQUEST['enviar']?>">
				<input type=button name=enviarx1 value="Regresar" class="botones" onClick="irAPaginaD('default.php');">
</td>
		</tr>
		</form>
</table>

<? } // fin cargar  ?>	

<br>

	</td>
</tr>
</table>
<? 	
	include ($rutxx."../../incluidos_modulos/cerrarconexion.php"); 
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>
<script language="javascript">
<!--
function cargarrecibo(){
	location.href="<? echo $pagina?>?dsnit="+document.u.dsnit.value+"&enviar=Cargar";
}

function Cargar_terceros(){

	var dsparam=document.u.dsparam.value;


	var capadatos=document.getElementById("capa_resultados_destinatarios");
	if (capadatos) {
		capadatos.style.display='';
		document.u.action="ingresos.cargar.terceros.php?dsparam="+dsparam;
		document.u.target="panelresultados";
		document.u.submit();

	}

}



//-->
</script>