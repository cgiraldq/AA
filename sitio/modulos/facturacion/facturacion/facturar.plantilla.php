<?
/*
| ----------------------------------------------------------------- |
EXTRANET CT 
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
 Formato de impresion de datos de la factura
*/
// datos del cliente
// traer el iva
 //$db->debug=true;
$dsres=$_REQUEST['dsres'];
$dsprefijo=$_REQUEST['dsprefijo'];
$IVAx=seldato("dspor","ida","tbliva",1,0);
$IVA=($IVAx/100);
// valores de la retenciones
// 1. Valor base retenciones
$baseRete=seldato("dsbase","ida","tblretenciones",1,0);
// porcentajes
// 2. la retefuente
$dsporRetex=seldato("dspor","ida","tblretenciones",1,0);
$dsporRete=($dsporRetex/100);
// 3. el rete iva
$dsBaseReteIVA=seldato("dsretiva","ida","tblretenciones",1,0);
$sql="select ";
$sql.="id, idanio, idmes, idpedido, idusuario";//4
$sql.=", idcliente, dsnit, dsrazon, dsdir, dsciudad";//9
$sql.=", dstele, idplazo, dsobsplazo, dsfechac, idfechac";//14
$sql.=", dsfechav, idfechav, dsfechap, idfechap, idformapago";//19
$sql.=", dssubtotal, dsbase, dsiva, dsrete, dsreteiva";//24
$sql.=", dsreteica, dspordesct, dsdesct, dstotal, idactivo";//29
$sql.=", dsobs, dsorden, dspedido, dsobspago, idusuariocreador";//34
$sql.=", dsvendedor, dsclientedsdiasv,dsflete,dsprefijo,dsres";//39
$sql.=" from tblfacturase where idpedido='".$idpedido."' and dsprefijo='".$dsprefijo."' and dsres='".$dsres."'";
//echo $sql;
$result=$db->Execute($sql);
if (!$result->EOF) {
	$dsobs=$result->fields[30];
	$dsfechap= $result->fields[17];
	
	$dsfechac= $result->fields[13];
	$partir=explode("/",$dsfechac);
-	$dsdiax=$partir[2];
	$dsmesx=$partir[1];
	$dsaniox=$partir[0];

	$dsfechav= $result->fields[15];
	$partir=explode("/",$dsfechav);
	$dsdiaxv=$partir[2];
	$dsmesxv=$partir[1];
	$dsanioxv=$partir[0];


	
	$idactivo= $result->fields[29];
	$idorden= $result->fields[31];
	$idusuario= $result->fields[4];
	$dsiva= $result->fields[22];
	$dsrete= $result->fields[23];
	$dsreteiva= $result->fields[24];
	$dsreteica= $result->fields[25];
	$dstotal= $result->fields[28];
	$dssubtotalx= $result->fields[20];
	$descuentos= $result->fields[27];
	$dsorden=$result->fields[31];
	$dspedido=$result->fields[32];;
	$dsrazon=$result->fields[7];;
	$dsnit=$result->fields[6];;
	$dsdir=$result->fields[8];;
	$dstele=$result->fields[10];;
	$dsciudad=$result->fields[9];;
	$dstotalflete=$result->fields[37];
	// dias de vencimiento
	$dsclientedsdiasv=$result->fields[36];
	// vendedor
	$dsvendedor=$result->fields[35];;
	// porcentaje de descuento si es diferente de cero o nulo
	$dspordesct=$result->fields[26];;
	$dsprefijo= $result->fields[38];
	$dsres= $result->fields[39];

}
$result->Close();

$ceros="";
for ($i=1;$i<=($posdatos-strlen($idpedido));$i++) { 
	$ceros.="0";
}
$idpedidox=$ceros.$idpedido;
?>
	<table width=99% align=center  cellpadding=5 cellspacing=1 class="text1" >
		<tr bgcolor="#fff"  >
		<td valign=top align="center"  width="45%">
		<br>
		<?$rutaImagend=$rutxx."../../../contenidos/images/logo_empresa/";
		$dsimg1empresa=seldato('dsimg1','id','tblempresa',1,1)?>
		<? if(is_file($rutaImagend.$dsimg1empresa)){ ?>
        <img src="<? echo $rutaImagend.$dsimg1empresa ?>" >
        <? } 
        $sql="select id, dsres, idconsecini, idconsecfin, idconsecactual, dsciudad ";
        $sql.=", dsnombre, dsnit, dsdir, dstel, dsfecha, dsdesc,dscorreo";
        $sql.=" FROM tblresoluciones WHERE dsres='".$dsres."' and dsprefijo='".$dsprefijo."'";
       //echo $sql;
        $vermax = $db->Execute($sql);
		if (!$vermax->EOF) {
		$dsresx=$vermax->fields[1];
		$idconsecini=$vermax->fields[2];
		$idconsecfin=$vermax->fields[3];
		$dsciudadx=$vermax->fields[5];
		$dsnombrex=$vermax->fields[6];
		$dsnitx=$vermax->fields[7];
		$dsdirx=$vermax->fields[8];
		$dstelx=$vermax->fields[9];
		$dsfechax=$vermax->fields[10];
		$dsdescx=$vermax->fields[11];
		$dscorreox=$vermax->fields[12];
		$dsdescx=str_replace("**","<br>** ",$dsdescx);
		}
		$vermax->Close();


        ?>
		<br />
		NIT: <?echo $dsnitx?>
		<br />
		<?echo $dsdirx?> / PBX: <?echo $dstelx?><br />
		Email: <?echo $dscorreox?> / <?echo $dsciudadx?><br />


	</td>
		
		<td valign="middle" align=center nowrap >
		<span class="textnegrotit">FACTURA DE VENTA</span>
		<br />
	No. <span class="textnegrotit"><font color="#000000"><? echo $dsprefijo." ".$idpedidox;?></font></span>
		</td>
