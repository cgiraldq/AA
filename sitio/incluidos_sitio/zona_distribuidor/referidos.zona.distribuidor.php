<article id='referidos' class="cuerpo_zona_distribuidor">

<h1>Bienvenido <?echo reemplazar($_SESSION['i_dsnombre']);?></h1>

<?$sql="select * from tblreferidos where iddistribuidor=".$_SESSION['i_idcliente'];

$resultbx= $db->Execute($sql);
if (!$resultbx->EOF) {?>
<table width="100%" class="ecommerce_tbl_pedidos">
<thead>
<tr>
<td>Nombre</td>
<td>Email</td>
<td>Tel&eacute;fono</td>
</tr>
</thead>
<?
while (!$resultbx->EOF) {
$dsmr=$resultbx->fields[dsm];
$dscorreor=$resultbx->fields[dscorreo];
$dstel=$resultbx->fields[dstelefono];
	?>


<tbody>
	<tr>
		<td><?echo $dsmr?></td>
		<td><?echo $dscorreor?></td>
		<td><?echo $dstel?></td>
	</tr>
</tbody>

<?
$resultbx->MoveNext();
}

?></table><?
} else {


}$resultbx->Close();
?>
</article>