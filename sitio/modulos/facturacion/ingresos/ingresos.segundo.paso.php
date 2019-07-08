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
 Proceso inicial de facturacion
*/
//session_start();
$rutx=1;

include("../../../incluidos_modulos/modulos.globales.php");
$rc4 = new rc4crypt();
//$db->debug=true;
$tabla="tblrecibos";
if($_SESSION['i_dsanio']=="") $_SESSION['i_dsanio']=date('Y');
// proceso de refacturacion
$dsnit=$_REQUEST['dsnit']; // cliente enviado
$temporal=$_REQUEST['temporal']; //variable de recibo temporal
$posdatos=8;
$border=0;
$idreciboxx=$_REQUEST['idreciboxx'];
$idrecibox=$_REQUEST['idrecibox'];
$idpedido=$_REQUEST['idpedido'];
$contar=count($idpedido);
$dsdiac=$_REQUEST['dsdiac'];
if ($_REQUEST['inn']==2){
	// variables de carga
	$dsfechac=$_REQUEST['dsfechac'];// Fecha de creacion
	$dsvendedorx=$_REQUEST['dsvendedorx'];// Vendedor traido en caso que haya sido modificado
	// datos del cliente para ingresar en cada linea del recibo
	// traer los datos del cliente
	$sql="select dsnombres as dsrazon,dsidentificacion,dstelefono as dstele,dsdireccion,dsciudad";
	$sql.=" from tblclientes where dsidentificacion='$dsnit' limit 0,1";
	$result=$db->Execute($sql);
	if (!$result->EOF){
		$dsrazon=$result->fields[0];
		$dsnit=$result->fields[1];
		$dstele=$result->fields[2];
		$dsdir=$result->fields[3];
		$dsciudad=$result->fields[4];
		$idvendedor="";

	} else {
		// INGRESAR NUEVO CLIENTE
		$tablabase="tblclientes"; // tabla base para ingresos nuevo
		//include ("../../incluidos/cliente.nuevo.dato.php");

		

	}
	$result->Close();

	if ($dsvendedorx=="") $dsvendedorx=$idvendedor;
      $dsmesc=$_REQUEST['dsmesc'];
	if (strlen($dsmesc)<2) $dsmesc="0".$dsmesc;

	//
	$dsfecha=$_REQUEST['dsanioc']."/".$dsmesc."/".$_REQUEST['dsdiac'];// Fecha de creacion
	$partir=explode("/",$dsfecha);
	$idfecha=$partir[0].$partir[1].$partir[2];
	$dsfechalarga=$dsfecha." ".date("h:i:s a");
}
// validaciones de datos
	$mensajeData="Generando Recibo de Caja";
	// armando vector de campos
	// insertando
	if ($_REQUEST['inn']==2){
		$strSQL=" delete from ".$tabla." where dsnumero='$idrecibox' ";
		$db->Execute($strSQL);
		$idx=$_REQUEST['idx'];
		$contar=count($idx);
		$h=0;
		$dsbanco=$_REQUEST['dsbanco'];
		$dstxtbanco=$_REQUEST['dstxtbanco'];
		
		for ($j=0;$j<$contar;$j++){
			$idpedido=$_REQUEST['idpedido'][$j];
			$iddescripcion=$_REQUEST['iddescripcion'][$j];
			$dsvalor=$_REQUEST['dsvalor'][$j];
			$dscuentacontable=$_REQUEST['dscuentacontable'][$j];
			$dsnaturaleza=$_REQUEST['dsnaturaleza'][$j];
	
			if ($iddescripcion<>"" && $dsvalor<>"" && $dscuentacontable<>"") { 
				if ($iddescripcion==1){
					$sql=" update tblfacturase set idactivo=2";
					$sql.=",dsvendedor=$dsvendedorx";
					$sql.=",idusuariocreador=$dsvendedorx";
					$sql.=" where idpedido='$idpedido'"; // pagada
					// mysql_db_query($dbase,$sql,$db);
					$dscom="CANCELANDO FACTURA ".$idpedido;
				} elseif ($iddescripcion==2) {
					$sql="  update tblfacturase set idactivo=1";
					$sql.=",dsvendedor=$dsvendedorx";
					$sql.=",idusuariocreador=$dsvendedorx";
					$sql.=" where idpedido='$idpedido'"; // abonando
					// mysql_db_query($dbase,$sql,$db);
					$dscom="ABONANDO FACTURA ".$idpedido;
				} elseif ($iddescripcion==3) {
					$dscom=$_REQUEST['dscom'][$j];
					//$dscom="";
				} elseif ($iddescripcion==4) {
					$dscom=$_REQUEST['dscom'][$j];
					$dscom="ANTICIPO PAGO";
	
				}

			// echo $sql."<br>";

				$dsanulado=0;
				if ($temporal<>"") $dsanulado=1;
				$sql=" insert into $tabla ";
				$sql.=" (";
				$sql.=" idanio,idmes,dsrazon";
				$sql.=" ,dsdir,dsciudad,dstele";
				$sql.=" ,dsnumero,dsmes,dsanulado_a";
				$sql.=" ,dsespera,dsnit,dsvendedor";
				$sql.=" ,dscuentacontable_b,dsfactura,iddescripcion";
				$sql.=" ,dsdescripcion,dscom,dsvalor,dscuentacontable";
				$sql.=" ,dsnaturaleza,dsanulado,dsfechalarga,dsfecha,idfecha,idpos,dsbanco,dstxtbanco";
				$sql.=" )";
				$sql.=" values ";
				$sql.=" (";
				$sql.=" ".$_REQUEST['dsanioc'].",'".$dsmesc."','$dsrazon'";
				$sql.=" ,'$dsdir','$dsciudad','$dstele'";
				$sql.=" ,'$idrecibox','".$$dsmesc."','0'";
				$sql.=" ,'0','$dsnit','$dsvendedorx'";
				$sql.=" ,'$dscuentacontable_b','$idpedido',$iddescripcion";
				$sql.=" ,'$dsdescripcion','$dscom','$dsvalor','$dscuentacontable'";
				$sql.=" ,'$dsnaturaleza','$dsanulado','$dsfechalarga','$dsfecha',$idfecha,$j,'$dsbanco','".$dstxtbanco."'";
				$sql.=" )";
				//echo $sql."<br>";
				//exit();
				if ($db->Execute($sql)) $h++;
			}
		}	
		// listar datos del recibo de caja. Hasta que se imprima se puede realizar
		if ($h>0) { 
			$mensajes=" Recibo $idrecibox ingresado con exito";
			 $mensajes.=" <br>";
			  $mensajes.="<a class=formabot1 href=javascript:irAPaginaDN('ingresos.imprimir.html.php?idrecibo=$idrecibox','','');>Ver Recibo</a> &nbsp;|&nbsp;";
			 $mensajes.="<a href='ingresos.primer.paso.php' class=formabot1>Nuevo Recibo</a><br>";
		}
	}	


