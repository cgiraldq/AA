<table align="center"  cellspacing="1" border="0" width=100% class="frm_campos_consola" id="detalle">

<form action="../../validaciones/validar.formularios.php" method=post name=u>
<?
    $sql="select id,dsm,idformulario from framecf_tbltiposformulariosxcamposxagrupamientoxtemas where idformulario=$idx and idactivo=1 ORDER BY idpos";
       //echo $sql;
        $result=$db->Execute($sql);
        if(!$result->EOF){
        	$idformulario=$result->fields[2];

		     while(!$result->EOF){
		     	$idx=$result->fields[0];
		     	$idtemax=$result->fields[0];
		     	$dsmx=reemplazar($result->fields[1]);
		//$tituloforma="Ingreso de registro en Formulario ( $dsmx ).";

// consulta para traer la informacion de los campos del formulario
$sqlx="select a.id,a.dsm,a.dsmensaje,a.idtipo,a.idoblig,a.idposn,a.dscampo,a.idminimo,a.idtipoformulario,a.idactivo,a.dsdes ";
$sqlx.="from framecf_tbltiposformulariosxcampo a inner join  tblagrupamientoxtblformulariosxtemas b";
$sqlx.=" where a.idtipoformulario='$idformulario' and a.id=b.iddestino and b.idorigen='$idx' ";
if($campo_obligatorio==1){ $sqlx.=" and (a.idoblig=1 OR a.dscampo='dscampo31')"; }
$sqlx.=" and a.idactivo=1 order by b.idpos asc";
//echo "<br><br>";
//	echo $sqlx;
 $resultx=$db->Execute($sqlx);
if(!$resultx->EOF){

?>
<tr><td  align="center" colspan="4"><h1><? echo $dsmx;?></h1></td></tr>
<?
//$param="";
$contador=0;
	while(!$resultx->EOF){
		include('formulario.pintar.campo.php');
	$resultx->MoveNext();
	$contador++;
     } // fin while que pinta los campos



}else{
////////////////////////////////////////////////////////////////////////////////////////////////////////////
$idtemax=$result->fields[0];
//include('formulario.pintar.subcampos.php');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
} // fin del segundo if
$resultx->Close();

$result->MoveNext();
} // fin del primer while

}else{
	//include('formulario.completo.php');
}
$result->Close(); // fin de la consulta
?>


<tr>
  	<td colspan=2>
		<input type="hidden" name="idgaleria" value="<? echo $_REQUEST["idgaleria"];?>">
		<?
		$param = trim($param,',');
$forma="u";
$botonmodificar=1;
		//include($rutxx."../../incluidos_modulos/botones.modificar.php");
		?>

		<input type="hidden" name="r" value="<? echo $r?>">
		<input type="hidden" name="idx" value="<? echo $idformulario;?>">
		<input type="hidden" name="editar" value="<? echo $ideditar;?>">
		<input type="hidden" name="idy" value="<? echo $idy;?>">

	</td>
</tr>
</form>
</table>
