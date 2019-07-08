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
if ($exportardatos<>1){
	include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
}
	//$tablax=$prefix."tbltiposformularios";
     $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
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

<? if ($exportardatos<>1){?>


<?}
// encabezado generico basado
//echo $sql;

//
if($_REQUEST['idxx']==1)$exportardatos=1;
 if($_REQUEST['idxx']==104)$user=",Clasificado gratis,Usuario asociado,Arrendatario";
$nombrecampos.="Fecha,Fecha modificaci&oacute;n,Activo $user";
 $nombrecampos=trim($nombrecampos,',');
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");

$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		?>

 		<tr bgcolor="<? echo $fondo?>"onMouseOut="mOut(this,'<? echo $fondo;?>');"
 			onMouseOver="mOvr(this,'<? echo $fondo3;?>');">

 		<td  align="center"> <? echo str_pad($result->fields[4],4,"0", STR_PAD_LEFT);?>

 			<?
 				for ($i=5; $i < $cantidad+5; $i++) {
			?>
				<td align="center"><? echo ellistr($result->fields[$i],100);?></td>
			<?}?>

		<td align="center">
				   <? 
				   if ($result->fields[0]==1) echo "SI";
				   if ($result->fields[0]==2) echo "NO";
				  if($idxx==104){
					  if ($result->fields[0]==3) echo "Destacado Home";
					  if ($result->fields[0]==4) echo "Destacado Lateral";
				  }?>
		  </td>


		
<?
if($_REQUEST['idxx']==104){
$sqle="select idclasgratis ";
$sqle.=" from $dsmform a where id=".$result->fields[3]." ";
//echo $sqle;
$resulte=$db->Execute($sqle);
if (!$resulte->EOF) {
$idclasgratis=$resulte->fields[0];
?>
<td align="center">
	<? 
	if ($idclasgratis=="1") echo "SI";
	if ($idclasgratis=="2") echo "NO";

	?>
</td>

<?
} else {
	?>
	<td></td>
	<?
}
$resulte->close();

}
?>



<?
if($_REQUEST['idxx']==104){
$sqle="select idusuario ";
$sqle.=" from $dsmform a where id=".$result->fields[3];
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
if($_REQUEST['idxx']==104){
$sqle="select idarrendatario ";
$sqle.=" from $dsmform a where id=".$result->fields[3]." ";
//echo $sqle;
$resulte=$db->Execute($sqle);
if (!$resulte->EOF) {
$idarrendatario=$resulte->fields[0];
?>
<td align="center">
	<? echo seldato("primer_nombre","id","crm_clientes",$resulte->fields[0],2);
	   echo " ".seldato("primer_apellido","id","framecf_tblregistro_formularios",$resulte->fields[0],2);
	?>
</td>

<?
} else {
	?>
	<td></td>
	<?
}
$resulte->close();

}
?>



		  <td align="center">
		  </td>



		</tr>

		<?
		$contar++;
		$result->MoveNext();
	} // fin while

?>

</form>
</table>
<?
	}
	 // fin si
$result->Close();


?>