// consecutivo del pedido
if ($idrecibox=="") {
	
	$strSQL=" select dsnumero as t from ".$tabla."  order by dsnumero desc limit 0,1 ";
	// echo $strSQL;
	$vermasx=$db->Execute($strSQL);
	if (!$vermasx->EOF){
		$idrecibox=$vermasx->fields[0];
		$idrecibox=$idrecibox+1;
	} else { 
		$idrecibox=1;
	}
	$vermasx->Close();	
}
$ceros="";
for ($i=1;$i<=($posdatos-strlen($idrecibox));$i++) { 
	$ceros.="0";
}
$idreciboxx=$ceros.$idrecibox;
//if ($dsbanco=="") $dsbanco="11100504";
if($_SESSION['i_dsmes']=="")$_SESSION['i_dsmes']=date('m');
$xmes=$_SESSION['i_dsmes'];
if ($_REQUEST['dsmesc']<>"") { 
	$xmes=$_REQUEST['dsmesc'];
	if (strlen($xmes)<2) $xmes="0".$xmes;
} else { 
	if (strlen($xmes)<2) $xmes="0".$xmes;
}

if ($dsdiac==""){
	$dsdiac=date("d");
	if (strlen($dsdiac)<2) $dsdiac="0".$dsdiac;
}

$db->debug=false;
?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
<? if ($val==2){?>
location.href="ingresos.segundo.paso.php?idpedido=<? echo $idpedido;?>&idrecibo=<? echo $idrecibo;?>";
<? } ?>
     // validacion acceso
    function valI(){
	if (document.u.idrecibox.value==""){
			alert("Por favor ingrese el numero de ingreso.");
			document.u.idrecibox.focus();
			return ;
     }
	 if (isNaN(document.u.idrecibox.value)){
			alert("El numero de recibo debe ser numerico.");
			document.u.idrecibox.focus();
			return ;
     }
	 if (document.u.idrecibox.value<=0){
			alert("El numero de recibo no puede ser menor o igual a cero.");
			document.u.idrecibox.focus();
			return ;
     }


		if (document.u.dsbanco.value==""){
		alert("digite el banco.");
		document.u.dsbanco.focus();
		return ;
		}
	     document.u.submit();
	  }
