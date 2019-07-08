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
// Tabla central de datos cuando se hacen los listados de novedades
$xy="../../";
if ($rutacambio<>"") $xy="";
$exportardatos="1";
if ($mostrarcliente=="") {
$sql="select id,idpedido,idclientepago,dsfecha,dscausa_b,dsfecha_b from ecommerce_tblpagos_novedades where idpedido=$idpedido";
$sql.=" order by id desc ";
$result= $db->Execute($sql);
  if (!$result->EOF) {

?>
<br>

<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1 tbl_productos">
	 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
		<td align="center" colspan=6><strong>NOVEDADES DE ESTE PEDIDO</strong></td>
	</tr>
<?
// encabezado generico basado
$nombrecampos="Id,Num Pedido,Cliente,Fecha,Novedad";
include($rutxx.$xy."incluidos_modulos/tabla.encabezado.php");
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


		</tr>
		</form>
		<?
		$contar++;
		$result->MoveNext();
	} // fin while
}
$result->Close();
} // fin mostrar cliente
// el historico de notificaciones
$sql="select id,idpedido,idclientepago,dsfechalarga,dscausa_b,dsestado from  ecommerce_tblpagos_tracking where idpedido=$idpedido";
$sql.=" order by id desc ";
//echo $sql;
$result= $db->Execute($sql);
  if (!$result->EOF) {

?>
<br>

<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1 tbl_productos">
<thead>
	 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
		<td align="center" colspan=6><strong>NOTIFICACIONES AL CLIENTE</strong></td>
	</tr>
</thead>
<?
// encabezado generico basado
$nombrecampos="Num Pedido,Estado,Fecha,Mensaje";
?>
<?include($rutxx.$xy."incluidos_modulos/tabla.encabezado.php");
?><?$contar=0;
	while (!$result->EOF) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {

			$fondo=$fondo2;
		}
		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
		<td align="center"><? echo $result->fields[1]?></td><!--numero pedido-->
		<td align="center" ><? echo $result->fields[5]?></td>
		<td align="center" ><? echo $result->fields[3]?></td>

		<td align="left"><? echo formateo_caracteres($result->fields[4])?></td>

		</tr>
		</form>
		<?
		$contar++;
		$result->MoveNext();
	} // fin while
}
$result->Close();



// fin historico de notificacions
?>

</table>