</table>

<table width=99% align=center  cellpadding=5 cellspacing=1 class="text1" >
		<tr bgcolor="#fff"  >
		<td valign=top align="center"  width="45%">
		</td>
		<td valign=top align="center" width="25%" >
		</td>
		<td valign=top align="center">
			<span class=textnegro2><strong>IVA REGIMEN COMUN</strong></span>
		</td>
		</tr>
</table>
<? if ($idactivo==3) echo "<span class=textnegrotitf><strong>ANULADA</strong></span>"; ?>
<table width=99% align=center  cellpadding=1 cellspacing=1 class="text1">
		

		<tr bgcolor="#fff"  >
		<td valign=top align="left"  width="45%">
		<table width=100% align=center  cellpadding=5 cellspacing=1 class="text1" bgcolor="#fff" border="<? echo $border;?>">
		<tr bgcolor="#fff"  >
		<td valign=top align="left" class="textnegro2"  >
		<strong style="font-size:13px;">SE&Ntilde;ORES:</strong><br>
<? 		echo $dsrazon;
		echo "<br>";
		echo "<br>";
		echo "<strong style='font-size:13px;'>NIT </strong><br></span>&nbsp;".$dsnit;
		echo "<br> Telefono:".$dstele."";
		?>
</td>
</tr>

		<tr bgcolor="#fff"  >
		<td valign=top align="left" class="textnegro2" >
		<strong style="font-size:13px;">DIRECCI&Oacute;N:</strong>
		<br />
<? 
		echo $dsdir.", ";
		echo "".$dsciudad."<br>";
		?>
		
		
</td>
</tr>



</table>
		</td>
		<td valign=top align="center" width="50%" >


		<table width=100% align=center  cellpadding=2 cellspacing=0 BORDER=1 class="textnegro" bgcolor="#000" >
		<tr bgcolor="#FFF" class="text1" >
		<td valign=top colspan=3 align=center ><span class=textnegro2><strong>Fecha Creaci&oacute;n</strong></span></td>
		<td valign=top colspan=3 align=center><span class=textnegro2><strong>Fecha Vencimiento</strong></span></td>

</tr>



		<tr  bgcolor="#FFF" class="text1" align="center" >
		<td valign=top width=16%><span class=textnegro2><strong>DIA</strong></span></td>
		<td valign=top width=16%><span class=textnegro2><strong>MES</strong></span></td>
		<td valign=top width=16%><span class=textnegro2><strong>A&Ntilde;O</strong></span></td>

		<td valign=top width=16%><span class=textnegro2><strong>DIA</strong></span></td>
		<td valign=top width=16%><span class=textnegro2><strong>MES</strong></span></td>
		<td valign=top width=16%><span class=textnegro2><strong>A&Ntilde;O</strong></span></td>
			</tr>


	

<tr bgcolor="#fff" align="center" class="textnegro2" >
		<td valign=top ><? echo $dsdiax?></td>
		<td valign=top ><? echo $dsmesx?></td>
		<td valign=top ><? echo $dsaniox?></td>

		<td valign=top ><? echo $dsdiaxv?></td>
		<td valign=top ><? echo $dsmesxv?></td>
		<td valign=top ><? echo $dsanioxv?></td>

</tr>

	<tr bgcolor="#fff" class="text" >
		<td valign=top align="left" colspan=3 ><span class=textnegro2>
</td>

<td valign=top align="left" colspan="3" ><span class=textnegro2><strong>DIAS DE VENCIMIENTO</strong></span> <br><? 

// calculo de dias de vencimiento
	$timestamp = mktime(0, 0, 0, $dsmesxv, $dsdiaxv, $dsanioxv);
	$timestamp2 = mktime(0, 0, 0, $dsmesx, $dsdiax, $dsaniox);
	$diff = floor(($timestamp - $timestamp2) / (3600 * 24));