</SCRIPT>


<table width="100%" cellpadding="0" cellspacing="0" align="center" border="<?echo $border?>"  class="cont_general">
	<form action="<? echo $pagina;?>" method=post name=u >
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">
<table width="70%" border="<?echo $border?>"cellpadding="0" cellspacing="0" class="texto_centro" >
        <tr>
         	<td width="615" align="left" valign="middle">
        		<img src="../../../img_modulos/modulos/edicion.png">
         		<h1><?echo $mensajeData?></h1>
         	</td>
        </tr>
</table>
		<br>
		<br>
		

	
		<? if ($_REQUEST['enviar']=="Cargar") { ?>
		<table width="90%" align=center border="<?echo $border?>" cellpadding=4 cellspacing=1 class="link_negro1" >
		<tr bgcolor="#fff" >
	
		
		<td class="textnegro2" width="10%">
		<strong>Fecha</strong></td>
		<td width="30%" align=left>
		<input type="text" name="dsanioc" class="link_negro1"  value="<? echo $_SESSION['i_dsanio'];?>" maxlength="4" size="2" readonly onKeypress="moverfoco_1(1,'dsmesc',0)" >
 		/
		<input type="text" name="dsmesc" class="link_negro1"  value="<? echo $xmes;?>" maxlength="2" size="1" onKeypress="moverfoco_1(1,'dsdiac',0)" >
		/
		<select name=dsdiac class="forma" onKeypress="moverfoco_1(2,'idpedido[]',0)" >
		<? for ($i=1;$i<=31;$i++) {
		$i1=$i;
		if (strlen($i)<2) $i1="0".$i;
		?>
		<option value="<? echo $i1?>" <? if ($i1==$dsdiac) echo selected?>><? echo $i1?></option>
		<? } ?>
		</select>
		</td>
		<td  width="15%" align=left>
		<strong>Recibo Numero</strong></td>
		<td width="18%" align=center>
		<input type="text" name="idreciboxx" class="link_negro1" value="<? echo $idreciboxx;?>" maxlength="10" size="10" readonly onKeypress="moverfoco_1(1,'dsbanco',0)" >
		<input type="hidden" name="idrecibox" class="link_negro1" value="<? echo $idrecibox;?>">
		<a class="textlink2" href="javascript:irAPaginaDN('default.php?enca=1','','');">Ver otros ingresos</a>
		</td>

		</tr>
		<tr><td colspan="4">&nbsp;</td></tr>
		<tr bgcolor="<? echo $fondos[4];?>" >
		<td  class="textnegro2" align=left>
			<strong>Cuenta</strong></td>
		<td>
		<select name="dstxtbanco">
		<option value="BANCO" <? if ($dstxtbanco=="BANCO") echo "selected";?>>Banco</option>
		<option value="CAJA" <? if ($dstxtbanco=="CAJA") echo "selected";?>>Caja</option>
		<option value="PRESTAMO A SOCIOS" <? if ($dstxtbanco=="PRESTAMO A SOCIOS") echo "selected";?>>Prestamo a socios</option>
		<option value="CRUCE DE CUENTAS" <? if ($dstxtbanco=="CRUCE DE CUENTAS") echo "selected";?>>Cruce de cuentas</option>
		</select>
		<input type="text" name="dsbanco" class="link_negro1" value="<? echo $dsbanco;?>" maxlength="20" size="20" onKeypress="moverfoco_1(1,'dsanioc',0)" >
		</td>	
		<td  class="textnegro2" align=left>
			<strong>Tercero Seleccionado:</strong>
		</td>
	
		<td  align="center" class="link_negro1">
		<input type="text" name="dsparamx" value="<? echo seldato("dsnombres","dsidentificacion","tblclientes",$dsnit,2)?>" size="30" maxlength="255" class="link_negro1" readonly>
		<input type="hidden" name="dsnit" value="<? echo $dsnit?>">
		<input type=hidden name=dsvendedorx value="">
		</td>
		</tr>
		<tr><td colspan="4">&nbsp;</td></tr>
		</table>

<br>
<br>
<? } ?>
<table width=90% align=center  cellpadding=4 cellspacing=1 class="link_negro1" style="border-bottom:<? echo $fondos[20];?>" >
		<tr bgcolor="<? echo $fondos[4];?>" align=center>
		<td valign=top  bgcolor="#DADFE4" class="text_blanco"><strong>FACTURA / PEDIDO</strong></td>
		<td valign=top  bgcolor="#DADFE4" class="text_blanco"><strong>DESCRIPCION</strong></td>
		<td valign=top  bgcolor="#DADFE4" class="text_blanco"><strong>VALOR / SALDO</strong></td>
		<td valign=top  bgcolor="#DADFE4" class="text_blanco"><strong>COMENTARIOS</strong></td>
		<td valign=top  bgcolor="#DADFE4" class="text_blanco"><strong>CUENTA</strong></td>
		<td valign=top  bgcolor="#DADFE4" class="text_blanco"><strong>NATURALEZA</strong></td>
		<td valign=top  bgcolor="#DADFE4" class="text_blanco"><strong>ADD</strong></td>
		</tr>


