<?$totales=0;
for ($i=0;$i<=$filasdatos;$i++) { ?>
 <?
	$sql="select idc, dspedido, idproducto, dsref";//3
	$sql.=", dsdesc, dspres, dscant, dsunidad, dsvalor";//8
	$sql.=", dsdesct, dssubtotal, idpos, dsivax,dsflete";//13
	$sql.=",dsporiva,dsvaloriva ";//15
	$sql.=" from tblfacturasc a ";
	$sql.="  where a.dspedido='$idpedido' and idpos='$i'";
	//echo $sql;
	$resulty = $db->Execute($sql);
    if (!$resulty->EOF) { 
		
		$totales=$totales+$resulty->fields[6];
		$dsref=$resulty->fields[3];
		$dscant=$resulty->fields[6];
		$dsun=$resulty->fields[7];
		$dsvalor=$resulty->fields[8];
		$dsdesc=$resulty->fields[4];
		$dspres=$resulty->fields[5];
		$dssubtotalx=$resulty->fields[10];
		$dsdesct=$resulty->fields[9];
		$idproducto=$resulty->fields[2];
		$dsivax=$resulty->fields[14];
		$dsfletex=$resulty->fields[13];
		$dsvalorivax=$resulty->fields[15];

	} else { 
		// treaer datos si existe idpedidoy
		if ($idpedidoy<>"") { 

		$sql="select idc, dspedido, idproducto, dsref";//3
	    $sql.=", dsdesc, dspres, dscant, dsunidad, dsvalor";//8
	    $sql.=", dsdesct, dssubtotal, idpos,dsivax,dsflete";//13
	    $sql.=",dsporiva,dsvaloriva ";//15
      	$sql.=" from tblfacturasc a ";
		$sql.="  where a.dspedido='$idpedidoy' and idpos='$i'";
			//echo $sql;
		$resultm = $db->Execute($sql);
		if (!$resultm->EOF) { 
		$totales=$totales+$resultm->fields[6];
		$dsref=$resultm->fields[3];
		$dscant=$resultm->fields[6];
		$dsun=$resultm->fields[7];
		$dsvalor=$resultm->fields[8];
		$dsdesc=$resultm->fields[4];
		$dspres=$resultm->fields[5];
		$dssubtotalx=$resultm->fields[10];
		$dsdesct=$resultm->fields[9];
		$idproducto=$resultm->fields[2];
		$dsivax=$resultm->fields[14];
		$dsfletex=$resultm->fields[13];
		$dsvalorivax=$resultm->fields[15];
		if($dsivax=="")$dsivax=0;
			   } else { 
			   		$dsref="";
					$idproducto="";
					$dscant="";
					$dsun="";
					$dsvalor="";
					$dsdesc="";
					$dssubtotalx="";	
					$dspres="";
					$dsdesct="";
					$dsivax="";
					$dsvalorivax="";
					$dsfletex="";
			   }
			  $resultm->Close();
			
		
		} else { 
		$dsref="";
		$idproducto="";
		$dscant="";
		$dsun="";
		$dsvalor="";
		$dsdesc="";
		$dssubtotalx="";	
		$dspres="";
		$dsdesct="";
		$dsivax="";
		$dsvalorivax="";
		$dsfletex="";
		}
		
	}
	$resulty->close();


if ($mod=="")	 { 
	if ($i<$filamostrar) { 
		$sd="";
	} else { 
		$sd="none";
	}	
} else { 
	
}	
		?>
 <div id="capaprod_<? echo $i;?>" style="display:<? echo $sd;?>">
<table width=90% align=center  border="1"   class="campos_ingreso" style="border-color:#ccc; table-layout:fixed" >
<tr class='text' bgcolor='<? echo $fondos[3];?>' align=center>
<td width="5%" class="textnegro2"><input type=button class="textnegrotit eliminar" value='' name='enviar' onClick='quitarcapa(<? echo $i;?>)' title="Quitar"></td>
<td width="12%" class="textnegro2"><? // echo $fila->idproducto;?>
  <input type='text' name="dsref[]" class='link_negro1' value='<? echo $dsref?>' size='10' maxlength=100 id="dsref[]" onKeypress="moverfoco(2,'dsun[]',<? echo $i;?>)">
</td>

<td width="5%" class="textnegro2"><? // echo $fila->idproducto;?>
   <input type=text name='dsun[]' class='link_negro1' onBlur="validarvalor(<? echo $i?>);" value='<? echo $dsun?>' size=5 onKeypress="moverfoco(2,'dsdesc[]',<? echo $i;?>)">
</td>

<td  width="20%" class="textnegro2"><? // echo $fila->idproducto;?>
  <input type='text' name="dsdesc[]" class='link_negro1' value='<? echo $dsdesc?>' size='30' maxlength=255 id="dsdesc[]" onKeypress="moverfoco(2,'dsdesct[]',<? echo $i;?>)">
</td>


<td width="10%" class="textnegro2"><? // echo $fila->idproducto;?>
  <input type='text' name="dsdesct[]" class='link_negro1' value='<? echo $dsdesct?>' size='10' maxlength=10 id="dsdesct[]" onKeypress="moverfoco(2,'dsfletex[]',<? echo $i;?>)">
</td>
<td width="10%" class="textnegro2"><? // echo $fila->idproducto;?>
  <input type='text' name="dsfletex[]" class='link_negro1' value='<? echo $dsfletex?>' size='10' maxlength=10 id="dsfletex[]" onKeypress="moverfoco(2,'dsvalor[]',<? echo $i;?>)">
</td>
<td width="10%" class="textnegro2"><? // echo $fila->idproducto;?>
  <input type='text' name="dsvalor[]" class='link_negro1' value='<? echo $dsvalor?>' size='10' maxlength=10 id="dsvalor[]" onKeypress="moverfoco(2,'dscant[]',<? echo $i;?>)">
</td>


<td width="6%" class="textnegro2"><? // echo $fila->idproducto;?>
  <input type='text' name="dscant[]" class='link_negro1' value='<? echo $dscant?>' size='10' maxlength=10 id="dscant[]" onBlur="calcularsubtotal(<? echo $i?>);" onKeypress="moverfoco(2,'dssubtotal[]',<? echo $i;?>)">
</td>


<td width="8%" class="textnegro2"><input type='text' name='dssubtotal[]' class='link_negro1' value='<? echo $dssubtotalx;?>' size='10' maxlength=20 onKeyPress="mostrarcapa(<? echo ($i+1);?>,event)" id='dssubtotal[]'>

<input type='hidden' name='idpos[]' class='forma2' value='<? echo $i;?>' id='idpos[]'>
<input type='hidden' name='dsivax[]' class='forma2' value='<? echo $dsivax;?>' id='dsivax[]'>
<input type='hidden' name='dsivaxx[]' class='forma2'  id='dsivaxx[]' value="<?echo $dsvalorivax?>">
</td>
</td>
	</tr>
	</table>
	</div>
	<? 	} // FIN FOR?>
	<br>	

