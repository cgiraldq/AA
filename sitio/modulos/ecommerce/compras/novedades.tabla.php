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
<?
// encabezado generico basado 
$nombrecampos="Id,Num Pedido,Cliente,Fecha,Novedad";
include("../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF) {
		if ($contar%2==0) { 
			$fondo=$fondo1;
		} else { 
		
			$fondo=$fondo2;		
		}
		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
		<td align="center"><? echo $result->fields[0]?></td>
		<td align="center"><? echo $result->fields[1]?></td><!--numero pedido-->
		<? 
			$dsnombrescom=seldato("dsnombres","id","tblclientes",$result->fields[2],1);
			$dsapellidoscom=seldato("dsapellidos","id","tblclientes",$result->fields[2],1);
		?>

		<td align="center"><? echo $dsnombrescom." ".$dsapellidoscom; ?></td><!--cliente-->
		<td align="center" ><? echo $result->fields[4]?></td>
		<td align="center"><? echo $result->fields[5]?></td>
		
		  <td align="center">
		  <?	

		  $mrutax="Detalle Pedido";
		  $rutax="javascript:irAPaginaDN('../../proceso.pago.impresion.php?mostrarenlace=1&dscampo1=$dscampo1&idpedido=".$idpedido."&idclientepago=".$idclientepago."',100,100)";
		  include("../../incluidos_modulos/enlace.generico.php");?>
		  |


		  <?
		  $rutax=$pagina."?idx=".$result->fields[0]."&idpedido=$idpedido&id=$id&idclientepago=$idclientepago&idestado=$idestado&dsestado=$dsestado";
		  $formax="";
		  include("../../incluidos_modulos/enlace.eliminar.php");?>

		  </td>
		
		</tr>
		</form>
		<?
		$contar++;
		$result->MoveNext();
	} // fin while 
?>
<tr><td colspan=<? echo $total?> align="center">

</td></tr>
</table>