echo $diff;
?> 
d&iacute;a(s)
		
</td>

</tr>
</tr>
</table>
</td>
</tr>
</table>
<table width=99% align=center  cellpadding=5 cellspacing=1 class="text1" bgcolor="#fff" border="1" style="table-layout:fixed">
		<tr bgcolor="<? echo $fondos[22];?>" class="textnegro2" align="center" >
		<td valign=top colspan=8 >&nbsp;</td>
		</tr>



<?
// 
$sql="select idc, dspedido, idproducto, dsref";//3
$sql.=", dsdesc, dspres, dscant, dsunidad, dsvalor";//8
$sql.=", dsdesct, dssubtotal, idpos, dsivax,dsflete";//12
$sql.=" from tblfacturasc a ";
$sql.="  where a.dspedido='$idpedido' ";
$sql.="  and dsres='$dsres'";//
$sql.=" and dsprefijo='$dsprefijo'";
$sql.=" order by a.idpos asc ";
//echo $sql;
$resultx = $db->Execute($sql);
if (!$resultx->EOF) {
//$dssubcategoria=$resultx->fields[0];

$dsletrerox=0;
	?>
	
		<tr bgcolor="<? echo $fondos[22];?>" class="textnegro2" align="center" >
		<td valign=top width="10%" ><strong>REF</strong></td>
		<td valign=top align=left  ><strong>DESCRIPCI&Oacute;N</strong></td>
		<td valign=top width="10%" ><strong>CANTIDAD</strong></td>
		<td valign=top width="10%" ><strong>% DTO</strong></td>
		<td valign=top width="8%"><strong>UNIDAD</strong></td>
		<td valign=top width="15%"><strong>LOGISTICA</strong></td>
		<td valign=top width="15%"><strong>PRECIO</strong></td>
		<td valign=top width="15%"><strong>VALOR</strong></td>
</tr>

	<?
	$fil=0;
	$subtotal=0;
	while(!$resultx->EOF){
	$subtotal=$subtotal+($resultx->fields[10]);
	$fil++;
	$ver="";
	if ($resultx->fields[10]=="0") {
		 $ver=" * ";
		 $dsletrerox++;
	}	 
	?>
	<tr bgcolor="#fff" class="text1" >
	<td valign=top align="center" ><? echo $resultx->fields[3]?></td>
	<td valign=top align="left" ><? echo $resultx->fields[4]?></td>
	<td valign=top align="center" width="10%" ><? echo $resultx->fields[6]?></td>
	<td valign=top align="center" width="10%"><? echo number_format($resultx->fields[9],0,'.','.')?></td>
	<td valign=top align="center" width="8%" ><? echo $resultx->fields[7]?></td>
		<td valign=top align="center" >$ <? echo number_format($resultx->fields[13],0,'.','.')?></td>
	<td valign=top align="center" >$ <? echo number_format($resultx->fields[8],0,'.','.')?></td>
	<td valign=top align="center" >$ <? echo number_format($resultx->fields[10],0,'','.')?> <? echo $ver;?></td>
	</tr>
	
	<?
	$resultx->MoveNext();
	}
	
	?>
	<tr bgcolor="<? echo $fondos[22];?>" class="textnegro2" align="center" >
	<td valign=top colspan=8 >&nbsp;</td>
	</tr>
	<tr bgcolor="<? echo $fondos[22];?>" class="textnegro2" align="center" >
	<td valign=top colspan=8 >&nbsp;</td>
	</tr>

	</table>


		<?
}
 $resultx->Close();
 // valor total
$total=$dstotal;
if ($subtotal==0) $subtotal=$dssubtotalx;

?>
<br>
<table width=99% align=center  cellpadding=5 cellspacing=1 class="text1" bgcolor="#fff" border="1" style="table-layout:fixed">

<tr bgcolor="#fff" class="textnegro1" align="left" >
		<td valign=top  colspan=3 align="left" rowspan="8" width=60%>
		

		
VALOR EN LETRAS <strong>
<span class="textnegrotitletras">
		  <?
		  $totalx=number_format($total,0,"","");
		  include ("func.convertir.numeros_dos.php");
		$x=num2letras($totalx). " Pesos M.L.";
		if ($letras=="100000") { 
			echo "<br>Cien mil Pesos M.L.";
		} else { 
			echo "<br>".$x;
		}	
		?>	
</span>		
		</strong>
