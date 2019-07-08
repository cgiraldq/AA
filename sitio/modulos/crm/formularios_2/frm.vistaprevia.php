<?
include("../../incluidos_modulos/varconexion.php");

// extraer datos de remate
		$idx=$_REQUEST['idx'];
        $sql="select id,dsm,dsr,idactivo,idtipo from framecf_tbltiposformularios where id=$idx and idactivo=1";
           
        $result=$db->Execute($sql);
        if(!$result->EOF){
		$dsm=$result->fields[1];

	   
		
?>
<script src="../../js_modulos/javageneral.js" type="text/javascript"></script>
<h1><? echo $dsm;?></h1>
<article class="bloque_texto">
<?
$sqlx="select a.id,a.dsm,a.dsmensaje,a.idtipo,a.idoblig,a.idposn from framecf_tbltiposformulariosxcampo a where id>0 and idtipoformulario=$idx ";
$sqlx.="and idactivo not in(9)";
$sqlx.=" order by a.idposn asc ";

 $resultx=$db->Execute($sqlx);
if(!$resultx->EOF){
?>
<article class="cont_frm_contacto">
	<form action="modulos/validaciones/contacto.php" name="frm_contacto" method="post" id="frm_contacto">
<?
while(!$resultx->EOF){
$id=$resultx->fields[0];
$dsm=$resultx->fields[1];
$dsmcampo=strtolower($resultx->fields[1]);
$dsmensaje=$resultx->fields[2];
$idtipo=$resultx->fields[3];

$forma="frm_contacto";
			/*$param="captcha";*/
$param=$dsm;
//if($param<>"")$param.=",";

?>
	<? 
	if($idtipo==1){ 
	?>
		
		<fieldset>
			<label for="<? echo $dsmcampo;?>"><? echo $dsm;?></label>
			<div><input type="text" name="<? echo $dsmcampo;?>" id="<? echo $dsmcampo;?>" ></div>
			<span class="camp_requerido" id="capax_<? echo $dsmcampo;?>" style="display:none;"><? echo $dsmensaje;?></span>
		</fieldset>
	<?}?>

	<?
	if($idtipo==2){ 
	?>
		<fieldset class="textarea">
			<label for="<? echo $dsmcampo;?>"><? echo $dsm;?></label>
			<div><textarea name="<? echo $dsmcampo;?>" id="<? echo $dsmcampo;?>"></textarea></div>
			<span class="camp_requerido" id="capax_<? echo $dsmcampo;?>" style="display:none;"><? echo $dsmensaje;?></span>
		</fieldset>
	<?}?>

	<? 
	if($idtipo==3){ 
	?>
		
		<fieldset>
			<label for="<? echo $dsmcampo;?>"><? echo $dsm;?></label>
			<div><input type="password" name="<? echo $dsmcampo;?>" id="<? echo $dsmcampo;?>" ></div>
			<span class="camp_requerido" id="capax_<? echo $dsmcampo;?>" style="display:none;"><? echo $dsmensaje;?></span>
		</fieldset>
	<?}?>

	<? 
	if($idtipo==4){ 
	?>
		
		<fieldset>
			<label for="dstipo"><? echo $dsm;?> * <? echo $iscampo;?></label>
			<div>
				<select style="width:20%" name="<? echo $dsmcampo;?>" id="<? echo $dsmcampo;?>">
					<option value=""> -- Seleccionar -- </option>
					<?
$sqlz="select a.id,a.dsm,a.idpos,a.idactivo,a.dsvalor from framecf_tbltiposformulariosxcampos a where a.idactivo NOT IN(9) and a.idcampo=$id ";
//$sqlz.=" ORDER BY a.idpos ASC ";	
//echo $sqlz;
 $resultz=$db->Execute($sqlz);
        if(!$resultz->EOF){	
        while(!$resultz->EOF){	
        $dsm=$resultz->fields[1];		
     ?>
					<option value=""><? echo $dsm;?></option>
	<?
	$resultz->MoveNext();
     }
     }
$resultz->Close();
	?>			

				</select>
			</div>
			<span class="camp_requerido" id="capax_dstipo" style="display:none;"></span>
		</fieldset>
	<?}?>
		
	<?
$resultx->MoveNext();
     }
?>
<? include("../../incluidos_modulos/captcha.php");?>
		<fieldset class="btns">
			<input type="button" value="Enviar" class="btn_general" 
					onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rut ?>');">
			<input type="reset" value="Cancelar" class="btn_general">
			

		</fieldset>
	</form>
</article>
<?
}
$resultx->Close();
?>

</article>
<?
}
$result->Close();
?>


<?
			$forma="frm_contacto";
			/*$param="captcha";*/
			$param="dsnombre,dsapellidos,dstelefono,dscorreo,dsciudad,dscom,captcha";
?>