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
// Tabla de uso para el ingreso de datos
if ($idclientepago<>"") {
      $sql="select dsnombres,dsapellidos,dsidentificacion,dscorreocliente,";
      $sql.="dstelefono,dstelefono2,dsmovil,dsdireccion,dsciudad,dscodigousa,dscodigouk";
      
    $sql.=" from tblclientes where id='$idclientepago'";
    //echo $sql;
    $resultb= $db->Execute($sql);
    if (!$resultb->EOF) {
      $dsnombres=$resultb->fields[0];
      $dsapellidos=$resultb->fields[1];
      $dsidentificacion=$resultb->fields[2];
      $dscorreocliente=$resultb->fields[3];
      $dstelefono=$resultb->fields[4];
      $dstelefono2=$resultb->fields[5];
      $dsmovil=$resultb->fields[6];
      $dsdireccion=$resultb->fields[7];
      $dsciudad=$resultb->fields[8];
      $dscodigousa=$resultb->fields[9];
      $dscodigouk=$resultb->fields[10];

     }
     $resultb->Close(); 


}
?>
<br>


<table width="100%" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td align="center" valign="top" bgcolor="#CACAD0"><br />


<table width="90%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="6" align="left" valign="top"><img src="../../img_modulos/modulos/titulo_r1_c1.jpg" width="6" height="22" /></td>
          <td width="615" align="left" valign="middle" background="../../img_modulos/modulos/franja_grisoscuro_r1_c2.jpg" class="titulo_negro">Ingreso de venta asistida</td>
        </tr></table> <table align="center"  cellspacing="1" cellpadding="1" border="0" width=90% class="texto_parrafo2" bgcolor="#CCCCCC">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">

<tr valign=top bgcolor="#FFFFFF">
<td><strong>Codigo USA</strong></td>
<td>
<? $contadorx="dscodigousa_counter";$valorx="40";$campox="dscodigousa";$maxl="255"?>
<input type=text name="<? echo $campox?>" readonly size="<? echo $valorx?>" maxlength="<? echo $maxl?>" class=text1 value="<? echo $dscodigousa?>" OnkeyPress="document.getElementById('capa_cargarvariables').innerHTML=''">
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td><strong>Codigo UK</strong></td>
<td>
<? $contadorx="dscodigouk_counter";$valorx="40";$campox="dscodigouk";$maxl="255"?>
<input type=text name="<? echo $campox?>" readonly size="<? echo $valorx?>" maxlength="<? echo $maxl?>" class=text1 value="<? echo $dscodigouk?>" OnkeyPress="document.getElementById('capa_cargarvariables').innerHTML=''">
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Titulo del correo</td>
<td>
<? $contadorx="dstitulo_b_counter";$valorx="1000";$campox="dstitulo_b";$cantidad=strlen($dstitulo_b)?>
<textarea name=dstitulo_b cols=80  rows="2" class=text1 onKeyPress="ocultar('capa_dstitulo_b')" <? include("../../incluidos_modulos/control.evento.php");?>><? echo $dstitulo_b?></textarea>
<?
$nombre_capa="capa_dstitulo_b";
$mensaje_capa="Debe ingresar este campo";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Cuerpo del correo</td>
<td>
<? $contadorx="dscausa_b_counter";$valorx="1000";$campox="dscausa_b";$cantidad=strlen($dscausa_b)?>
<textarea name=dscausa_b cols=80  rows="15" class=text1 onKeyPress="ocultar('capa_dscausa_b')" <? include("../../incluidos_modulos/control.evento.php");?>><? echo $dscausa_b?></textarea>
<?
$nombre_capa="capa_dstitulo_b";
$mensaje_capa="Debe ingresar este campo";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>




<tr valign=top bgcolor="#f3f3f3">
<td colspan=2 align=Center>
  <input type=submit name=enviar value="ENVIAR CORREO">
<input type="hidden" name="inn" value="1">
<input type="hidden" name="idclientepago" value="<? echo $idclientepago?>">
</td>
</tr>



</form>
</table>
<br>

</td>
</tr>
</table>
