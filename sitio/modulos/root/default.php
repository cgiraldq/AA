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
// root
$rutx=0;
include($rutxx."../../incluidos_modulos/modulos.globales.php");
$titulomodulo="CONFIGURACION DE MODULOS";
$dsm=$_REQUEST['dsm'];
$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];
$letra=$_REQUEST['letra'];
?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
?>

<br>

<table width="100%" cellpadding="0" cellspacing="0" align="center"  class="cont_general">
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">
   <table width="70%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
        <tr>
          <td width="615" align="left" valign="middle">
            <img src="../../img_modulos/modulos/edicion.png">
            <h1>CONFIGURACION GENERAL</h1>
          </td>
        </tr>
</table>
           <table width="95%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center" valign="top" bgcolor="#FFFFFF"><br />

              <table width="95%" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="57" align="left" valign="top" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"><a href="modulos.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image25','','../../img_modulos/modulos/icono4(2).jpg',1)"><img src="../../img_modulos/modulos/icono4.jpg" name="Image25" width="57" height="37" border="0" id="Image25" /></a></td>
                  <td align="left" valign="middle" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"><a href="modulos/modulos.php" class="texto_normal1">Modulos</a></td>
                  <td width="41" align="center" valign="middle" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"></td>
                  <td width="5" align="left" valign="top"><img src="../../img_modulos/modulos/bot_opciones_r1_c2.jpg" width="5" height="37" /></td>
                </tr>
              </table>
              <table width="95%" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="7"></td>
                </tr>
              </table>          

              <table width="95%" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="57" align="left" valign="top" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"><a href="empresa.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image26','','../../img_modulos/modulos/icono4(2).jpg',1)"><img src="../../img_modulos/modulos/icono4.jpg" name="Image26" width="57" height="37" border="0" id="Image26" /></a></td>
                  <td align="left" valign="middle" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"><a href="empresa/empresa.php" class="texto_normal1">Informacion de la empresa </a></td>
                  <td width="41" align="center" valign="middle" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"></td>
                  <td width="5" align="left" valign="top"><img src="../../img_modulos/modulos/bot_opciones_r1_c2.jpg" width="5" height="37" /></td>
                </tr>
              </table>     
              <table width="95%" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="7"></td>
                </tr>
              </table>
			  
			  <table width="95%" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="57" align="left" valign="top" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"><a href="root.sql.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image28','','../../img_modulos/modulos/icono4(2).jpg',1)"><img src="../../img_modulos/modulos/icono4.jpg" name="Image27" width="57" height="37" border="0" id="Image28" /></a></td>
                  <td align="left" valign="middle" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"><a href="root.sql.php" class="texto_normal1">Ejecuciones SQL</a></td>
                  <td width="41" align="center" valign="middle" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"></td>
                  <td width="5" align="left" valign="top"><img src="../../img_modulos/modulos/bot_opciones_r1_c2.jpg" width="5" height="37" /></td>
                </tr>
              </table>     
			  <table width="95%" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="7"></td>
                </tr>
              </table>
				
			  <table width="95%" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="57" align="left" valign="top" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"><a href="root.sql.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image28','','../../img_modulos/modulos/icono4(2).jpg',1)"><img src="../../img_modulos/modulos/icono4.jpg" name="Image27" width="57" height="37" border="0" id="Image28" /></a></td>
                  <td align="left" valign="middle" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"><a href="bloqueoip/default.php" class="texto_normal1">Bloqueo IP</a></td>
                  <td width="41" align="center" valign="middle" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"></td>
                  <td width="5" align="left" valign="top"><img src="../../img_modulos/modulos/bot_opciones_r1_c2.jpg" width="5" height="37" /></td>
                </tr>
              </table>     
			  <table width="95%" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="7"></td>
                </tr>
              </table>


        <table width="95%" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="57" align="left" valign="top" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"><a href="root.sql.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image28','','../../img_modulos/modulos/icono4(2).jpg',1)"><img src="../../img_modulos/modulos/icono4.jpg" name="Image27" width="57" height="37" border="0" id="Image28" /></a></td>
                  <td align="left" valign="middle" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"><a href="../cms/paginas/default.php" class="texto_normal1">Paginas</a></td>
                  <td width="41" align="center" valign="middle" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"></td>
                  <td width="5" align="left" valign="top"><img src="../../img_modulos/modulos/bot_opciones_r1_c2.jpg" width="5" height="37" /></td>
                </tr>
              </table>     
        <table width="95%" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="7"></td>
                </tr>
              </table>

			  
                <table width="95%" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="57" align="left" valign="top" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"><a href="root.sql.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image28','','../../img_modulos/modulos/icono4(2).jpg',1)"><img src="../../img_modulos/modulos/icono4.jpg" name="Image27" width="57" height="37" border="0" id="Image28" /></a></td>
                  <td align="left" valign="middle" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"><a href="../cms/menu/default.php" class="texto_normal1">Menu lateral</a></td>
                  <td width="41" align="center" valign="middle" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"></td>
                  <td width="5" align="left" valign="top"><img src="../../img_modulos/modulos/bot_opciones_r1_c2.jpg" width="5" height="37" /></td>
                </tr>
              </table>
               <table width="95%" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="57" align="left" valign="top" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"><a href="root.sql.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image28','','../../img_modulos/modulos/icono4(2).jpg',1)"><img src="../../img_modulos/modulos/icono4.jpg" name="Image27" width="57" height="37" border="0" id="Image28" /></a></td>
                  <td align="left" valign="middle" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"><a href="../ecommerce/estadocompras/default.php" class="texto_normal1">Estados de la Compras</a></td>
                  <td width="41" align="center" valign="middle" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"></td>
                  <td width="5" align="left" valign="top"><img src="../../img_modulos/modulos/bot_opciones_r1_c2.jpg" width="5" height="37" /></td>
                </tr>
              </table>      
              <table width="95%" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="57" align="left" valign="top" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"><a href="root.sql.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image28','','../../img_modulos/modulos/icono4(2).jpg',1)"><img src="../../img_modulos/modulos/icono4.jpg" name="Image27" width="57" height="37" border="0" id="Image28" /></a></td>
                  <td align="left" valign="middle" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"><a href="../ecommerce/tiposproductos/default.php" class="texto_normal1">Tipo de productos</a></td>
                  <td width="41" align="center" valign="middle" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg"></td>
                  <td width="5" align="left" valign="top"><img src="../../img_modulos/modulos/bot_opciones_r1_c2.jpg" width="5" height="37" /></td>
                </tr>
              </table>  
              <table width="95%" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="7"></td>
                </tr>
              </table>


			  
</td>
        </tr>
      </table><br>
<br>
</td>
  </tr>
</table>

<br>
<? include("../../incluidos_modulos/navegador.principal.cerrar.php");
  include("../../incluidos_modulos/modulos.remate.php");?>
</body>
</html>
