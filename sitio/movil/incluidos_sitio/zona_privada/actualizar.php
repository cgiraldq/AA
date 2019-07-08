    <article class="cont_frm_horizontal">
        <article class="txt_qsomos" >
            <h1>Actualiza tus Datos</h1>
            <p></p>
            <p>
            <?

            if ($_REQUEST['mensaje']=="1") echo "<strong>Datos Actualizados Correctamente</strong>";?>

            </p>
        </article>
        <?
            $sqlac="select dsnombres,dsapellidos,dstipoidentificacion,dsidentificacion,dscorreocliente,dstelefono,dstelefono2,dsmovil,dsfax,dsdireccion,dsempresa,dscargo,dsciudad,dsdepartamento,dsfacebook,dstwitter,dsfechanacimiento,id,dsacepto from tblclientes where id=".$_SESSION['i_idcliente'];
            //echo $sqlac;
            $resultac=$db->Execute($sqlac);
            if(!$resultac->EOF){
                $dsnombres=reemplazar($resultac->fields[0]);
                $dsapellidos=reemplazar($resultac->fields[1]);
                $dstipoidentificacion=$resultac->fields[2];
                $dsidentificacion=trim($resultac->fields[3]);
                $dscorreocliente=$resultac->fields[4];
                $dstelefono=trim($resultac->fields[5]);
                $dstelefono2=trim($resultac->fields[6]);
                $dsmovil=trim($resultac->fields[7]);
                $dsfax=trim($resultac->fields[8]);
                $dsdireccion=trim(reemplazar($resultac->fields[9]));
                $dsempresa=trim(reemplazar($resultac->fields[10]));
                $dscargo=trim(reemplazar($resultac->fields[11]));
                $dsciudad=trim(reemplazar($resultac->fields[12]));
                $dsdepartamento=trim(reemplazar($resultac->fields[13]));
                $dsfacebook=trim(reemplazar($resultac->fields[14]));
                $dstwitter=trim(reemplazar($resultac->fields[15]));
                $dsfechanacimiento=trim($resultac->fields[16]);
                $dsfechanacimiento=explode("/", $dsfechanacimiento);
                $id=trim($resultac->fields[17]);
                $dsacepto=trim($resultac->fields[18]);
        ?>

        <form action="modulos/validaciones/actualizar.zona.php" name="frm_actualizar_zona" method="post"  autocomplete="off" id="frm_actualizar_zona">
            <?
                $forma="frm_actualizar_zona";
                /*$param="captcha";*/
                $param="dsnombre,dscorreo,dsidentificacion";
            ?>
            <fieldset>
                <label for="dsnombre">Nombres *</label>
                <div><input type="text" name="dsnombre" id="dsnombre" value="<?echo $dsnombres?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsnombre','')"></div>
                <span class="camp_requerido" id="capax_dsnombre" style="display:none;"></span>
            </fieldset>
            <fieldset>
                <label for="dsapellido">Apellidos</label>
                <div><input type="text" name="dsapellido" id="dsapellido" value="<?echo $dsapellidos?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsapellido','')"></div>
                <span class="camp_requerido" id="capax_dsapellido" style="display:none;"></span>
            </fieldset>
            <fieldset>
                <label for="dstipoidentificacion">Tipo de identificaci&oacute;n*</label>
                <div>
                    <select name="dstipoidentificacion" id="dstipoidentificacion" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dstipoidentificacion','')">
                        <option value="">Seleccione</option>
                        <option value="CC" <?if ($dstipoidentificacion=="CC") echo "selected"?>>CC</option>
                        <option value="CE" <?if ($dstipoidentificacion=="CE") echo "selected"?>>CE</option>
                        <option value="PASAPORTE" <?if ($dstipoidentificacion=="PASAPORTE") echo "selected"?>>PASAPORTE</option>
                    </select>
                </div>
                <span class="camp_requerido" id="capax_dstipoidentificacion" style="display:none;"></span>
            </fieldset>
            <fieldset>
                <label for="dsidentificacion">N&uacute;mero de identificaci&oacute;n *</label>
                <div><input type="text" name="dsidentificacion" id="dsidentificacion" value="<?echo $dsidentificacion?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsidentificacion','')"></div>
                <span class="camp_requerido" id="capax_dsidentificacion" style="display:none;"></span>
            </fieldset>
            <fieldset class="fecha_nacimiento">
                <label for="">Fecha de Nacimiento *</label>
                <br>
                <article class="dia">
                    <select name="dsdia" id="dsdia">
                        <option value="">D&iacute;a</option>
                        <?
                            for($i=1;$i<=31;$i++){
                                if($i<10){
                                    $cero=0;
                                }else{
                                    $cero="";
                                }
                        ?>
                        <option value="<? echo $cero.$i; ?>" <?if ($dsfechanacimiento[2]==$cero.$i) echo "selected"?>><? echo $cero.$i; ?></option>
                        <? }?>
                    </select>
                </article>
                <article class="mes">
                    <select name="dsmes" id="dsmes">
                        <option value="">Mes</option>
                        <option value="01" <?if ($dsfechanacimiento[1]=='01') echo "selected"?>>Enero</option>
                        <option value="02" <?if ($dsfechanacimiento[1]=='02') echo "selected"?>>Febrero</option>
                        <option value="03" <?if ($dsfechanacimiento[1]=='03') echo "selected"?>>Marzo</option>
                        <option value="04" <?if ($dsfechanacimiento[1]=='04') echo "selected"?>>Abril</option>
                        <option value="05" <?if ($dsfechanacimiento[1]=='05') echo "selected"?>>Mayo</option>
                        <option value="06" <?if ($dsfechanacimiento[1]=='06') echo "selected"?>>Junio</option>
                        <option value="07" <?if ($dsfechanacimiento[1]=='07') echo "selected"?>>Julio</option>
                        <option value="08" <?if ($dsfechanacimiento[1]=='08') echo "selected"?>>Agosto</option>
                        <option value="09" <?if ($dsfechanacimiento[1]=='09') echo "selected"?>>Septiembre</option>
                        <option value="10" <?if ($dsfechanacimiento[1]=='10') echo "selected"?>>Octubre</option>
                        <option value="11" <?if ($dsfechanacimiento[1]=='11') echo "selected"?>>Noviembre</option>
                        <option value="12" <?if ($dsfechanacimiento[1]=='12') echo "selected"?>>Diciembre</option>
                    </select>
                </article>
                <article class="ano">
                    <label for="dsanio">A&ntilde;o</label>
                    <input type="text" name="dsanio" id="dsanio" value="<?echo $dsfechanacimiento[0]?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsanio','')">
                </article>
                <span class="camp_requerido" id="capax_dsanio" style="display:none;"></span>
            </fieldset>
            <fieldset>
                <label for="dscorreo">Email *</label>
                <div><input type="text" name="dscorreo" id="dscorreo" value="<?echo $dscorreocliente?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscorreo','')"></div>
                <span class="camp_requerido" id="capax_dscorreo" style="display:none;"></span>
            </fieldset>

            <fieldset>
                <label for="dstelefono">Tel&eacute;fono *</label>
                <div><input type="text" name="dstelefono" id="dstelefono" value="<?echo $dstelefono?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dstelefono','')"></div>
                <span class="camp_requerido" id="capax_dstelefono" style="display:none;"></span>
            </fieldset>
            <fieldset>
                <label for="tel_ofi">Tel&eacute;fono de la Oficina</label>
                <div><input type="text" name="tel_ofi" id="tel_ofi" value="<?echo $dstelefono2?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_tel_ofi','')"></div>
                <span class="camp_requerido" id="capax_tel_ofi" style="display:none;"></span>
            </fieldset>
            <fieldset>
                <label for="dsmovil">Celular *</label>
                <div><input type="text" name="dsmovil" id="dsmovil" value="<?echo $dsmovil?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsmovil','')"></div>
                <span class="camp_requerido" id="capax_dsmovil" style="display:none;"></span>
            </fieldset>
            <fieldset>
                <label for="dsfax">Fax</label>
                <div><input type="text" name="dsfax" id="dsfax" value="<?echo $dsfax?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsfax','')"></div>
                <span class="camp_requerido" id="capax_dsfax" style="display:none;"></span>
            </fieldset>
            <fieldset class="direccion">
                <label for="dsdireccion">Direccion exacta de entrega *</label>
                <div><input type="text" name="dsdireccion" id="dsdireccion" value="<?echo $dsdireccion?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsdireccion','')"></div>
                <span class="camp_requerido" id="capax_dsdireccion" style="display:none;"></span>
            </fieldset>
            <fieldset>
                <label for="dsempresa">Empresa</label>
                <div><input type="text" name="dsempresa" id="dsempresa" value="<?echo $dsempresa?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsempresa','')"></div>
                <span class="camp_requerido" id="capax_dsempresa" style="display:none;"></span>
            </fieldset>
            <fieldset>
                <label for="dscargo">Cargo</label>
                <div><input type="text" name="dscargo" id="dscargo" value="<?echo $dscargo?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscargo','')"></div>
                <span class="camp_requerido" id="capax_dscargo" style="display:none;"></span>
            </fieldset>
            <fieldset>
                <label for="dsciudad">Ciudad *</label>
                <div><input type="text" name="dsciudad" id="dsciudad" value="<?echo $dsciudad?>"  onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsciudad','')"></div>
                <span class="camp_requerido" id="capax_dsciudad" style="display:none;"></span>
            </fieldset>
            <fieldset>
                <label for="dsdepartamento">Departamento *</label>
                <div><input type="text" name="dsdepartamento" id="dsdepartamento" value="<?echo $dsdepartamento?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsdepartamento','')"></div>
                <span class="camp_requerido" id="capax_dsdepartamento" style="display:none;"></span>
            </fieldset>
            <fieldset>
                <label for="dsfacebook">Facebook</label>
                <div><input type="text" name="dsfacebook" id="dsfacebook"  value="<?echo $dsfacebook?>" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsfacebook','')"></div>
                <span class="camp_requerido" id="capax_dsfacebook" style="display:none;"></span>
            </fieldset>

            <fieldset>
                <label for="dstwitter">Twitter</label>
                <div><input type="text" name="dstwitter" id="dstwitter" value="<?echo $dstwitter?>"  onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dstwitter','')"></div>
                <span class="camp_requerido" id="capax_dstwitter" style="display:none;"></span>
            </fieldset>

<!--             <fieldset class="cont_boletin">
    <legend>Notificaciones por E-Mail</legend>
    <input type="checkbox" name="dsacepto" id="dsacepto" <?if ($dsacepto==1) echo "selected"?>> <label for="dsacepto">Desea recibir nuestro boletín</label>
</fieldset> -->
            <?//include("incluidos_sitio/captcha.php");?>
            <fieldset class="btns">
                <input type="hidden" value="<?echo $id?>" id="idx" name="idx">
                <input type="button" value="Modificar" class="btn_general" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rut ?>');">
            </fieldset>
        </form>
        <?
            }
            $resultac->Close();
        ?>
    </article>