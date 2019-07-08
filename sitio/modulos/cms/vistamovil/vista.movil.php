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
    <!-- LIGHTBOX  -->

    <link rel="stylesheet" href="<? echo $rutxx;?>../../css_modulos/colorbox.css" type="text/css" media="all" rel="stylesheet" >
    <script type="text/javascript" language="javascript" src="<? echo $rutxx;?>../../js_modulos/jquery.colorbox.js"></script>
        <script>
            $(document).ready(function(){
                //Examples of how to assign the Colorbox event to elements
                $("#vista_movil").colorbox({iframe:true, width:"20%", height:"65%"});

                //Example of preserving a JavaScript event for inline calls.
                $("#click").click(function(){
                    $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
                    return false;
                });
            });
        </script>

    <!-- LIGHTBOX  -->

<table width="100%" cellpadding="0" cellspacing="0" align="center"  class="cont_general">
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">


<table width="70%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
        <tr>
         	<td width="615" align="left" valign="middle">
        		<img src="<? echo $rutxx;?>../../img_modulos/modulos/edicion.png">
         		<h1>Configuraciones vista m&oacute;vil</h1>
         	</td>
        </tr>
</table>

<table align="center"  cellspacing="1" cellpadding="1" border="0" width=100% class="cont_vista_movil">

	<tr>
		<td >
			<img src="<? echo $rutxx;?>../../img_modulos/phone.png">
		</td>

		<td>
			<table align="center"  cellspacing="1" cellpadding="1" border="0" width=100% class="campos_ingreso info_vista_movil">
				<form action="<? echo $pagina;?>" method=post name=u>

				<tr>
					<td colspan="4">
						<h1>Modifica la aplicación del sitio</h1>
						<p>Lleve a su negocio a nuevas alturas! Llegar a nuevos clientes y aumentar su
							cuenta de resultados mediante la integración de comercio electrónico,
							su catálogo de productos y mucho más.</p>
					</td>
				</tr>

				<tr valign=top class="btn_vista_movil">

					<td>
						<input type='button' name=enviar value="Banners"  class="botones" onClick=" window.location.href='vista.banner.php' ">
					</td>

		          <td>
		            <input type='button' name=enviar value="Videos"  class="botones" onClick=" window.location.href='vista.videos.php' ">
		          </td>

					<td>
						<input type='button' name=enviar value="Asociar paginas"  class="botones" onClick=" window.location.href='vista.paginas.php' " >
					</td>

					<td align="center">
						<div id="content">
							<a  class="botones" id="vista_movil" href="../../../movil/">Vista Previa</a>
						</div>
					</td>
				</tr>

				</form>
				</table>
		</td>
	</tr>
</table>

</td>
</tr>
</table>

