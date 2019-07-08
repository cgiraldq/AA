<?include("../../../incluidos_modulos/encabezado.ingreso.php");?>
<table align="center"  cellspacing="1" cellpadding="1" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">
        <tr bgcolor="<? echo $fondos[4];?>" align=center>
      <td colspan=4 valign=top bgcolor="#FFFFFF" class="link_negro1">
      &nbsp;<? if ($fac<>""){?>
        <? } else {?>
      &nbsp;</td>
      <? }?>
    </tr>
    
    <tr bgcolor="<? echo $fondos[4];?>" align="center">
    <td valign=top class="link_negro1"bgcolor="#FFFFFF" >Resolucion</td>
    <td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
        <input type="text" name="dsres" class="link_negro1" value="<? echo $dsres;?>" maxlength="20" size="20"></td>
    </tr>
  
    <tr bgcolor="<? echo $fondos[4];?>" align="center">
    <td valign=top class="link_negro1"bgcolor="#FFFFFF" >Desde</td>
    <td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
    <input type="text" name="idconsecini" class="link_negro1" value="<? echo $idconsecini;?>" maxlength="9" size="9"></td>
    </tr>


    <tr bgcolor="<? echo $fondos[4];?>" align="center">
    <td valign=top class="link_negro1"bgcolor="#FFFFFF" >Hasta</td>
    <td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
    <input type="text" name="idconsecfin" class="link_negro1" value="<? echo $idconsecfin;?>" maxlength="9" size="9"></td>
    </tr>
    
    <tr bgcolor="<? echo $fondos[4];?>" align="center">
    <td valign=top class="link_negro1"bgcolor="#FFFFFF" >Fecha de resolucion</td>
    <td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
        <input type="text" name="dsfechax" class="link_negro1" value="<? echo $dsfechax;?>" maxlength="20" size="20"></td>
    </tr>

  <tr bgcolor="<? echo $fondos[4];?>" align="center">
    <td valign=top class="link_negro1"bgcolor="#FFFFFF" >Descripcion de la factura</td>
    <td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
        <textarea name="dsdescx" class="link_negro1" cols="50" rows="6"><? echo $dsdescx;?></textarea> </td>
    </tr>



    
      <tr bgcolor="<? echo $fondos[4];?>" align="center">
    <td valign=top class="link_negro1"bgcolor="#FFFFFF" >NIT</td>
    <td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
        <input type="text" name="dsnit" class="link_negro1" value="<? echo $dsnit;?>" maxlength="20" size="20"></td>
    </tr>
    
    <tr bgcolor="<? echo $fondos[4];?>" align="center">
    <td valign=top class="link_negro1"bgcolor="#FFFFFF" >Ciudad</td>
    <td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
    <input type="text" name="dsciudad" class="link_negro1" value="<? echo $dsciudad;?>" maxlength="255" size="30">
        </td>
    </tr>
  
  <tr bgcolor="<? echo $fondos[4];?>" align="center">
    <td valign=top class="link_negro1"bgcolor="#FFFFFF" >Nombre que aparece en la resolucion</td>
    <td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
        <input type="text" name="dsnombre" class="link_negro1" value="<? echo $dsnombre;?>" maxlength="150" size="35"></td>
    </tr>

<tr bgcolor="<? echo $fondos[4];?>" align="center">
    <td valign=top class="link_negro1"bgcolor="#FFFFFF" >Direccion que aparece en la resolucion</td>
    <td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
        <input type="text" name="dsdir" class="link_negro1" value="<? echo $dsdir;?>" maxlength="150" size="35"></td>
    </tr>


<tr bgcolor="<? echo $fondos[4];?>" align="center">
    <td valign=top class="link_negro1"bgcolor="#FFFFFF" >Telefono que aparece en la resolucion</td>
    <td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
        <input type="text" name="dstel" class="link_negro1" value="<? echo $dstel;?>" maxlength="150" size="35"></td>
    </tr>


<tr bgcolor="<? echo $fondos[4];?>" align="center">
    <td valign=top class="link_negro1"bgcolor="#FFFFFF" >Prefijo que aparece en la resolucion</td>
    <td valign=top class="link_negro1"bgcolor="#FFFFFF"  colspan="3" align="left">
        <input type="text" name="dsprefijo" class="link_negro1" value="<? echo $dsprefijo;?>" maxlength="4" size="5"></td>
    </tr>


  
    <tr bgcolor="<? echo $fondos[4];?>" align=center>
      <td colspan=4 valign=top bgcolor="#FFFFFF" class="link_negro1">
      <input type="submit" name=enviar value="Ingresar" class="botones" >
      </td>
    </tr>
    </form>
</table>
</td></tr>
</table>