<table width=70% align=center  cellpadding=1  border="0" cellspacing=2 bgcolor="<? echo $fondos[4];?>"  style="table-layout:fixed" class="campos_factura">		
<tr bgcolor="<? echo $fondos[3];?>" align="left">
<td valign=top colspan="5" >&nbsp;</td>		
<td valign=top width="20%" class="text_blanco"><strong>SUBTOTAL</strong></td>
		<td valign=top ><input type="text" name="subtotalvalor" class="textnegro2" value="<? echo $dssubtotal;?>" size="15" onBlur="totales();"></td>
</tr>

		<tr bgcolor="<? echo $fondos[3];?>" align="left">
<td valign=top colspan="5" >&nbsp;</td>		
<td valign=top width="10%" class="text_blanco"><strong style="margin: 0 10px 0 0">DESCUENTO % </strong>
<input type="text" name="portotaldescuento" class="textnegro2" size="3" onBlur="totales();" value="<? echo $dspordesct;?>" readonly>
</td>
		<td valign=top ><input type="text" name="totaldescuento" class="textnegro2" value="<? echo $dsdesctx;?>" size="15" onBlur="totales();" maxlength="20" readonly></td>
</tr>



<tr bgcolor="<? echo $fondos[3];?>" align="left">		
<td valign=top colspan="5" >&nbsp;</td>		
<td valign=top width="10%" class="text_blanco"><strong>IVA</strong></td>
<td valign=top ><input type="text" name="totaliva" class="textnegro2" value="<? echo $dsiva;?>" size="15" onBlur="totales();"></td>
</tr>
<tr bgcolor="<? echo $fondos[3];?>" align="left">		
<td valign=top colspan="5" >&nbsp;</td>		
<td valign=top width="10%" class="text_blanco"><strong>VALOR FLETE</strong></td>
<td valign=top ><input type="text" name="totalflete" class="textnegro2" value="<? echo $dsfelte;?>" size="15" onBlur="totales();"></td>
</tr>

	<tr bgcolor="<? echo $fondos[3];?>" align="left">		
