-<?

// datos encabezdo
//$db->debug=true;

$sql="select dsnombres,dsapellidos,dstelefono,dstelefono2,dsdireccion,dspais,dsciudad,dscorreocliente,dscodigousa,dscodigouk ";
$sql.="from tblclientes where id=$idclientepago";
//echo $sql;
//exit;
$resultx=$db->Execute($sql);
if(!$resultx->EOF){
$dsnombres=reemplazar($resultx->fields[0]);
$dsapellidos=reemplazar($resultx->fields[1]);
$dstelefono=reemplazar($resultx->fields[2]);
$dstelefono2=reemplazar($resultx->fields[3]);
$dsdireccion=reemplazar($resultx->fields[4]);
$dspais=reemplazar($resultx->fields[5]);
$dsciudad=reemplazar($resultx->fields[6]);
$dscorreocliente=reemplazar($resultx->fields[7]);
$dscodigousa=reemplazar($resultx->fields[8]);
$dscodigouk=reemplazar($resultx->fields[9]);

}
$resultx->Close();
// contrl del asunto
$asunto=preg_replace("/-Nombre-/",$dsnombres." ".$dsapellidos,$asunto);
// control del texto
$dsobs=preg_replace("/-Nombre-/",$dsnombres." ".$dsapellidos,$dsobs);
$dsobs=preg_replace("/-dscodigousa-/",$dscodigousa,$dsobs);
$dsobs=preg_replace("/-dscodigouk-/",$dscodigouk,$dsobs);
$dsobs=preg_replace("/\n/","<br>",$dsobs);

$cuerpo="
<table border=0 width=100%>
  <tr>
    <td valign=top colspan=2>
    <img src='".$rutaAbs."images/logo.png'>
    <br>
    </td>
    </tr>

    <tr>
    <td colspan=2>
<font face='arial' size='-1'>
     <strong> ".$titulo.".</strong>
      <BR>
      Fecha : <strong>".$fechanotificacion."</strong>
            <BR>
      <br> <strong>".$dsobs."</strong>
 </font>
      </td>
      </tr>";





$cuerpo.="<tr>
 <td valign=top colspan=2>
 <font face='arial' size='-1'>

    ".$autorizado." On line ". date("Y")  ." Todos los derechos reservados
    Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>
</font>
 </td>
 </tr>
</table>";
?>