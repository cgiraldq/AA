<?

$sqle="select idusuario ";
$sqle.=" from crm_clientes a where id='$idy'";
//echo $sqle;
$resulte=$db->Execute($sqle);
if (!$resulte->EOF) {
$iduser=$resulte->fields[0];
}
$resulte->close();

 $sql="select a.id,a.dsm from tblusuarios a where idactivo=1 ";


   $result=$db->Execute($sql);
   		if (!$result->EOF) {
?>
<?
	$sqlm="select id,dsnombre from crmtblmotivos  where idactivo=1 order by dsnombre asc ";
			 $resultm=$db->Execute($sqlm);
   				if (!$resultm->EOF) {
?>
<tr style="" bgcolor="#f3f3f3"><td align="" colspan="4"><h1>Use este espacio para el ingreso de la gesti&oacute;n</h1></td></tr>

<tr>
	<td>Motivo de la llamada</td>
	<td>
		<select  style="width:80%" name="idmotivo">
			<option value="">-- Seleccionar --</option>
			<?

   			while(!$resultm->EOF) {
   				$id=$resultm->fields[0];
   				$dsm=$resultm->fields[1];
?>
	<option value="<? echo $id;?>"><? echo $dsm;?></option>


<?
$resultm->MoveNext();
}

?>
		</select>
	</td>

</tr>
<?
}
$resultm->Close();
?>

<tr>


	<td  width="50%">Ingrese el motivo o las observaciones de la gesti&oacute;n</td>
	<td width="50%">
		<textarea cols="45" name="dsobs" rows="6" class="text1"></textarea>
	</td>

</tr>

<tr>


	<td  width="50%">Indique la fecha para contactar al cliente. Si no la coloca, el sistema lo registra para el dia de hoy</td>
	<td width="50%">
<img align="absmiddle" SRC="../../../images/fechas.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechallamada', this,'','','','');" language="javaScript">
					<input type="text" readonly="readonly" class="text1" name="dsfechallamada" size="10" value="">

	</td>

</tr>



<? if($_REQUEST['nuevo']<>1){?>
<tr>
	<td>
		Este cliente se encuentra asociado al usuario:
	</td>
	<td>
		<? seldato("b.dsm","a.id"," crm_clientes a, tblusuarios b",$idy." and a.idusuario=b.id",1);?>
	<input type="hidden" name="idusuariorelacionado" value="<? echo $idy?>">
	</td>
</tr>
<?}?>

<tr>
		<td >Seleccione el usuario al cual se le asociar&aacute; esta gesti&oacute;n</td>
		<td>
	<select style="width:80%" name="idusuario"> <option value="0"> -- Seleccionar -- </option>
<?
   			while(!$result->EOF) {
   				$id=$result->fields[0];
   				$dsm=$result->fields[1];
?>
	<option value="<? echo $id;?>" <? if($_SESSION['i_idusuario']==$id || $id==$iduser)echo "selected='selected'";?> ><? echo $dsm;?></option>


<?
$result->MoveNext();
}
?>
</select>
</td>



</tr>
<?

}
$result->close();



?>

