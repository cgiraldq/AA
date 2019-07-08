
<?
$id_agrupamiento=seldato("idagrupamiento","id"," framecf_tblregistro_formularios ",$_REQUEST['idy'],2);
$agrupamiento=$_REQUEST['agrupamiento'];
if($agrupamiento=="" && $agrupamiento<>"0" && $id_agrupamiento<>"" && $id_agrupamiento<>0) $agrupamiento=$id_agrupamiento;

$sql="select a.id,a.dsm,a.idformulario from framecf_tbltiposformulariosxcamposxagrupamiento a,tblagrupamientoxtblformularios b where idactivo=1 ";
$sql.=" and a.id=b.idorigen  and a.idformulario=$idx group by a.dsm";
 //echo $sql;
 $result=$db->Execute($sql);
   		if (!$result->EOF) {
   			 $idreferencia=$result->fields[2];
   		}
  $result->Close();

if($idreferencia<>""){
$sql="select a.id,a.dsm,a.idformulario from framecf_tbltiposformulariosxcamposxagrupamiento a,tblagrupamientoxtblformularios b where idactivo=1 ";
$sql.=" and a.id=b.idorigen group by a.dsm";
  //echo $sql;
   $result=$db->Execute($sql);
   		if (!$result->EOF) {
?>
<tr>
	<td align="center" style="font-size:12;width: 200px;">Seleccionar tipo</td>
	<td>
		<select name="agrupamiento" id="agrupamiento" style="width:100%" onchange="agrupamiento_campos('u');">
			<option value="0">-- Seleccionar --</option>
			<? while (!$result->EOF) {
				$id=$result->fields[0];
				$dsm=$result->fields[1];
			?>
				<option value="<? echo $id;?>" <? if($id==$agrupamiento) echo "Selected";?> ><? echo reemplazar($dsm);?></option>
			<?
			$result->MoveNext();
			}
			?>
		</select>
		<input type="hidden" name="idxx" value="104">
	</td>
<?
}
$result->Close();
}
?>


<?
if($idreferencia<>"" && $idx==104){
$sqle="select idusuario ";
$sqle.=" from framecf_tblregistro_formularios a where id='$idy'";
//echo $sqle;
$resulte=$db->Execute($sqle);
if (!$resulte->EOF) {
$iduser=$resulte->fields[0];
}
$resulte->close();

 $sql="select a.id,a.dsm from tblusuarios a where idactivo=1 ";
if($_SESSION['i_idperfil']<>1 && $enca=="") $sql.=" and id=".$_SESSION['i_idusuario'];
if($enca<>"") $sql.=" and id=".$idusuariox;

   $result=$db->Execute($sql);
   		if (!$result->EOF) {
?>
		<td align="center" style="font-size:12">Asesor inmobiliario</td>
		<td>
		<? if($_SESSION['i_idperfil']==1){?>	<select style="width:80%" name="idusuario"> <option> -- Seleccionar -- </option><?}?>
<?
   			while(!$result->EOF) {
   				$id=$result->fields[0];
   				$dsm=$result->fields[1];
?>
			<? if($_SESSION['i_idperfil']==1){?><option value="<? echo $id;?>" <? if($_SESSION['i_idusuario']==$id || $id==$iduser)echo "selected='selected'";?> ><? echo $dsm;?></option> <?}?>
<?			 if($_SESSION['i_idperfil']<>1){?>

				<input readonly="readonly" type="text" name="dsusuario" value="<? echo $dsm;?>"> <input type="hidden" name="idusuario" value="<? echo $id;?>"> 

<?}?>

<?
$result->MoveNext();
}
?>
<? if($_SESSION['i_idperfil']==1){?></select> <?}?>
</td>
</tr>
<?

}
$result->close();

}

?>

