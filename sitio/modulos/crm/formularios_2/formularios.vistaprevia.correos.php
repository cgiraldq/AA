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
// edicion de datos
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
//$db->debug=true;
$idx=$_REQUEST["idx"];



?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>





<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<?
///////////////////////// enviar correo ////////////////////////////

$sql="select dsasunto,dsenc,dsremate,dsasuntoar,dsimgencabezado,dsimgremate from framecf_tbltiposformularios where id=$idx";
//echo $sql;
$result=$db->Execute($sql);
if(!$result->EOF){
	$dsasunto=$result->fields[0];
	$dsenc=nl2br($result->fields[1]);
	$dsremate=nl2br($result->fields[2]);
	$dsasuntoar=$result->fields[3];

	$dsimg=$result->fields[4];
	$dsimg2=$result->fields[5];

$asunto="$dsasunto";
$asuntoa="$dsasuntoar";

$cuerpo="<img src='http://adrianaarango.com/contenidos/images/empresa/$dsimg' alt=''><br><br>";

$cuerpo.="$asunto <br>";
$cuerpo.="$dsenc <br>";

$sqlx="select a.dsm,a.dscampo from framecf_tbltiposformulariosxcampo a where idtipoformulario=$idx ";
$sqlx.="and a.idactivo not in(2,9) and a.idpublicar=1 order by a.idpos ";
//echo $sqlx;
 $resultx=$db->Execute($sqlx);
if(!$resultx->EOF){

$sql="select a.dscampo from framecf_tbltiposformulariosxcampo a where idtipo=5 and idtipoformulario=$idx ";

$result=$db->Execute($sql);
if(!$result->EOF){
$campo=$result->fields[0];

}
$result->Close();

	while(!$resultx->EOF){
		$cuerpo.="<br>";
		$cuerpo.="<strong>".reemplazar($resultx->fields[0])."</strong>=Vista previa";

$resultx->MoveNext();
}

}$resultx->Close();

$cuerpo.="<br><br>$dsremate<br><br>";
$cuerpo.="<img src='http://adrianaarango.com/contenidos/images/empresa/$dsimg2' alt='Logo Holasa'><br><br>";
///////////////remate general///////////////////
$cuerpo.="<br>IP remota: <br>$remoto<br>";
$cuerpo.="==============================================================<br>";
$cuerpo.= " ".$autorizado." Online ". date("Y")  ." <br>Todos los derechos reservados<br>";
$cuerpo.="Powered by <a href='http://www.comprandofacil.co/'>Comprandofacil</a></font><br>";
///////////// fin remate general ///////////////
echo $cuerpo;
}
$result->Close();
?>

</table>
<br>




</body>
</html>





