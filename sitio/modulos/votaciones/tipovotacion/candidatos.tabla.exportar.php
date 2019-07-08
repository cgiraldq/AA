<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- | 
*/
// Tabla central de datos cuando se hacen los listados
?>
<br>

<table width="100%" border="1" cellpadding="2" cellspacing="1" align="center" class="text1">
<?
// encabezado generico basado 
$nombrecampos="Id,Nombre,Cedula,Codigo,Fecha,Activo,Zona";
$exportardatos=1;
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
  
	while (!$result->EOF) {
		if ($contar%2==0) { 
			$fondo=$fondo1;
		} else { 
			$fondo=$fondo2;		
		}
		$dsfoto=$result->fields[10];
		
		// traer cedula
		$sqlx="select dscodigo from  tblvotacionasociados_temp where idnits=".$result->fields[1];
		
		//echo $sql;
		$resultx=$db->Execute($sqlx);
		if (!$resultx->EOF) {
			$dscedula=$resultx->fields[0];
		
		}
		$resultx->Close();
		
		?>
		 <tr >
		  <td align="center" width="15%">
		  <? echo $result->fields[0]?>
			</td>
			  
			
			  
			  <td align="center">
		  <strong><? echo $result->fields[5]?></strong>
		  </td>
	
	<td align="center">
		  <strong><? echo $dscedula?></strong>
		  </td>
	
	<td align="center">
		  <strong><? echo $result->fields[7]?></strong>
		  </td>
	
	<td align="center">
		  <strong><? echo $result->fields[8]?></strong>
		  </td>
	
	
	
	
			  <td align="center">
		  <? 
		  if ($result->fields[2]==1) echo "Pendiente";
		  if ($result->fields[2]==2) echo "Faltan datos";
		  if ($result->fields[2]==3) echo "Exitosa";
		  ?>
		  
		  </td>
			
			
			<td align="center">
		  <? echo ($result->fields[11]);?>
			</td>
			
			
			
			
		  
			</tr>
	
		<?
		$result->MoveNext();
	} // fin while 
?>

</table>
