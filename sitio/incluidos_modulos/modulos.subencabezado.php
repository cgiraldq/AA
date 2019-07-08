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
subencabezado generico de cada modulo al entrar
*/
$rutapapelera=$rutavotaciones;
if ($rutapapelera=="") $rutapapelera=$rutxx;
?>
  <table width="100%" cellspacing="0" cellpadding="0" class="encabezado_tabla">
      <tr>
        <td width="57" align="left" valign="top" ><a href="modulos.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image25','','<? echo $icono2?>',1)"><!--img src="<? echo $icono1?>" name="Image25" border="0" id="Image25" /--></a></td>
        <td align="left" valign="middle"  class="text1">&nbsp;Se encuentra en : <? echo $rutamodulo?></td>
        <td align="right" valign="middle"  class="text">
          <? if ($bloqueor=="") { ?><p><? echo $totalregistros?>  Registro(s) encontrados</p><? } ?>
          <? if ($exportar==1) { ?>| <a href="exportar.php<? echo $parametros?>" title="Click para exportar los datos"><p>Exportar Datos</p></a><? } ?>
          <? if ($papelera==1) { ?>| <a href="<? echo $rutapapelera;?>../papelera/papelera.php?dstabla=<? echo $tabla;?>&dsrutap=<? echo $dsrutap;?>&titulomodulo=<? echo $titulomodulo?>&idy=<? echo $idy;?>&idg=<? echo $idg;?>" title="Click para restaurar datos"><p class="btn_papelera"><img src="<? echo $rutxx;?>../../img_modulos/modulos/papelera.png"> Papelera (<? echo seldato("count(*)","idactivo",$tabla,"9",1)?>)</p></a><? } ?>
        </td>
        <td width="5" align="left" valign="top"><!--img src="../../img_modulos/modulos/bot_opciones_r1_c2.jpg" width="5" height="37" /--></td>
      </tr>

      <?if ($importar==1) { ?>
      <tr class="tr_blq-importar">
        <td colspan="4" >
          <table width="32%" cellspacing="0" cellpadding="0" align="right">
            <tr>
              <td  class="td-text">Importar Productos</td>
              <td class="td-btn"><input type="button" value="Importar" class="btn-importar" onclick="location.href='importar.php'" title="Click para subir el archivo "></td>
            </tr>
          </table>
        </td>
      </tr>
      <? } ?>

</table>