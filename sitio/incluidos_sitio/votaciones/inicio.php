<article class="cont_txt">
<h1><? echo reemplazar($dstituloPagina);?></h1>
<h1><? echo reemplazar($dsdescr);?></h1>


<article class="bloque_texto cont_votaciones">

        <article class="bloque_voto">
          <img src="images/vote.png">
          <h2>Bienvenido al sistema de votaciones.</h2>
          <p> Por favor ingrese su identificacion o el codigo de asociado y la clave
          </p>
        </article>


<article class="cont_frm_horizontal">

  <form action="modulos/validaciones/votaciones.php" name="frm_contacto" method="post" id="frm_contacto">
    <?
      $forma="frm_contacto";
      /*$param="captcha";*/
      $param="dsusuario,dsclave,captcha";
    ?>
    <fieldset>
      <label for="dsusuario">Codigo o Identificacion *</label>
      <div><input type="text" name="dsusuario" id="dsusuario" onkeypress="ocultar('capax_dsusuario')"></div>
      <span class="camp_requerido" id="capax_dsusuario" style="display:none;"></span>
    </fieldset>
    <fieldset>
      <label for="dsclave">Clave</label>
      <div><input type="password" name="dsclave" id="dsclave" onkeypress="ocultar('capax_dsclave')"></div>
      <span class="camp_requerido" id="capax_dsclave" style="display:none;"></span>
    </fieldset>


    <?include("incluidos_sitio/captcha.php");?>
    <fieldset class="btns">
      <input type="button" value="Enviar" class="btn_color" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rutalocal."/"; ?>');">
    </fieldset>
  </form>
</article>



</article>

</article>