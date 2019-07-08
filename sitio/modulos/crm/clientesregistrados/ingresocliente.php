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

?>
<table width="100%" cellpadding="0" cellspacing="0" align="center"  class="cont_general">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">

    <table width="70%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
        <tr>
          <td align="left" valign="middle">
            <img src="../../../img_modulos/modulos/edicion.png">
            <h1>Ingreso nuevo registro</h1>
          </td>
        </tr>
        
    </table>

    <table align="center"  cellspacing="1" cellpadding="5" border="1" width=70% class="campos_ingreso campos_ingreso_producto">


            <tr>
              <td><p>Nombre</p></td>
              <td colspan="2">
                <? $contadorx="dsnombres_counter";$valorx="255";$formax="u";$campox="dsnombres";$cantidad=strlen($dsnombres)?>
                <input type=text name=dsnombres size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsnombres')" value="<? echo $dsnombres?>" <? include("../../../incluidos_modulos/control.evento.php");?>>
                <?
                $nombre_capa="capa_dsnombres";
                $mensaje_capa="Debe ingresar el nombre del cliente";
                include("../../../incluidos_modulos/control.capa.php");
                include("../../../incluidos_modulos/control.letras.php");?>

              </td>
              <td><p>Apellidos</p></td>
              <td colspan="2">
              <? $contadorx="dsapellidos_counter";$valorx="40";$formax="u";$campox="dsapellidos";$maxl="255"?>
              <input type=text name="<? echo $campox?>" size="<? echo $valorx?>" maxlength="<? echo $maxl?>" class=text1 value="<? echo $dsapellidos?>">
                 <?
                $nombre_capa="capa_dsapellidos";
                $mensaje_capa="Debe ingresar los Apellidos del cliente";
                include("../../../incluidos_modulos/control.capa.php");
                include("../../../incluidos_modulos/control.letras.php");?>
              </td>
            </tr>

            <tr>
              <td ><p>Clave</p></td>
              <td colspan="2">
              <? $contadorx="dsclave_counter";$valorx="40";$formax="u";$campox="dsclave";$maxl="255"?>
              <input type=password name="<? echo $campox?>" size="<? echo $valorx?>" maxlength="<? echo $maxl?>" class=text1 value="<? echo $dsclave?>">
                <?
                $nombre_capa="capa_dsclave";
                $mensaje_capa="Debe ingresar la clave del cliente";
                include("../../../incluidos_modulos/control.capa.php");
                include("../../../incluidos_modulos/control.letras.php");?>
              </td>
              <td ><p>Activo</p></td>
              <td  colspan="2">
              <select name="idactivo" class="textnegro">
              <option value="1" <? if ($idactivo==1) echo "selected";?>>SI</option>
              <option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>
              </select>
              </td>
              

      <tr>
              <td ><p>Email</p></td>
              <td colspan="2">
              <? $contadorx="dscorreocliente_counter";$valorx="40";$campox="dscorreocliente";$maxl="255"?>
              <input type=text name="<? echo $campox?>" size="<? echo $valorx?>" maxlength="<? echo $maxl?>" class=text1 value="<? echo $dscorreocliente?>" OnkeyPress="document.getElementById('capa_cargarvariables').innerHTML=''">
                <?
                $nombre_capa="capa_dscorreocliente";
                $mensaje_capa="Debe ingresar el correo del cliente";
                include("../../../incluidos_modulos/control.capa.php");
                include("../../../incluidos_modulos/control.letras.php");?>
              </td>
              <td ><p>Tipo Precio</p></td>
              <td  colspan="2">
              
              <select name=idtipocliente  class="textnegro">
              <? nombre_campo($idtipocliente)?>
              </select>
             
              </td>
              </tr>

              <tr>
              <td><p>Facebook</p></td>
               <td  colspan="2"> 
              <? $contadorx="dsfacebook_counter";$valorx="40";$formax="u";$campox="dsfacebook";$maxl="255"?>
              <input type=text name="<? echo $campox?>" size="5" maxlength="10" class=text1 value="<? echo $dsfacebook?>" >

              </td>

              <td><p>Twitter</p></td>
                <td  colspan="2">
              <? $contadorx="dstwitter_counter";$valorx="40";$formax="u";$campox="dstwitter";$maxl="255"?>
              <input type=text name="<? echo $campox?>" size="5" maxlength="10" class=text1 value="<? echo $dstwitter?>" >

              </td>
            </tr>

            <tr>
              <td><p>Tipo de Identificacion</p></td>
              <td colspan="2">
              <? $contadorx="dstipoid_counter";$valorx="40";$formax="u";$campox="dstipoid";$maxl="255"?>
              <input type=text name="<? echo $campox?>" size="<? echo $valorx?>" maxlength="<? echo $maxl?>" class=text1 value="<? echo $dstipoid?>">
              </td>
              <td><p>Identificacion</p></td>
              <td colspan="2">
              <? $contadorx="dsidentificacion_counter";$valorx="40";$formax="u";$campox="dsidentificacion";$maxl="255"?>
              <input type=text name="<? echo $campox?>" size="<? echo $valorx?>" maxlength="<? echo $maxl?>" class=text1 value="<? echo $dsidentificacion?>">
              <?
                $nombre_capa="capa_dsidentificacion";
                $mensaje_capa="Debe ingresar la Identificacion del cliente";
                include("../../../incluidos_modulos/control.capa.php");
                include("../../../incluidos_modulos/control.letras.php");?>
              </td>
            </tr>

            <tr>
              <td><p>Telefono 1</p></td>
              <td colspan="2">
              <? $contadorx="dstelefono_counter";$valorx="40";$formax="u";$campox="dstelefono";$maxl="255"?>
              <input type=text name="<? echo $campox?>" size="<? echo $valorx?>" maxlength="<? echo $maxl?>" class=text1 value="<? echo $dstelefono?>">

              </td>
              <td><p>Telefono 2</p></td>
              <td colspan="2">
              <? $contadorx="dstelefono2_counter";$valorx="40";$formax="u";$campox="dstelefono2";$maxl="255"?>
              <input type=text name="<? echo $campox?>" size="<? echo $valorx?>" maxlength="<? echo $maxl?>" class=text1 value="<? echo $dstelefono2?>">

              </td>
            </tr>

            <tr >
              <td><p>Movil</p></td>
              <td colspan="2">
              <? $contadorx="dsmovil_counter";$valorx="40";$formax="u";$campox="dsmovil";$maxl="255"?>
              <input type=text name="<? echo $campox?>" size="<? echo $valorx?>" maxlength="<? echo $maxl?>" class=text1 value="<? echo $dsmovil?>">

              </td>
              <td><p>Fax</p></td>
              <td colspan="2">
              <? $contadorx="dsfax_counter";$valorx="40";$formax="u";$campox="dsfax";$maxl="255"?>
              <input type=text name="<? echo $campox?>" size="<? echo $valorx?>" maxlength="<? echo $maxl?>" class=text1 value="<? echo $dsfax?>">
              </td>
            </tr>

            <tr >
              <td><p>Pais</p></td>
              <td colspan="2">
              <? $contadorx="dspais_counter";$valorx="40";$formax="u";$campox="dspais";$maxl="255"?>
              <input type=text name="<? echo $campox?>" size="<? echo $valorx?>" maxlength="<? echo $maxl?>" class=text1 value="<? echo $dspais?>">
              </td>
              <td><p>Departamento</p></td>
              <td colspan="2">
              <? $contadorx="dsdepartamento_counter";$valorx="40";$formax="u";$campox="dsdepartamento";$maxl="255"?>
              <input type=text name="<? echo $campox?>" size="<? echo $valorx?>" maxlength="<? echo $maxl?>" class=text1 value="<? echo $dsdepartamento?>">
              </td>
            </tr>

            <tr >
              <td><p>Ciudad</p></td>
              <td colspan="2">
              <? $contadorx="dsciudad_counter";$valorx="40";$formax="u";$campox="dsciudad";$maxl="255"?>
              <input type=text name="<? echo $campox?>" size="<? echo $valorx?>" maxlength="<? echo $maxl?>" class=text1 value="<? echo $dsciudad?>">
              </td>

              <td><p>Direccion</p></td>
              <td colspan="2">
              <? $contadorx="dsdireccion_counter";$valorx="40";$formax="u";$campox="dsdireccion";$maxl="255"?>
              <input type=text name="<? echo $campox?>" size="<? echo $valorx?>" maxlength="<? echo $maxl?>" class=text1 value="<? echo $dsdireccion?>">

              </td>
            </tr>

            <tr >
              <td><p>Empresa</p></td>
              <td colspan="2">
              <? $contadorx="dsempresa_counter";$valorx="40";$formax="u";$campox="dsempresa";$maxl="255"?>
              <input type=text name="<? echo $campox?>" size="<? echo $valorx?>" maxlength="<? echo $maxl?>" class=text1 value="<? echo $dsempresa?>">
              </td>
              <td><p>Cargo</p></td>
              <td colspan="2">
              <? $contadorx="dscargo_counter";$valorx="40";$formax="u";$campox="dscargo";$maxl="255"?>
              <input type=text name="<? echo $campox?>" size="<? echo $valorx?>" maxlength="<? echo $maxl?>" class=text1 value="<? echo $dscargo?>">

              </td>
            </tr>

            <tr>
              <td><p>Fecha De Nacimiento</p></td>
               <td  colspan="2">
              <input type=text name="dsfechanacimiento" size=10 maxlength="10" class=text1 value="<? echo $dsfechanacimiento?>">
              <img align="absmiddle" SRC="../../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechanacimiento', this);" language="javaScript">
              </td>

              <td colspan="2"><p>Acepto Condiciones de Registro</p></td>
              <td  colspan="2">
              <select name="dsacepta" class="textnegro">
              <option value="SI">SI</option>
              <option value="NO">NO</option>
              </select>
              </td>
            </tr>

            
          <tr>
            <td align="center" colspan="7" >
            <?
            $forma="u";
            $param="dsnombres,dsapellidos,dsclave,idactivo,dscorreocliente,dsidentificacion";
            include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>
            </td>
        </tr>

        </form>
    </table>

    </td>
  </tr>
</table>