<? if ($_REQUEST['enviar']=="Cargar") { 
		
$sql="Select a.id,a.idpedido,a.dstotal,a.idactivo ";
$sql.=" from tblfacturase a  where  a.id>0 ";
if ($_REQUEST['enviarx']=="Seleccionar y continuar" || $_REQUEST['enviarx']=="Guardar y Generar Recibo"){
	$sql.=" and  a.idpedido in (0";
	for ($j=0;$j<$contar;$j++){
		if ($_REQUEST['idpedido'][$j]<>"" && $_REQUEST['idpedido'][$j]<>"0") $sql.=",".$_REQUEST['idpedido'][$j];
		
	}
	$sql.=" )";

} else { 
	$sql.=" and a.idactivo in ";
	$sql.="(";
	$sql.="0,1";	
	$sql.=")";
}	


$sql.=" and a.dsnit='$dsnit'" ;
$sql.=" order by a.idpedido asc ";


	$vermas=$db->Execute($sql);
	$i=0;

if (!$vermas->EOF){
	$totaldatos=$vermas;
	$color=$fondos[4];
	$colorx=$fondos[3];


		?>
<?
$x="13050500001";	
$dsnaturaleza=2;
$subdsvalor=0;
while(!$vermas->EOF) {
			
			// recibos de caja	
			$sql="select sum(dsvalor) as total from tblrecibos where dsfactura='".$vermas->fields[1]."'";
			$sql.=" and dsnit='".$dsnit."' and dscuentacontable='$x' ";
			// echo $sql;
			$creditos=0;
			$vermasr=$db->Execute($sql);
			if (!$vermasr->EOF) {
				$creditos=$vermasr->fields[0];
			}
			$vermasr->Close();		
			// notas credito


			$sql="select dsvalor as total,dsnaturaleza from tblnotasxcredito where dsfactura='".$vermas->fields[1]."'";
			$sql.=" and dsnit='".$dsnit."' and dscr='$x' ";
			// echo $sql;
			$creditosnc=0;
			$vermasr=$db->Execute($sql);
			if (!$vermasr->EOF) {
			while (!$vermasr->EOF) { 
					$x=$vermasr->fields[0];
					//echo $x;
					if ($x=="") $x=0;
					$nat=$vermasr->fields[1];
					if ($nat==1) $creditosnc=$creditosnc+$x;
					if ($nat==2) $creditosnc=$creditosnc-$x;
					
				}
				
//$creditosnc=mysql_result($vermasr,"0","total");
			}
			$vermasr->Close();			
			//depuracion de cartera
			$sql="select sum(dsvalor) as total from tbldepuracion_recibos where dsfactura='".$vermas->fields[1]."'";
			$sql.=" and dsnit='".$dsnit."' and dscuentacontable='$x'  ";
			// echo $sql;
			$creditosdc=0;
			$vermasx=$db->Execute($sql);
			if (!$vermasx->EOF) {
				$creditosdc=$vermasx->fields[0];
				if ($creditosdc=="") $creditosdc=0;
			}
			$vermasx->Close();	


			$total=$vermas->fields[2]-$creditos-$creditosnc-$creditosdc;	
			$subdsvalor=$subdsvalor+$total;
			
			if ($_REQUEST['dsvalor'][$i]<>"") $total=$_REQUEST['dsvalor'][$i];
			if ($_REQUEST['dsnaturaleza'][$i]<>"") $dsnaturaleza=$_REQUEST['dsnaturaleza'][$i];
			if ($_REQUEST['dscuentacontable'][$i]<>"") $x=$_REQUEST['dscuentacontable'][$i];
			?>
		
		<tr class=forma2  bgcolor="<? echo $color;?>" align="center" title="<? echo $mem;?>" onMouseOut="mOut(this,'<? echo $color;?>');" onMouseOver="mOvr(this,'<? echo $colorx;?>');">
		<td valign=top class="link_negro1">
		<input type='text' name="idpedido[]" class='link_negro1' size='10' maxlength=20 id="idpedido[]" value="<? echo $vermas->fields[1];?>" onKeypress="moverfoco_1(2,'iddescripcion[]',<? echo $i;?>)" >
		<input type=hidden name="idx[]" value="<? echo $i?>">
		</td>
		<td valign=top class="link_negro1">
		<select name='iddescripcion[]' class="link_negro1" id='iddescripcion[]' onKeypress="moverfoco_1(2,'dsvalor[]',<? echo $i;?>)">
		<option value="">---</option>
		<option value="1" <? if ($_REQUEST['iddescripcion'][$i]=="1") echo "selected";?>>CANCELACION</option>
		<option value="2" <? if ($_REQUEST['iddescripcion'][$i]=="2") echo "selected";?>>ABONANDO</option>

		</select>
		</td>
		<td valign=top class="link_negro1">
		<input type='text' name="dsvalor[]" class='link_negro1' size='10' maxlength=20 id="dsvalor[]" value="<? echo $total;?>" onBlur="totales();" onKeypress="moverfoco_1(2,'dscuentacontable[]',<? echo $i;?>)">
		</td>
		<td valign=top class="link_negro1"><input type='hidden' name="dscom[]" id="dscom[]">
		<?
		echo "Total Factura: $ ".number_format($vermas->fields[2],0,",",".");	
		?>
		</td>
		<td valign=top class="link_negro1">
		<input type='text' name="dscuentacontable[]" class='link_negro1' size='10' maxlength=20 id="dscuentacontable[]" value="<? echo $x?>" onKeypress="moverfoco_1(2,'dsnaturaleza[]',<? echo $i;?>)"></td>
		<td valign=top class="link_negro1"><input type='text' name="dsnaturaleza[]" class='link_negro1' size='2' maxlength=2 id="dsnaturaleza[]" value="<? echo $dsnaturaleza?>" onBlur="totales();" onKeypress="moverfoco_1(2,'idpedido[]',<? echo $i+1;?>)"></td>
		<td valign=top class="link_negro1">
		<?
		// calcular pendientes por cobrar	
		if ($total>0)  { // abonando?>
		<a href="#" onClick="irAPaginaDN('../facturacion/facturar.imprimir.html.php?idpedido=<? echo $vermas->fields[1];?>&enca=1&no=1');" title="Click para imprimir">
			<img src="../../../img_modulos/alerta.gif" align=absmiddle title="Pendiente por finalizar pago" border=0>
		</a>
		<br>
		<?}elseif ($total<=0) {  // cancelado?>
		<img src="../../../img_modulos/vistobueno.gif" align=absmiddle title="Cancelado">
		<? } else {  // pendiente  ?>
		<a href="#" onClick="irAPaginaDN('../facturacion/facturar.imprimir.html.php?idpedido=<? echo $vermas->fields[1];?>&enca=1&no=1');" title="Click para imprimir"><img src=".../../../img_modulos/faq_g.gif" align=absmiddle title="Pendiente" border=0></a>
		<? } ?>
		</td>
		</tr>

<? 
	$i++;	
	$vermas->MoveNext();
} // fin while
// totales
?>






	<? 
} else { 
?>

<?
}
$vermas->Close();
	
	} ?>

