<? $totales=0;
for ($i=0;$i<=$filasdatos;$i++) { ?>
	 <?
	$sql="select  ";
	$sql.="id, idclientepedido, idpedido, idproducto, idcant";//4
	$sql.=",idcolor, idcliente, dsfecha, idprecio, dspordescuento";//9
	$sql.=", dsdescuento, dsiva, dsporiva, dstotal, dspin, dsd";//15
	$sql.=", idestado, idtipocomp, idpromocion, idip, dspara";//20
	$sql.=", dsciudadenvio, dsvalorenvio, dsdireccionenvio";//23
	$sql.=", dstelefonoenvio, dsmensajeenvio, dsobsenvio";//26
	$sql.=", dsnombreproducto, idpos, idconsec, dsfechaenvio";//30
	$sql.=", dshoraenvio, dstipodirenvio, dstipoenvio, dszonaenvio";//34
	$sql.=", idtienda, dsvalorflete, dstalla, dscolor";//38
	$sql.=" from tblcompras a ";
	$sql.="  where a.idpedido='".$pedido."' and idconsec='$i'";
		$vermas=$db->Execute($sql);
		if (!$vermas->EOF) {
		$totales=$totales+$vermas->fields[4];
		$dsref=seldato('dsreferencia','id','tblproductos',$vermas->fields[3],2);
		$dscant=$vermas->fields[4];
		$dsun=$vermas->fields[38];
		$dsvalor=$vermas->fields[8];
		$dsdesc=seldato('dsm','id','tblproductos',$vermas->fields[3],2);
		$dspres=seldato('dsunidad','id','tblproductos',$vermas->fields[3],2);
		$dssubtotalx=$vermas->fields[8]*$vermas->fields[4];
		$dsdesct=$vermas->fields[9];
		$idproducto=$vermas->fields[3];
	    $dsivax=$vermas->fields[12];
	    $dsvaloriva=$vermas->fields[11];
	    $dsfletex=$vermas->fields[36];
	    if($dsdesc=="") $dsdesc=0;
	    if($dsfletex=="")$dsfletex=0;
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
		$dsvaloriva="";
		$dsfletex="";
		}$vermas->Close();


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
<td width="5%" class="textnegro2"><input type=button class="textnegrotit eliminar" value='' name='enviar'  title="Quitar"></td>
<td width="12%" class="textnegro2"><? // echo $fila->idproducto;?>
  <input type='text' name="dsref[]" class='link_negro1' value='<? echo $dsref?>' size='10' maxlength=100 id="dsref[]" >
</td>

<td width="5%" class="textnegro2"><? // echo $fila->idproducto;?>
   <input type=text name='dsun[]' class='link_negro1'  value='<? echo $dsun?>' size=5>
</td>

<td  width="20%" class="textnegro2"><? // echo $fila->idproducto;?>
  <input type='text' name="dsdesc[]" class='link_negro1' value='<? echo $dsdesc?>' size='30' maxlength=255 id="dsdesc[]" >
</td>


<td width="10%" class="textnegro2"><? // echo $fila->idproducto;?>
  <input type='text' name="dsdesct[]" class='link_negro1' value='<? echo $dsdesct?>' size='10' maxlength=10 id="dsdesct[]">
</td>
<td width="10%" class="textnegro2"><? // echo $fila->idproducto;?>
  <input type='text' name="dsfletex[]" class='link_negro1' value='<? echo $dsfletex?>' size='10' maxlength=10 id="dsfletex[]" >
</td>
<td width="10%" class="textnegro2"><? // echo $fila->idproducto;?>
  <input type='text' name="dsvalor[]" class='link_negro1' value='<? echo $dsvalor?>' size='10' maxlength=10 id="dsvalor[]" >
</td>


<td width="6%" class="textnegro2"><? // echo $fila->idproducto;?>
  <input type='text' name="dscant[]" class='link_negro1' value='<? echo $dscant?>' size='10' maxlength=10 id="dscant[]" >
</td>


<td width="8%" class="textnegro2"><input type='text' name='dssubtotal[]' class='link_negro1' value='<? echo $dssubtotalx;?>' size='10' maxlength=20 onKeyPress="mostrarcapa(<? echo ($i+1);?>,event)" id='dssubtotal[]'>

<input type='hidden' name='idpos[]' class='forma2' value='<? echo $i;?>' id='idpos[]'>
<input type='hidden' name='dsivax[]' class='forma2' value='<? echo $dsivax;?>' id='dsivax[]'>
<input type='hidden' name='dsivaxx[]' class='forma2'  id='dsivaxx[]' value="<?echo $dsvaloriva?>">
<input type='hidden' name='dsfletex[]' class='forma2'  id='dsfletex[]' value=<?echo $dsfletex?>>

</td>
</td>
	</tr>
	</table>
	</div>
	<? 	} // FIN FOR?>
	<br>	

