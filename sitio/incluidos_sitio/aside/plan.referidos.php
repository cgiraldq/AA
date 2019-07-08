
<article class="cont_referidos_lateral">

		<h2>PLAN DE REFERIDOS</h2>
		<p>
			Si está interesado en tener su propio negocio
			de ropa de dormir Adriana Arango, diligencie
			esta información y nos pondremos en contacto.
		</p>

        <form action="<? echo $rutalocal;?>/modulos/validaciones/referidos.php" method="post" name="form_referidosxs" id="form_referidosxs">
            
        <fieldset>
            <div><input type="text" placeholder="Nombre del referido " name="dsnombrex" id="dsnombrex"  onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsnombrex','')"></div>
            <span class="camp_requerido" id="capax_dsnombrex" style="display:none;">Campo Requerido</span>
        </fieldset>
        <fieldset>
            <div><input type="text" placeholder="Email del referido " name="email" id="email"  onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_email','')"></div>
            <span class="camp_requerido" id="capax_email" style="display:none;">Campo Requerido</span>
        </fieldset>

        <fieldset>
            <div><input type="text" placeholder="Teléfono del referido " name="telefono" id="telefono"  onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_telefono','')"></div>
            <span class="camp_requerido" id="capax_telefono" style="display:none;">Campo Requerido</span>
        </fieldset>

        <nav class="btn_centro">
            <a  class="btn" onclick="valUpx('form_referidosxs','dsnombre,email,telefono');">INGRESAR REFERIDO</a>
            <a href="#referidos">Ver m&aacute;s referidos</a>
        </nav>
        </form>


</article>
<script type="text/javascript">
    function valUpx () {

    if(document.getElementById('dsnombrex').value==""){
    document.getElementById('capax_dsnombrex').style.display="";
    return;
    }
        if(document.getElementById('email').value==""){
    document.getElementById('capax_email').style.display="";
    return;
    }

    if(document.getElementById('telefono').value==""){
    document.getElementById('capax_telefono').style.display="";
    return;
    }
   document.form_referidosxs.submit();

    }

</script>