<?
/*
| ----------------------------------------------------------------- |
FrameWork Cf Para CMS CRM ECOMMERCE
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Area Investigacion y Desarrollo
  Area Diseno y Maquetacion
  Area Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// Tabla central de datos cuando se hacen los listados


	//$tablax=$prefix."tbltiposformularios";
 $result=$db->Execute($sql);
 if (!$result->EOF) {


$border=0;
if ($exportardatos==1) $border=1;
?>
<br>
<? if ($exportardatos==1) { ?>

<table width="100%" border="<? echo $border;?>" cellpadding="2" cellspacing="1" align="center" class="text1">
<tr>
	<td><? echo $titulomodulo?></td>
</tr>
</table>
<? } ?>

<table width="100%" border="<? echo $border;?>" cellpadding="2" cellspacing="1" align="center" class="text1">

<form action="<? echo $pagina;?>" method=post name=p>

<?

//echo $nombrecampos;
 if($_REQUEST['parametros']==104)$user="clasificado gratis,Usuario asociado,Arrendatario";
 $nombrecampos.="usuario,activo,$user";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		?>

 		<tr bgcolor="<? echo $fondo?>">


 			<?
 				for ($i=4; $i < $cantidad+4; $i++) {
			?>
				<td align="center"><? echo $result->fields[$i];?></td>
			<?}?>


		<td><? echo seldato("dsm","id","tblusuarios",$result->fields[0],2);?></td>

<?
if($_REQUEST['parametros']==104){
?>
		<td>
			<?
			$clasificado=$result->fields[1];
			if($clasificado==1){echo "SI";}
			if($clasificado==2){echo "NO";}
			?>
		</td>
<?}?>
		<td>
			<?
			$activo=$result->fields[2];
			if($activo==1){echo "SI";}
			if($activo==2){echo "NO";}
			if($activo==3){echo "DESTACADO";}
			?>
		</td>

<?
if($_REQUEST['parametros']==104){
$sqle="select idusuario ";
$sqle.=" from framecf_tblregistro_formularios a where id='".$result->fields[3]."'  and idformulario=".$_REQUEST['parametros'];
//echo "<br>";
//echo $sqle;
$resulte=$db->Execute($sqle);
if (!$resulte->EOF) {
$iduser=$resulte->fields[0];
?>
<td align="center">
	<? echo seldato("dsm","id","tblusuarios",$resulte->fields[0],2);?>
</td>

<?
}
$resulte->close();

}
?>

<?
if($_REQUEST['parametros']==104){
$sqle="select idarrendatario ";
$sqle.=" from framecf_tblregistro_formularios a where id='".$result->fields[3]."'  and idformulario=".$_REQUEST['parametros'];
//echo $sqle;
$resulte=$db->Execute($sqle);
if (!$resulte->EOF) {
$idarrendatario=$resulte->fields[0];
?>
<td align="center">
	<? echo seldato("dscampo3","id","framecf_tblregistro_formularios",$resulte->fields[0],2);
	   echo " ".seldato("dscampo5","id","framecf_tblregistro_formularios",$resulte->fields[0],2);
	?>
</td>

<?
}
$resulte->close();

} // fin del condicional if que valida el id del formulario
?>


		</tr>

		<?
		$contar++;
		$result->MoveNext();
	} // fin while
	if ($exportardatos<>1){
?>

</form>
</table>
<?}
	}
	 // fin si
$result->Close();

?>

