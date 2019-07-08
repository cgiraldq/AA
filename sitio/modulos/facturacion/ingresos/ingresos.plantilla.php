<?
/*
| ----------------------------------------------------------------- |
MEGAPINTURAS LTDA
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
 Formato de impresion de datos del recibo de caja
*/
// datos del cliente
 $border=1;
$tabla="tblrecibos";
$sql="select dsrazon,dsnit,dsdir,dstele,dsfecha from $tabla where ";
$sql.=" dsnumero='".$idrecibo."'  limit 0,1 ";
//echo $sql;
$vermasx=$db->Execute($sql);
if (!$vermasx->EOF) { 
	$dsrazon=$vermasx->fields[0];
	$dsnit=$vermasx->fields[1];
	$dstele=$vermasx->fields[2];
	$dsdir=$vermasx->fields[3];
	$dsfecha=$vermasx->fields[4];
}
$vermasx->Close();

//  modificar nombre, telefono, vendedor




// mostrar ceros en el numero de recibo
$xceros="";
for ($i=0;$i<($posdatos-strlen($idrecibo));$i++){
	$xceros.="0";
}
$idmostrar=$xceros.$idrecibo;
?>	
<table width="100%" border="<?echo $border?>"  bgcolor="#fff"  cellpadding="0" cellspacing="0" align="center"  class="cont_general">
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">

		<table width=90% align=center border="0" bgcolor="#fff"  cellpadding=5 cellspacing="<? echo $cellspacing;?>" style="table-layout:fixed">	
		<tr bgcolor="<? echo $fondos[3];?>" class="text1">
		<td  valign=top  align="left">
		<span class="imprimir_tit_caja">
		<strong>
		<? echo $_SESSION['i_dsempresa']?>	
		<br />
		NIT: <?echo seldato('dsnit','idactivo','tblresoluciones','1 and id>0',1)?>
		</strong>
		</span>
		</td>
		<td  valign=top  align="right" class="imprimir_tit_caja">
		<strong>
		COMPROBANTE DE INGRESO 
		Nro. <span class="imprimir_tit_caja"><? echo $idmostrar;?></span>
		</strong>
		<br>
		<span class="imprimir_tit_datos_caja">
		FECHA: <? echo $dsfecha?>
		</span>
		</td>
		</tr>
		</table>
		<br/>
		<br/>
		<table width=90% align=center border="<?echo $border?>" bgcolor="#fff"   cellpadding=5 cellspacing="<? echo $cellspacing;?>"  style="table-layout:fixed" class="imprimir_tit_datos_caja">	
		<tr bgcolor="<? echo $fondos[3];?>" class="text1">
		<td  valign=top width=10%  >
		<strong>Cliente</strong></td>
		<td  valign=top width=40% ><? 	echo $dsrazon?></td>
		<td  valign=top width=10%  >
		<strong>Direcci&oacute;n</strong></td>
		<td  valign=top width=40% ><? 	echo $dsdir?></td>
		</tr>
		<tr bgcolor="<? echo $fondos[3];?>" class="text1">
		<td  valign=top  >
		<strong>NIT</strong></td>
		<td  valign=top ><? 	echo $dsnit?></td>

		<td  valign=top  >
		<strong>Tel&eacute;fono</strong></td>
		<td  valign=top ><?echo $dstele?></td>


		</tr>

		
</table>		
<br />
<br />

	<table width=90% align=center border="<?echo $border?>" bgcolor="#fff"  cellpadding=5 cellspacing=1 class="imprimir_tit_datos_caja"  border="<? echo $border;?>">
		
		<tr bgcolor="#f3f3f3" align="center"class="text1">
		<td  valign=top  width="15%"  ><span class=textnegro2><strong>FACTURA / PEDIDO	</strong></span></td>
		<td  valign=top    ><span class=textnegro2><strong>CONCEPTO			</strong></span></td>
		<td  valign=top  width="10%"  ><span class=textnegro2><strong>CUENTA			</strong></span></td>
		<td  valign=top  width="15%"  ><span class=textnegro2><strong>DEBITOS			</strong></span></td>
		<td  valign=top  width="15%"  ><span class=textnegro2><strong>CREDITOS			</strong></span></td>
		</tr>

		

<?
$sql="select * from $tabla where ";
$sql.=" dsnumero='".$idrecibo."'  order by idpos asc  ";

