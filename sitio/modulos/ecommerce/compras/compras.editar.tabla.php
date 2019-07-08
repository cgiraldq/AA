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
<?
// encabezado generico basado 
$exportardatos=1;
$nombrecampos="Id,Producto,Color,Tipo,Valor,Iva,Subtotal,Pin,Opciones";
include("../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) { 
			$fondo=$fondo1;
		} else { 
			$fondo=$fondo2;		
		}
		if($result->fields[13]==1){
			$tbl="tblproductos";
			$tbl2="tblcoloresprod";
		}else{
			$tbl="tblaccesorios";
			$tbl2="tblcoloresacc";
		}
		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
		<td align="center"><? echo $result->fields[0]?></td>
		<td align="center" ><? echo seldato("dsm","id",$tbl,$result->fields[1],1)?></td>
		<td align="center"><? echo seldato("dsm","id",$tbl2,$result->fields[2],1)?></td>
		<td align="center" ><? echo $result->fields[3]?></td>
		<td align="center"><? echo $result->fields[4]?></td>

		<td align="center"><? echo $result->fields[11]?></td> 
		<td align="center"><? echo $result->fields[12]?></td> 	
		 <td align="center"><? echo $result->fields[11]+$result->fields[12]?></td>
		<td align="center" style="color:#CC3300"><? echo $result->fields[14]?></td>
		<td align="center">
		<? if(($result->fields[15]==1 || $result->fields[15]=="") && $result->fields[4]=="Interactiva"){?>
		<?
			$mrutax="Recordar";
		  	$rutax="compras.editar.php?idcliente=".$idcliente."&idrecordar=1&dsfecha=".$dsfecha;
		 	include("../../incluidos_modulos/enlace.generico.php");?>
		<? }?>
		</td> 			  		
			
		  <!--td align="center">
		  <?
		  /*$mrutax="Detalles";
		  $rutax="compras.editar.php?idcliente=".$result->fields[13]."&dsfecha=".$result->fields[14];
		  include("../../incluidos_modulos/enlace.generico.php");*/?>
		  |
		  <? 
		  /*if($result->fields[10]==2){
		  $mrutax="Despachar";
		  $rutax="despachar.php?idx=".$result->fields[0];
		  include("../../incluidos_modulos/enlace.generico.php");
		  echo '|';
		  }*/
		  ?>
		  <?
		  /*$rutax=$pagina."?idx=".$result->fields[0];
		  $formax="";
		  include("../../incluidos_modulos/enlace.eliminar.php");*/?>
		  </td-->
		
		</tr>
		<?
		$contar++;
		$result->MoveNext();
	} // fin while 
?>
</form>
</table>
<br>
<?
/*	$sql="select dsconfirmo,dsdespacho,dsd,dsfechadesp from ecommerce_tblpagos where  idcliente='$idcliente' and dsfecha='$dsfecha'";
	echo $sql;
	$result=$db->Execute($sql);
	if(!$result->EOF){
	$dsconfirmo=$result->fields[0];
	$dsdespacho=$result->fields[1];
	$dsobservaciones=$result->fields[2];
	$dsfechadesp=$result->fields[3];
	*/
	?>
	<table class="text1">
		<tr>
			<td><strong>Usuario que confirmo la compra:</strong></td>
			<td><? echo $dsconfirmo?></td>
		</tr>
		<tr>
			<td><strong>Usuario que despacho la compra:</strong></td>
			<td><? echo $dsdespacho?></td>
		</tr>
		<tr>
			<td><strong>Fecha de despacho:</strong></td>
			<td><? echo $dsfechadesp?></td>
		</tr>

		<tr>
			<td><strong>Observaciones:</strong></td>
			<td><? echo $dsobservaciones?></td>
		</tr>

	</table>
	<?
	//}
?>