<table width=90% align=center  bgcolor="<? echo $fondos[4];?>"  style="table-layout:fixed">		
<tr bgcolor="<? echo $fondos[3];?>" align="left">
<td valign=top colspan="5" >&nbsp;</td>		
<td valign=top width="20%" class="text_blanco"><strong>SUBTOTAL</strong></td>
		<td valign=top ><input type="text" name="subtotalvalor" class="textnegro2" value="<? echo $dssubtotal;?>" size="15" readonly></td>
</tr>

		<tr bgcolor="<? echo $fondos[3];?>" align="left">
<td valign=top colspan="5" >&nbsp;</td>		
<td valign=top width="10%" class="text_blanco"> <strong style="margin: 0 10px 0 0">DESCUENTO % </strong><input type="text" name="portotaldescuento" class="textnegro2" size="3"  value="<? echo $dspordesct;?>" readonly>
</td>
<td valign=top ><input type="text" name="totaldescuento" class="textnegro2" value="<? echo $dsdesctx;?>" size="15"  maxlength="20" readonly></td>
</tr>



<tr bgcolor="<? echo $fondos[3];?>" align="left">		
<td valign=top colspan="5" >&nbsp;</td>		
<td valign=top width="10%" class="text_blanco"><strong>IVA</strong></td>
<td valign=top ><input type="text" name="totaliva" class="textnegro2" value="<? echo $xdsivax;?>" size="15" readonly></td>
</tr>
<tr bgcolor="<? echo $fondos[3];?>" align="left">		
<td valign=top colspan="5" >&nbsp;</td>		
<td valign=top width="10%" class="text_blanco"><strong>LOGISTICA</strong></td>
<td valign=top ><input type="text" name="totalflete" class="textnegro2" value="<? echo $xdsfletex;?>" size="15" readonly></td>
</tr>

	<tr bgcolor="<? echo $fondos[3];?>" align="left">		
<td valign=top colspan="5" >&nbsp;</td>		
		<td valign=top width="10%" class="text_blanco"><strong>RETEFUENTE</strong></td>
		<td valign=top ><input type="text" name="totalrete" class="textnegro2" value="<? echo $dsrete;?>" size="15" readonly></td>
</tr>
	<tr bgcolor="<? echo $fondos[3];?>" align="left">		
<td valign=top colspan="5" >&nbsp;</td>		
		<td valign=top width="10%" class="text_blanco"><strong>RETE IVA</strong></td>
		<td valign=top ><input type="text" name="totalreteiva" class="textnegro2" value="<? echo $dsreteiva;?>" size="15" readonly></td>
</tr>


	<tr bgcolor="<? echo $fondos[3];?>" align="left">		
<td valign=top colspan="5" >&nbsp;</td>		
		<td valign=top width="10%" class="text_blanco"><strong>RETE ICA</strong></td>
		<td valign=top ><input type="text" name="totalreteica" class="textnegro2" value="<? echo $dsreteica;?>" size="15" readonly></td>
</tr>

		<tr bgcolor="<? echo $fondos[3];?>" align="left">
<td valign=top colspan="5" >&nbsp;</td>		
		<td valign=top class="text_blanco"><strong>TOTAL</strong></td>
		<td valign=top><input type="text" name="totalvalor" class="textnegro2" value="<? echo $dstotal;?>" size="15" readonly></td>
		</tr>
		
		<tr bgcolor="<? echo $fondos[4];?>" align=center>
<td valign=top colspan="5" >&nbsp;</td>				
			<td valign=top align="right" colspan="2">
			
				<input type=button name=enviar value="Generar" class="botones" onClick="valx();" >
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
<input type='hidden' name='pedidox' class='forma2'  id='pedidox' value="<?echo $pedido?>">
<input type='hidden' name='r' class='forma2'  id='r' value="<?echo $_REQUEST['r']?>">
<!--  FIN DATOS DEL CLIENTE PARA PROCESOS DE IMPUESTOS -->				

</td>
		</tr>
</table>