$vermay=$db->Execute($sql);
if (!$vermay->EOF) { 
$i=0;
while(!$vermay->EOF) {
$pos[$i]=$vermay->fields[14];
$i++;
$vermay->MoveNext();
}
}	
$vermay->Close();


$vermas=$db->Execute($sql);
if (!$vermas->EOF){ 
	$subtotal=0;
	$total=$vermas;
	$i=0;
	$fil=0;
	while(!$vermas->EOF) {
	$dscuenta=$vermas->fields[26];
	?>


		
		<tr bgcolor="<? echo $fondos[3];?>" align="center"class="text1">
		<td  valign=top  >
		<? 	
		//if ($pos[0]==$vermas->fields[14] && (count($pos)<=$total)) {
		//	echo $vermas->fields[14];
		//} elseif ($pos[$i+1]<>$vermas->fields[14] && (count($pos)<=$total)) { 
			echo $vermas->fields[14];
		//}

		if ($vermas->fields[20]=="2") {  // sumar
			$subtotal=$subtotal+($vermas->fields[18]);
			$credito="$ ".number_format($vermas->fields[18],0,'','.');
			$debito="";
		}elseif ($vermas->fields[20]=="1") { // restar
			$subtotal=$subtotal-($vermas->fields[18]);
			$debito="$ ".number_format($vermas->fields[18],0,'','.');
			$credito="";

		}
			?>
		</td>
		<td  valign=top  ><? echo $vermas->fields[17]?></td>
		<td  valign=top  ><? echo $vermas->fields[19]?></td>
		<td  valign=top  ><? echo $debito?></td>
		<td  valign=top  ><? echo $credito?></td>
		</tr>
<?
	$i++;
	$fil++;
	$dstxtbanco=$vermas->fields[27];
	$vermas->MoveNext();
	}
	
	$textoingreso="INGRESO ".$dstxtbanco;
	if ($dscuenta=="132505") 	$textoingreso=$dstxtbanco;
	?>
	<tr>
	<td colspan="5" valign=top >&nbsp;</td>
	</tr>
	<tr bgcolor="<? echo $fondos[3];?>" align="center"class="text1">
		<td valign=top >&nbsp;</td>
		<td valign=top ><? echo $textoingreso;?></td>
		<td valign=top ><? echo $dscuenta?></td>
		<td valign=top >$ <? echo number_format($subtotal,0,'','.')?></td>
		<td valign=top >&nbsp;</td>
	</tr>
		
	
<?	
	}
$vermas->Close();	
		?>

</table>		
<!--hr color="#CCCCCC" size="1" -->


	<table width=90% align=center  border="<?echo $border?>" bgcolor="#fff" cellpadding=5 cellspacing=1 class="imprimir_tit_datos_caja" border="<? echo $border;?>" style="table-layout:fixed">
		<tr><td colspan=4>&nbsp;</td></tr>
		<tr bgcolor="<? echo $fondos[3];?>" align="center"class="text1">
		<td  valign=top colspan="2" width="70%"><strong>SON</strong>: 
		<?include ($rutxx."../../incluidos_modulos/func.convertir.numeros_dos.php");
		$x=num2letras($subtotal). " Pesos M.L.";
		if ($letras=="100000") { 
			echo "<br>Cien mil Pesos M.L.";
		} else { 
			echo "<br>".$x;
		}	
		?>	
		</td>
		<td  valign=top  width="10%" ><strong>TOTAL</strong></td>
		<td  valign=top  width="20%" ><strong>$ <? echo number_format($subtotal,0,'','.')?></strong></td>
		</tr>
	</table>
	<table width=90% align=center border="0" bgcolor="#fff"  cellpadding=5 cellspacing=1 class="imprimir_tit_datos_caja" style="table-layout:fixed">
		<tr>
			<td colspan=3>&nbsp;</td>
		</tr>
		<tr>
			<td colspan=3>&nbsp;</td>
		</tr>
		<tr bgcolor="<? echo $fondos[3];?>" align="center"class="text1">
		<td  valign=top  ><strong>___________________________________________</strong></td>
		<td  valign=top  >&nbsp;</td>
		<td  valign=top  ><strong>___________________________________________</strong></td>
		</tr>
		
		<tr bgcolor="<? echo $fondos[3];?>" align="center"class="text1">
		<td  valign=top  >RECIBIDO POR</td>
		<td  valign=top  >&nbsp;</td>
		<td  valign=top  >FIRMA Y SELLO</td>
		</tr>

		</table>

	
		</td>
	</tr>
</table>