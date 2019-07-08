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
include($rutxx."../../incluidos_modulos/encabezado.ingreso.php");

?>
<table align="center"  cellspacing="1" cellpadding="1" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u>
<tr valign=top bgcolor="#FFFFFF">
<td>Cliente</td>
<td>
<? $contadorx="idcliente_counter";$valorx="255";$formax="u";$campox="idcliente";?>

        <select name="idcliente"  class='text1'>
        <option value="0|0" > -- Selecionar -- </option>

        <? $sqlc=" select a.dsm,a.dscampo,b.id from framecf_tbltiposformulariosxcampo a,framecf_tbltiposformularios b ";
           $sqlc.="where a.idselect=1 and a.idtipoformulario=b.id and b.idformclientes=1 ";
          //echo $sqlc;
          $campox=",";
          $resultc = $db->Execute($sqlc);
          if (!$resultc->EOF) {

            while(!$resultc->EOF) {

            $campodsm=$resultc->fields[0];

            $campox.=$resultc->fields[1].",";

            $idform=$resultc->fields[2];

            $resultc->MoveNext();
          }
          }
          $resultc->Close();


          $camposx = trim($campox,',');
          $campoxx= explode(",",$camposx);
        ?>


        <?
          $sql="Select id,$camposx,dscampo29 from  framecf_tblregistro_formularios b where idformulario=$idform";
          if( $_SESSION['i_idperfil']==4)   $sql.=" and idusuario='".$_SESSION['i_idusuario']."'";
          $sql.=" and idactivo not in(2) ";
          //echo $sql;
          //$sql.=" order by a.dscampo3 ASC";
          //echo $sql;
          $result = $db->Execute($sql);
            if (!$result->EOF) {
            while(!$result->EOF) {
              $dsnombre="";
             $total=count($campoxx);

            for ($i=1; $i <= $total; $i++) {
              # code...
               $dsnombre.=$result->fields[$i]." ";
            }
            // $dsnombre=$result->fields[1]." ".$result->fields[2]." ".$result->fields[3]." ".$result->fields[4];

            //$dsnombre=$fila->dsnombre1." ".$fila->dsnombre2." ".$fila->dsapell." ".$fila->dsapell2;
            $idcli=$result->fields[0];
            $tipo_cliente=$result->fields['dscampo29'];
            ?>
            <option value="0|<? echo $idcli?>" <? if($idcli==$idcliente)echo "selected";?>><? echo strtoupper($dsnombre)." <strong>(".$tipo_cliente.")</strong>";?></option>
            <?

            $result->MoveNext();

            }
          }
          $result->Close();
        ?>
        </select>


<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el nombre";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Valor presupuestado</td>
<td><input type=text name=dsvalor size=20 maxlength="30" class=text1 value="<? echo $dsvalor?>">
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Fecha inicial </td>
<td>
    <input type=text name="dsfechai" size=10 maxlength="10" class=text1 value="<? echo $dsfechai?>">
    <img align="absmiddle" SRC="<? echo $rutxx;?>../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechai', this);" language="javaScript">
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Fecha final </td>
<td>
    <input type=text name="dsfechaf" size=10 maxlength="10" class=text1 value="<? echo $dsfechaf?>">
    <img align="absmiddle" SRC="<? echo $rutxx;?>../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechaf', this);" language="javaScript">
</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
<td>Activar?</td>
<td>
	<select name=idactivo class=text1>
    <option value="1" <? if ($idactivo==1) echo "selected";?>>SI</option>
    <option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>
	</select>

</td>
</tr>
<tr bgcolor="#FFFFFF" ><td colspan=2>
<?
$forma="u";
$param="idcliente";
include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>

</td></tr>
</form>
</table>
<br>

</td>
</tr>
</table>