<td valign=top colspan="5" >&nbsp;</td>		
		<td valign=top width="10%" class="text_blanco"><strong>RETEFUENTE</strong></td>
		<td valign=top ><input type="text" name="totalrete" class="textnegro2" value="<? echo $dsrete;?>" size="15" onBlur="totales();"></td>
</tr>
	<tr bgcolor="<? echo $fondos[3];?>" align="left">		
<td valign=top colspan="5" >&nbsp;</td>		
		<td valign=top width="10%" class="text_blanco"><strong>RETE IVA</strong></td>
		<td valign=top ><input type="text" name="totalreteiva" class="textnegro2" value="<? echo $dsreteiva;?>" size="15" onBlur="totales();"></td>
</tr>


	<tr bgcolor="<? echo $fondos[3];?>" align="left">		
<td valign=top colspan="5" >&nbsp;</td>		
		<td valign=top width="10%" class="text_blanco"><strong>RETE ICA</strong></td>
		<td valign=top ><input type="text" name="totalreteica" class="textnegro2" value="<? echo $dsreteica;?>" size="15" onBlur="totales();"></td>
</tr>

		<tr bgcolor="<? echo $fondos[3];?>" align="left">
<td valign=top colspan="5" >&nbsp;</td>		
		<td valign=top class="text_blanco"><strong>TOTAL</strong></td>
		<td valign=top><input type="text" name="totalvalor" class="textnegro2" value="<? echo $dstotal;?>" size="15" onBlur="totales();"></td>
		</tr>
		
		<tr bgcolor="<? echo $fondos[4];?>" align=center>
<td valign=top colspan="5" >&nbsp;</td>				
			<td valign=top align="right" colspan="2">
			
				<input type=button name=enviar value="Guardar" class="botones" onClick="valI();" >
			
				<input type=hidden name=inn value="1">
				<input type=hidden name=mod value="<? echo $mod;?>">
				<input type=button name=enviar value="Regresar" class="botones" onClick="irAPaginaD('<?echo $rrx?>');">	
				<input type="hidden" name="dsfechac" value="<? echo $dsfechac;?>" >
<!--  DATOS DEL CLIENTE PARA PROCESOS DE IMPUESTOS -->				
<br>


<input type="hidden" name="dsclienterete" value="<? echo $dsclienterete?>" id="dsclienterete">
<input type="hidden" name="dsclientereteiva" value="<? echo $dsclientereteiva?>" id="dsclientereteiva">
<input type="hidden" name="dsclienteretica" value="<? echo $dsclienteretica?>" id="dsclienteretica">
<input type="hidden" name="dsclientelista" value="<? echo $dsclientelista?>" id="dsclientelista">
<input type="hidden" name="dsclientedescuento" value="<? echo $dsclientedescuento?>" id="dsclientedescuento">
<input type="hidden" name="dsclientedsdiasv" value="<? echo $dsclientedsdiasv?>" id="dsclientedsdiasv">

<!--  FIN DATOS DEL CLIENTE PARA PROCESOS DE IMPUESTOS -->				

</td>
		</tr>
</table>