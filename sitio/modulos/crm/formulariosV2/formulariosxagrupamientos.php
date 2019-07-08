<table align="center" id="detalle" cellspacing="1" cellpadding="1" border="0" width=98% class="campos_ingreso">
<?
////////////////////////////////////////////// inicio de las consultas para listar los campos /////////////////////////////////////////
        $sql="select id,dsm,dsr,idactivo,idtipo from framecf_tbltiposformularios where id='$idx' and idactivo=1";
        $result=$db->Execute($sql);
        if(!$result->EOF){
        	$idformulario=$result->fields[0];
			$dsmx=$result->fields[1];
			$tituloforma="Vista previa Formulario ( $dsmx ).";
// consulta para traer la informacion de los campos del formulario
$sqlx="select a.id,a.dsm,a.dsmensaje,a.idtipo,a.idoblig,a.idposn,a.dscampo,a.idminimo,a.idtipoformulario,a.idactivo,a.dsdes ";
$sqlx.="from framecf_tbltiposformulariosxcampo a ";
if($idreferencia<>"")$sqlx.=" inner join tblagrupamientoxtblformularios b";
$sqlx.=" where a.idtipoformulario='$idx' ";
if($idreferencia<>"")$sqlx.=" and a.id=b.iddestino and b.idorigen='".$agrupamiento."'";
$sqlx.=" and a.idactivo not in(2,9) ";
if($idreferencia<>""){
$sqlx.=" order by b.idpos asc";
} else{
$sqlx.=" order by a.idposn asc";
}
//exit();
//echo "<br>";
 //echo $sqlx;
 $resultx=$db->Execute($sqlx);
if(!$resultx->EOF){


$param="";
$contador=0;
while(!$resultx->EOF){
include('formulario.pintar.campo.php');
	$resultx->MoveNext();
	$contador++;
     } // fin while que pinta los campos



$param = trim($param,',');

$forma="u";
$botonmodificar=1;
?>




<tr bgcolor="#FFFFFF" >
  <td colspan=2>

</td>
</tr>


<?

}
$resultx->Close();

}
$result->Close();
?>

<input type="hidden" name="idx" value="<? echo $_REQUEST['idx'];?>">
<input type="hidden" name="r" value="<? echo $r?>">
<input type="hidden" name="formulario" value="<? echo $idformulario;?>">
<input type="hidden" name="editar" value="<? echo $ideditar;?>">
<input type="hidden" name="idy" value="<? echo $idy;?>">



</table>