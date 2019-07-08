
<article class="cont_txt">

      <h1><? echo $dstituloPagina?></h1>
      <article class="bloque_texto">

        <article class="zona_clientes">
          <img src="images/33.jpg">
          <p>En esta sesión udsted prodrá acceder a información exclusiva</p>

          <ul>
            <li><p>Noticias y novedades privadas</p></li>
            <li><p>Actualización de datos</p></li>
            <li><p>Documentos privados</p></li>
            <li><p>Videos exclusivos</p></li>
          </ul>

          <p>Si ya está registrado solo ingrese su usuario y clave de lo contrario lo invitamos a realizar su registro en
            el botón de <span>"Regístrese a la zona privada"</span></p>


        </article>

        <article class="cont_registro">

          <h1>INGRESAR A LA ZONA PRIVADA</h1>

          <? $idno=$_REQUEST['idno'];?>
          <? if ($idno==1) {?> <p style="color:red" >Contraseña o usuario incorrecto<p> <?}elseif ($idno==2)  { ?><p style="color:red" >Debe digitar los campos <p> <? } ?>
          <? if ($_SESSION['i_idregist']=="")  { #"";?>

          <form action="<? echo $rutbase;?>modulos/validaciones/validar.registro.php" name="" id="frm_zona_privada">
          <fieldset>
            <label>USUARIO:</label>
            <input type="text" name="usuariol" id="usuariol" placeholder="USUARIO">
          </fieldset>
          <fieldset>
            <label>CLAVE:</label>
            <input type="password" name="clave" id="clave" placeholder="CLAVE">
          </fieldset>
          <fieldset class="boton">
            <input type="submit" name="" id="" value="ENTRAR" class="btn_color">
          </fieldset>
          <fieldset class="otros_link">
            <a href="<? echo $rutbase ?>recuperar.contrasena.php">¿Olvido su Contraseña?</a>
          </fieldset>
          </form>

          <?  }  ?>

          <article class="enlace_registro">
            <p>SI AÚN NO ESTÁ REGÍSTRADO HAGA CLIC EN EL SIGUIENTE BOTÓN</p>
            <a href="registro.php"><h1>REGISTRESE A LA ZONA PRIVADA</h1></a>

          </article>

        </article>

    </article>
</article>