<?
////

for ($j=0;$j<=3;$j++) {
		
	?>
		<tr class=forma2  bgcolor="<? echo $color;?>" align="center" onMouseOut="mOut(this,'<? echo $color;?>');" onMouseOver="mOvr(this,'<? echo $colorx;?>');" id="filax_<? echo $i?>_<? echo $j?>" style="display:">
		<td valign=top class="link_negro1">
		<? //  echo $i;?>
		<input type=hidden name="idx[]" value="<? echo $i?>">

		<input type='text' name="idpedido[]" class='link_negro1' size='10' maxlength=20 id="idpedido[]" value="<? echo $_REQUEST['idpedido'][$i];?>" onKeypress="moverfoco_1(2,'iddescripcion[]',<? echo $i;?>)">

		
		</td>
		<td valign=top class="link_negro1">
		<select name='iddescripcion[]' class="link_negro1" onKeyPress="moverfoco_1(2,'dsvalor[]',<? echo $i;?>)">
		<option value="3">OTROS</option>
		<option value="4" <? if ($_REQUEST['iddescripcion'][$i]=="4") echo "selected";?>>ANTICIPO</option>

		</select>
		</td>
		<td valign=top class="link_negro1">
		<input type='text' name="dsvalor[]" class='link_negro1' size='10' maxlength=20 id="dsvalor[]" value="<? echo $_REQUEST['dsvalor'][$i];?>" onBlur="totales();" onKeypress="moverfoco_1(2,'dscom[]',<? echo $i;?>)">
		</td>
		<td valign=top class="link_negro1"><input type='text' name="dscom[]" class='link_negro1' size='35' maxlength=255 id="dscom[]" value="<? echo $_REQUEST['dscom'][$i];?>" onKeypress="moverfoco_1(2,'dscuentacontable[]',<? echo $i;?>)"></td>
		<td valign=top class="link_negro1"><input type='text' name="dscuentacontable[]" class='link_negro1' size='10' maxlength=20 id="dscuentacontable[]" value="<? echo $_REQUEST['dscuentacontable'][$i];?>" onKeypress="moverfoco_1(2,'dsnaturaleza[]',<? echo $i;?>)"></td>
		<td valign=top class="link_negro1">
		<? if ($j<3) { ?> 
		<input type='text' name="dsnaturaleza[]" class='link_negro1' size='2' maxlength=2 id="dsnaturaleza[]" value="1" onBlur="totales();" onKeypress="moverfoco_1(2,'idpedido[]',<? echo $i+1;?>)">
		<? } else { ?>
		<input type='text' name="dsnaturaleza[]" class='link_negro1' size='2' maxlength=2 id="dsnaturaleza[]" value="1" onBlur="totales();" onKeypress="moverfoco_1(1,'subdsvalor',<? echo $i+1;?>)">
		<? } ?>
		</td>
		
		<td valign=top class="link_negro1">&nbsp;</td>
		</tr>

<? 
	$i++;	
}
if ($_REQUEST['subdsvalor']<>"") $subdsvalor=$_REQUEST['subdsvalor'];
?>

