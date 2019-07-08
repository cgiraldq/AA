<article class="cont_noticas_centro_detalle">
	          <?
// cargar los datos de envio
$sql="select dspara,dsciudadenvio,dsvalorenvio,dsdireccionenvio";
$sql.=",dstelefonoenvio,dsmensajeenvio,dsobsenvio,dszonaenvio,dstipodirenvio ";
$sql.=",dstipoenvio,dsfechaenvio,dshoraenvio ";
$sql.="from tbltemporalcompras where idconsec=$idconsec ";
$sql.=" and dsfecha='".$_SESSION['dsfechacompra']."' and idcliente='".$_SESSION['idcomprador']."' and idtienda=$idtienda ";
//echo $sql;

$resultx=$db->Execute($sql);
if(!$resultx->EOF){
$dspara=($resultx->fields[0]);
$dsciudadenvio=($resultx->fields[1]);
$dsvalorenvio=($resultx->fields[2]);
$dsdireccionenvio=($resultx->fields[3]);
$dstelefonoenvio=($resultx->fields[4]);
$dsmensajeenvio=($resultx->fields[5]);
$dsobsenvio=($resultx->fields[6]);
$dszonaenvio=($resultx->fields[7]);
$dstipodirenvio=($resultx->fields[8]);
$dstipoenvio=($resultx->fields[9]);
$dsfechaenvio=($resultx->fields[10]);
$dshoraenvio=($resultx->fields[11]);


}
$resultx->Close();
          ?>



          <article id="form_contacto" class="paso2_flores">
      <form method=post name="u" action="datosenvio.php">
        <input type=hidden name="paso" value="1">
        <input type=hidden name="idconsec" value="<? echo $idconsec?>">
        <input type=hidden name="idproducto" value="<? echo $idproducto?>">

            <table id="paso2_flores" cellpacing="20" cellpadding="5">
             
              <tr>
                <td><label>Qué desea hacer?</label></td>
                <td><select name="dstipoenvio" id="dstipoenvio" onchange="seleccione('u')">
                <option value="1" <? if ($dstipoenvio==1) echo "selected";?>>Enviar a domicilio</option>
                <option value="2" <? if ($dstipoenvio==2) echo "selected";?>>Recoger en Local</option>
              </select> </td>
              </tr>
              <tr>
                <td><label for="">Nombre y apellidos para quién va dirigido el arreglo:* </label></td>
                <td><input type="text" name="dspara" id="dspara" value="<? echo $dspara;?>" onBlur="ocultar('capa_dspara')"> </td>
              </tr>
              <tr >
                <td></td>
                <td><span id="capa_dspara" style="display:none" class="camp_requerido">Campo obligatorio</span> </td>
              </tr>
              <tr>
                <td><label for="" id="txt_dstelefonoenvio">Teléfono / Extensión / Móvil: *</label></td>
                <td><input type="text" name="dstelefonoenvio" id="dstelefonoenvio" value="<? echo $dstelefonoenvio?>" onBlur="ocultar('capa_dstelefonoenvio')"> </td>
              </tr>
               <tr >
                <td></td>
                <td><span id="capa_dstelefonoenvio" style="display:none" class="camp_requerido">Campo obligatorio</span> </td>
              </tr>
              <tr>
                <td><label for="" id="txt_dszonaenvio">Zona / Sector *:</label></td>
                <td>
                  <select name="dszonaenvio" id="dszonaenvio">
                  
                  <option value="0" <? if ($dszonaenvio=="0") echo "selected";?>>Seleccione</option>
                  <?
              $sql="select id,dsciudad,idvalor from tblfletes where idactivo=1 order by dsciudad asc ";
              $result=$db->Execute($sql);
              if(!$result->EOF){
              while(!$result->EOF){
                ?>
                <option value="<? echo $result->fields[0]?>|<? echo $result->fields[2]?>" <? if ($result->fields[0]==$dszonaenvio) echo "selected"?>><? echo $result->fields[1];//." ".$result->fields[2]; ?></option>
                <?

               $result->MoveNext(); 
                          } 
              }
              $result->Close();

                  ?>

                </select> </td>
              </tr>
               <tr >
                <td></td>
                <td><span id="capa_dszonaenvio" style="display:none" class="camp_requerido">Campo obligatorio</span> </td>
              </tr>
              <tr>
                <td><label for="" id="txt_dstipodirenvio">Tipo de dirección *:</label></td>
                <td><select name="dstipodirenvio" id="dstipodirenvio" onchange="ocultar('capa_dstipodirenvio')">
          
               <option value="casa" <? if($dstipodirenvio=="casa"){echo " selected";} ?>>Casa</option>
              <option value="oficina" <? if($dstipodirenvio=="oficina"){echo " selected";} ?>>Oficina</option>
              <option value="apartamento" <? if($dstipodirenvio=="apartamento"){echo " selected";} ?>>Apartamento</option>
              <option value="otro" <? if($dstipodirenvio=="otro"){echo " selected";} ?>>Otro</option>
                        </select> </td>
              </tr>
               <tr >
                <td></td>
                <td><span id="capa_dstipodirenvio" style="display:none" class="camp_requerido">Campo obligatorio</span> </td>
              </tr>
              <tr>
                <td><label id="txt_dsdireccionenvio">Dirección *</label></td>
                <td><input type="text" name="dsdireccionenvio" id="dsdireccionenvio" value="<? echo $dsdireccionenvio?>"> </td>
              </tr>
               <tr >
                <td></td>
                <td><span id="capa_dsdireccionenvio" style="display:none" class="camp_requerido">Campo obligatorio</span> </td>
              </tr>
              <tr>
                <td><label for="" id="txt_dsobsenvio">Observaciones particulares a la dirección:</label></td>
                <td><textarea name="dsobsenvio" id="dsobsenvio" ><? echo $dsobsenvio?></textarea>
                </td>
              </tr>
              <tr>
                <td></td>
                <td><span id="txt_dsobsenvio_add" style="font-size:11px; color:#999;margin-top: -10px;">Si es un apartamento por favor indicar como se llama la unidad. 