<BR>		
<BR>		
		OBSERVACIONES:
		<br>
		<? echo $dsobs;?>
		<br>
		<br>
		<span class="textnegro1"><?echo $dsdescx?>
		<br>
		ENVIAR SOPORTE DE CONSIGNACION AL FAX 6040458 EXT 109 MEDELLIN
		<? if ($dsletrerox>0)?> <BR><BR>* ARTICULO EXENTO DE IVA
		</span>
		  </td>
		<td valign=top colspan="2" width=10% >SUBTOTAL</td>
		<td valign=top align="right" width=20%>$ <? echo number_format($dssubtotalx,0,'','.')?></td>
</tr>


<tr bgcolor="#fff" class="textnegro1" align="left" >
		<td valign=top colspan="2" >DESCUENTO
		<? // if ($dspordesct<>"" && $dspordesct<>"0") echo "<br>".$dspordesct." %";?>
		</td>
		<td valign=top align="right">$ <? echo number_format($descuentos,0,'','.')?></td>
</tr>


<tr bgcolor="#fff" class="textnegro1" align="left" >
		<td valign=top colspan="2">IVA</td>
		<td valign=top align="right">$ <? 
		echo number_format($dsiva,0,'','.')?></td>
</tr>
<tr bgcolor="#fff" class="textnegro1" align="left" >
		<td valign=top colspan="2">LOGISTICA</td>
		<td valign=top align="right">$ <? 
		echo number_format($dstotalflete,0,'','.')?></td>
</tr>


<tr bgcolor="#fff" class="textnegro1" align="left" >
		<td valign=top colspan="2" >RETEFUENTE</td>
		<td valign=top align="right">$ <? echo number_format($dsrete,0,'','.')?></td>
</tr>


<tr bgcolor="#fff" class="textnegro1" align="left" >
		<td valign=top colspan="2" >RETE IVA</td>
		<td valign=top align="right">$ <? echo number_format($dsreteiva,0,'','.')?></td>
</tr>
<tr bgcolor="#fff" class="textnegro1" align="left" >
  <td valign=top colspan="2" >RETE ICA </td>
  <td valign=top align="right">$ <? echo number_format($dsreteica,0,'','.')?></td>
</tr>


<tr bgcolor="#fff" class="textnegro1" align="left" >
		<td valign=top colspan="2" bgcolor="#fff" class="textnegro2"><strong>TOTAL</strong></td>
		<td valign=top align="right" class="textnegro2" bgcolor="#fff"><strong>$ <? echo number_format($total,0,'','.')?></strong></td>
</tr>
</table>
<br>
<table width=99% align=center  cellpadding=5 cellspacing=1 class="textnegro" bgcolor="#fff" border="1" style="table-layout:fixed">
<tr bgcolor="#fff" class="textnegro1" align="left" >
<td valign="top" align="left">
<p>Recibido por:</p>	    </td>

<td valign="top" align="left">
<p>Fecha Recibido:</p>	    </td>


<td valign="top" align="left">
<p>Elaborado por:</p>	    </td>
</tr>
<tr bgcolor="#fff" class="textnegro1" align="left" height=50>
<td valign="bottom" align="left">
<p>C.C. </p>	    </td>

<td valign="bottom" align="left">
<p>&nbsp;</p>	    </td>


<td valign="bottom" align="left">
<p>&nbsp;</p>	    </td>
</tr>

</table>

<table width=99% align=center  cellpadding=5 cellspacing=1 class="textnegro" bgcolor="#fff" border="0" style="table-layout:fixed">

<tr bgcolor="#fff" class="textnegro" align="left" >
		<td valign=top  align="center" width=75%>

<br>
		  <p >ESTA FACTURA DE VENTA SE ACOGE A LA LEY 1231 LA CUAL SE&Ntilde;ALA  QUE PARA TODOS LOS EFECTOS LEGALES DERIVADOS DEL CAR&Aacute;CTER DE T&Iacute;TULO VALOR DE LA  FACTURA, EL ORIGINAL FIRMADO POR EL EMISOR Y EL OBLIGADO, SER&Aacute; EL T&Iacute;TULO VALOR  NEGOCIABLE.<br>
ESTA FACTURA ES EXIGIBLE A SU VENCIMIENTO Y CAUSAR&Aacute;  INTERESES DE MORA A LA TASA M&Aacute;XIMA PERMITIDA POR LA LEY PARA LOS CR&Eacute;DITOS  ORDINARIOS.<br />		

          </p>	    
		  
		  <p>HAGA SU PAGO ANTES DE LA FECHA DE VENCIMIENTO PARA EVITAR EL  CORTE DE SU SERVICIO</p>	    		  
		  </td>
</tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="20"  bgcolor="#fff" class="textnegro" align="center">
    	Resoluci&oacute;n DIAN <?echo $dsresx." De ".$dsfechax.", Del Numero ".$idconsecini." al ".$idconsecfin.""?>
    
    </td>
  </tr>
</table>
<? if ($idactivo==4) echo "<span class=textnegrotitf><strong>ANULADA</strong></span>"; ?>