<tr><td colspan="7" celspan=2>&nbsp;</td></tr>
<tr class=forma2  bgcolor="<? echo $color;?>" align="center" title="<? echo $mem;?>" onMouseOut="mOut(this,'<? echo $color;?>');" onMouseOver="mOvr(this,'<? echo $colorx;?>');">
		<td valign=top class="link_negro1">
		<strong>TOTALES</strong>
		</td>
		<td valign=top class="link_negro1">&nbsp;</td>
		<td valign=top class="link_negro1">
		<input type='text' name="subdsvalor" class='imprimir_tit_datos_caja' size='10' maxlength=20 id="subdsvalor" value="<? echo $subdsvalor;?>" readonly >
		</td>
		<td valign=top class="link_negro1">&nbsp;
		
		</td>
		<td valign=top class="link_negro1">&nbsp;</td>
		<td valign=top class="link_negro1">&nbsp;</td>
		<td valign=top class="link_negro1">&nbsp;</td>
		</tr>


</table>


	<? if ($_REQUEST['enviar']=="Cargar") { ?>
		<table width=90% align=center border="<?echo $border?>" cellpadding=4 cellspacing=1 class="link_negro1" style="border-bottom:<? echo $fondos[20];?>" >
		<tr><td colspan=4 ceslpan=2>&nbsp;</td></tr>
		<tr bgcolor="<? echo $fondos[4];?>" align=center>
			<td valign=top colspan=4 class="link_negro1" align=center>
				<input type=button name=enviary value="Guardar y Generar Recibo" class="botones" onClick="valI();" >
				<input type=hidden name=enviarx value="Guardar y Generar Recibo">
				<input type=hidden name=idusuariox value="<? echo $idusuariox?>">
				<input type=hidden name=temporal value="<? echo $temporal?>">

				<input type=hidden name=inn value="2">
				<input type=hidden name=enviar value="<? echo $_REQUEST['enviar']?>">
				<input type=button name=enviarx1 value="Regresar" class="botones" onClick="irAPaginaD('default.php');">
</td>
		</tr>
		</form>
</table>

<? } ?>	
</td>
</tr>
</table>
<br>
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

function totales(){
var totales=0;
var x=0;
	for (i=0;i<document.u.elements['dsvalor[]'].length;i++){ 
		if (document.u.elements['dsvalor[]'][i].value!="") { 
			var x=eval(document.u.elements['dsvalor[]'][i].value);
			if (document.u.elements['dsnaturaleza[]'][i].value==2) { 
				totales=totales+x;
			} else if (document.u.elements['dsnaturaleza[]'][i].value==1) { 
				totales=totales-x;
			}
		}
	}	
	document.u.elements['subdsvalor'].value=totales;
}
//-->
</script>