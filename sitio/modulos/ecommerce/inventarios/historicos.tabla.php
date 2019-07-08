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

<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<form action="<? echo $pagina;?>" method=post name=p>
<tr><td colspan=<? echo $total?> align="center">
</td>
<td colspan=6 align="right">
</td></tr>
<?
// encabezado generico basado 
$nombrecampos="Id,Nombre,Descripcion,Cantidad,Fecha,Responsable,Factura,Pedido";
include("../../../incluidos_modulos/tabla.encabezado.php");

$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) { 
			$fondo=$fondo1;
		} else { 
			$fondo=$fondo2;		
		}
		$dsimg1=$result->fields[3];

		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
		  <td align="center" width="5%">
		  <? echo $result->fields[0]?>
			</td>
			<td align=center>
		  <? echo $result->fields[1]?>

			</td>

			
			  <td align="center">
		  <? echo $result->fields[3]?>
			</td>
			

			  <td align="center">
		  <? echo $result->fields[4]?>
			</td>


	  <td align="center">
		  <? echo $result->fields[2]?>
			</td>
			

	  <td align="center">
		  <? echo $result->fields[5]?>
			</td>


	  <td align="center">
		  <? echo $result->fields[6]?>
			</td>


	  <td align="center">
		  <? echo $result->fields[7]?>
			</td>
		
			</tr>
	
		<?
		$contar++;
		$result->MoveNext();
	} // fin while 
?>
<tr><td colspan=<? echo $total?> align="center">
</td></tr>
</form>

</table>
