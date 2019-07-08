<table align="center" id="detalle" padding=0; cellspacing="0" cellpadding="0" border="0" width=98% class="campos_ingreso" style="table-layout:fixed;">
<?
//echo $modo;
$modo=seldato("idmodomostrarform","id"," framecf_tbltiposformularios",$idx,2);
if ($modo==1) {?><tr valign=top bgcolor="#FFFFFF"><?}
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
// echo $sqlx."<br>";
 $resultx=$db->Execute($sqlx);
if(!$resultx->EOF){


//$param="";
$contador=0;
while(!$resultx->EOF){

      include('formulario.pintar.campo.php');


  $resultx->MoveNext();
  $contador++;
     } // fin while que pinta los campos
//$param = trim($param,',');
?>
<!--tr bgcolor="#FFFFFF" >
  <td colspan=2>
</td>
</tr-->
<?

}
$resultx->Close();

}
$result->Close();
if ($modo==1) {?></tr><?}?>
</table>