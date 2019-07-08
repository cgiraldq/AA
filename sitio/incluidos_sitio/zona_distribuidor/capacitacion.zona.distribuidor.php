<article class="cuerpo_zona_distribuidor"  id='capacitacion'>

<h1>Bienvenido <?echo reemplazar($_SESSION['i_dsnombre']);?></h1>


<?
$sql="select a.dsvideo from tblvideos a where a.idactivo=5 order by idpos  asc ";
$result=$db->Execute($sql);
if(!$result->EOF){?>
<ul class="ecommerce_capacitacion">
<?
while (!$result->EOF) {
$dsvideo=$result->fields[0];
?><li><?
echo $dsvideo
?></li><?

$result->MoveNext();
}
?>
</ul>
<?
}
$result->Close();
?>








<?
$rutadocumento="../contenidos/images/documentacion/";
$sql="select a.dsm,a.idpos,a.idactivo,a.dsd,a.dsimg,a.dsd2,dsfecha";
$sql.=" from tbldocumentos_zona a ";
$sql.=" where idactivo not in (2,9) ";
//echo $sql;
$resultd = $db->Execute($sql);
if (!$resultd->EOF) {?>
	<ul class="ecommerce_capacitacion_descargar">
	<?
while (!$resultd->EOF) {
$totalregistros=$resultd->RecordCount();
$dsm=$resultd->fields[0];
$idpos=$resultd->fields[1];
$idactivo=$resultd->fields[2];
$dsd=$resultd->fields[3];
$dsimg=$resultd->fields[4];
$dsd2=$resultd->fields[5];
$dsfecha=$resultd->fields[6];
if(is_file($rutadocumento.$dsimg)){

?>

<li>
<img src="images/pdf.png">
<h2><?echo $dsm?></h2>
<a href="descargar.php?path=<? echo $rutadocumento;?>&file=<? echo $dsimg; ?>">Descargar</a>
</li>

<?
}
$resultd->MoveNext();
}?>
	</ul>
	<?
} // fin si
$resultd->Close();
?>
</article>