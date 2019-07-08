<?
$id=$_REQUEST['idx'];
$rutaImagenCorreo="http://".$autorizado."/contenidos/images/correo/";
if($id<>""){
//$rutx=1;
include("../../incluidos_modulos/modulos.globales.php");
$idactivocorreo=$_REQUEST['idactivo'];
$dstipocliente="Cliente";
$dsnombre="--Nombre--";
$dsapellidos="--Apellidos--";
$dstelefono="--Telefono--";
$dstelefono2="--Celular/ telefono 2--";
$dscorreocliente="correo@correo.com";
$dsciudad="--Ciudad--";
$dspais="--Pais--";
$dscom="--Comentario--";
$dslogin="--Login--";
}
if($dstipocliente=="")$dstipocliente="Cliente";
$hora=date("Y-M-d h:m:s");
$sqlc="select dsasunto,dsd,dsremate,dsimg,dsimg2 from tblcuepocorreo where ";
$sqlc.=" idactivo=$idactivocorreo ";
if($id<>"")$sqlc.=" and id=$id order by idpos asc";

$resultc=$db->Execute($sqlc);
if(!$resultc->EOF){
$dsasunto=$resultc->fields[0];
$dsd=$resultc->fields[1];
$dsd=str_replace("[tipo]","  $dstipocliente ",$dsd);
$dsd=str_replace("[login]","  $dslogin ",$dsd);
$dsd=str_replace("[nombre]"," $dsnombre ",$dsd);
$dsd=str_replace("[apellido]"," $dsapellidos ",$dsd);
$dsd=str_replace("[telefono]"," $dstelefono ",$dsd);
$dsd=str_replace("[telefono2]","$dstelefono2 ",$dsd);
$dsd=str_replace("[correo]"," $dscorreocliente ",$dsd);
$dsd=str_replace("[come]"," $dscom ",$dsd);
$dsd=str_replace("[ciudad]"," $dsciudad ",$dsd);
$dsd=str_replace("[pais]","  $dspais ",$dsd);
$dsremate=$resultc->fields[2];
$dsremate=str_replace("[hora]"," $hora ",$dsremate);
$dsremate=str_replace("[ip]"," $remoto ",$dsremate);


$dsimg=$resultc->fields[3];
$dsimg2=$resultc->fields[4];

$asuntoa=$dsasunto;
$cuerpoa="<table  width='80%' border=0 align='center'>";
if($dsimg<>""){
$cuerpoa.="<tr>
			<td>
			<img src='$rutaImagenCorreo$dsimg' alt=''>
			</td>
		   </tr>";
	}
$cuerpoa.="
	<tr>
		<td>
			$dsd
		</td>
	</tr>
	<tr><td><br></td></tr>
	";
if($dsimg2<>""){
$cuerpoa.="<tr>
			<td>
			<img src='$rutaImagenCorreo$dsimg2' alt=''>
			</td>
		   </tr>";
	}
	$cuerpoa.="

	<tr><td><br></td></tr>
	<tr>
		<td>
			$dsremate
		</td>
	</tr>
	";
$cuerpoa.="</table>";


}#fin
$resultc->Close();
if($id<>"") echo $cuerpoa;
?>