Si es oficina o empresa, favor indicar el nombre y el area específica, además donde se encuentra la persona que recibe el pedido. Es importante nombre un punto de referencia para ser mas ágil y oportuno en la entrega. </span></td>
              </tr>
              <tr>
                <td>
<a name="b"></a>
            
<label for=""><img src="images/message.png" alt=""> El pedido lleva una tarjeta.Incluya el mensaje que desee <a href="#b" style="color:#f90" onclick="window.open('productos.detalle.mensaje.lista.php?enc=1&campobase=dsmensajeenvio','ventana','scrollbars=yes,width=800,height=600,left=1,top=1,resizable=yes,menubar=yes,toolbar=yes');">ver mensajes</a></label></td>
                <td><textarea name="dsmensajeenvio" id="dsmensajeenvio" onKeyPress="ocultar('capa_dsmensajeenvio')" ><? echo $dsmensajeenvio;?></textarea>

<br>
<span id="capa_dsmensajeenvio" style="display:none" class="camp_requerido">Campo obligatorio</span> 

                </td>
              </tr>

              <tr>
                <td></td>
                <td><span style="font-size:11px; color:#999;margin-top: -10px;">**Recuerde escribir al final del mensaje quién(es) lo envía(n).</span></td>
              </tr>

<tr>
<td><label id="txt_dsfechaenvio">Seleccione la fecha de env&iacute;o</label></td>
<td>
<input type=text name="dsfechaenvio" id="dsfechaenvio" size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechaenvio')"  value="<? echo $dsfechaenvio?>">
<img align="absmiddle" SRC="img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechaenvio', this);" language="javaScript"> 
<span id="capa_dsfechaenvio" style="display:none" class="camp_requerido"><br>Campo obligatorio</span> 
</td>
</tr>

              <tr>
                <td><label id="txt_dshoraenvio">Hora de envio del arreglo</label></td>
                <td><select name="dshoraenvio" id="dshoraenvio" >
                    <option value="09:00 AM 13:00 PM" <? if ($dshoraenvio=="09:00 AM 13:00 PM") echo "selected";?>>Ma&ntilde;ana (de 9 AM a 1 PM)</option>
                    <option value="14:00 PM 19:00 PM" <? if ($dshoraenvio=="14:00 PM 19:00 PM") echo "selected";?>>Tarde (de 2 PM a 6 PM)</option>
              </select> </td>
              </tr>


              <tr>
                <td></td>
                <td><article id="flores">
						<input type="button" value="Guardar y Continuar" class="btn_general" onclick="val('u')"> 

              </article></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
              </tr>
            </table>


             
             




              
          </form>

          </article>


                                
	

</article>





