<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Area Investigacion y Desarrollo
  Area Diseno y Maquetacion
  Area Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// Listado de los ultimos correos ingresados por el sitio

$sql="select a.id,a.dsm,a.dsregistros,dstabla from  framecf_tbltiposformularios a";
//if($_SESSION['i_idperfil']==4) $sql.=" ,tblusuarioxtblformularios b";
$sql.=" where a.idactivo=1 and a.idinformes=1 ";
//if( $_SESSION['i_idperfil']==4)$sql.=" and a.id=b.iddestino and b.idorigen='".$_SESSION['i_idrol']."'";
$sql.=" order by a.id desc ";
//echo $sql;
//include("../../incluidos_modulos/paginar.variables.php");
$result=$db->Execute($sql);
if (!$result->EOF) {
  while (!$result->EOF){
    $idform=$result->fields[0];
    $dsm=$result->fields[1];
    $maxregistros=$result->fields[2];
    $tabla=$result->fields[3];
    if($maxregistros=="" || $maxregistros==0) $maxregistros=5;
$contar=0;

?>

 <table width="100%" border="0" cellpadding="0" cellspacing="0" >
             <tr class="btn_modulos" valign="top" align="center">
                    <td><h3>REGISTROS DE <? echo  strtoupper(reemplazar($dsm));?></h3></td>

              </tr>
      </table>



	  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbl_internas_index">
        <tr>

          <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td bgcolor="#F7F7F7">
                  <table width="100%">
                  <tr class="tbl_cbz_core"  align="center" style="background:#fff" style="background:#ccc;color:#fff">
<?
$sqlx="select a.dsm,a.dscampo from  framecf_tbltiposformulariosxcampo a, tblcamposxtblformularios b ";
$sqlx.="where idactivo not in(9) and a.id=b.iddestino and a.idtipoformulario=b.idorigen and a.idtipoformulario=$idform ";
$sqlx.=" and a.idactivo=1 order by a.idpos asc";
//echo $sqlx;
$resultx=$db->Execute($sqlx);
if (!$resultx->EOF) {
  $campos="";
  $vector  = array ();
  while (!$resultx->EOF){
     $dsm=$resultx->fields[0];

     $campos.=$resultx->fields[1].",";

     $vector[]=$resultx->fields[1];
?>
                    <td><? echo $dsm;?></td>
 <?
$resultx->MoveNext();
}

} // fin si
$resultx->Close();
?>

</tr>
			<?/* while (!$result->EOF){
				if ($contar%2==0) {
				$fondo=$fondo1;
				} else {
					$fondo=$fondo2;
					}
			*/?>


<?

$camposx=trim($campos,',');
$sqly="select $camposx from  $tabla a ";
$sqly.="where idactivo not in(9)  ";
$sqly.=" and a.id='".$_REQUEST['id']."' order by a.id desc LIMIT 0,$maxregistros";
//echo $sqly;
//$contador=count($vector);
$resulty=$db->Execute($sqly);
if (!$resulty->EOF) {
  while (!$resulty->EOF){
?>

<tr class="texto_normal2" align="center" valign="top"  bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');">
<? for ($h=0;$h<count($vector);$h++) {?>
  <td align="center" valign="top" class="texto_normal2">
    <? echo ellistr(reemplazar($resulty->fields[$vector[$h]]),80);?>
  </td>
  <? } ?>
</tr>

<?
$resulty->MoveNext();
}

}else{

?>
  <tr class="texto_normal2" align="center" valign="top"  bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');">

      <td align="center" colspan="4" valign="top" class="texto_normal2">NO TIENE REGISTROS ASOCIADOS</td>
  </tr>

<?
}
$resulty->Close();
?>

<?/*
	$contar++;
			$result->MoveNext();
	} // fin while
*/?>

                </table>
              </td>
              </tr>
          </table>

    </td>
        </tr>
      </table>
<?
$result->MoveNext();
}

} // fin si
$result->Close();
?>