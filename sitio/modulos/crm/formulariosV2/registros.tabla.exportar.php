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
 $nombrecampos.="Usuario,clasificado gratis,activo";
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
 				for ($i=3; $i < $cantidad+3; $i++) {
			?>
				<td align="center"><? echo $result->fields[$i];?></td>
			<?}?>

		<td><? echo seldato("dsm","id","tblusuarios",$result->fields[0],2);?></td>

		<td>
			<?
			echo $result->fields[1];
			?>
		</td>

		<td>
			<?
			echo $result->fields[2];
			?>
		</td>


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

