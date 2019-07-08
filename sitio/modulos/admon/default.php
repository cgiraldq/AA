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
// verificar la conexion antes de continuar

include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
// carga del logo de la empresa
    $rutaImagend="../../../contenidos/images/empresa/";
    $sqld="select id,dsnombre,dsimg1,copyright,dstitulo,codcliente from tblempresa where id=1";
    $resultd=$db->Execute($sqld);
    if(!$resultd->EOF){
	    $id=$resultd->fields[0];
	    $dsnombreempresa=reemplazar($resultd->fields[1]);
	    $dsimg1empresa=$resultd->fields[2];
	    $derechos=reemplazar($resultd->fields[3]);
	    $dstituloempresa=reemplazar($resultd->fields[4]);
	    $codcliente=reemplazar($resultd->fields[5]);
	 }
	 $resultd->close();
include("../../incluidos_modulos/cerrarconexion.php");

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><? echo $dsnombreempresa?></title>
<meta charset="utf-8" />
<link rel="shortcut icon" type="image/x-icon" href="<? echo $rutalocal;?>/favicon.ico">
<link href="css/estiloslogueo.css" rel="stylesheet" type="text/css" />
<script src="../../js_modulos/javageneral.js" type="text/javascript"></script>
<script src="../../js_modulos/ajax.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function valAcceso(forma,param){
//alert ('entra');
	var base="document."+forma+".";
	partir=param.split(",");
	n=partir.length;
	var tam=n-1;
	var i;
    var bError = false;
	var valor="";
	var x;
    for (i = 0; i < n; i++){
    x=eval(base + partir[i] + ".value");
    x=x.replace(/^\s+/,"");
     bError = bError || (x == "");
	 if (bError){
	 	eval(base + partir[i] + ".value=''");
		 document.getElementById('capax_'+partir[i]).style.display="";
		 eval(base + partir[i] + ".focus()");
		 valor=1;
		 break;
     } else {
	 	valor="";
	 }
    }
    if(partir[tam]=="captcha"){
    var texto=eval(base + partir[tam] + ".value");
		if (texto!="") {
			// cargar cliente y colocar las variables seleccionadas
			//alert(texto);
			conexion=AjaxObj();
			 conexion.open("POST","../../captcha/captcha.validar.php?captcha="+texto,true);
		     conexion.onreadystatechange =function() {
					 if (conexion.readyState==4) {
					 var _resultado = conexion.responseText;
					 //alert(_resultado);
						if (_resultado==1) {
							if(valor=="")eval(base+"submit()");
						}else{
							document.getElementById('capax_cap').style.display="";
							document.getElementById('captcha').src='../../captcha/captcha.php?'+Math.random();
							eval(base + partir[tam] + ".value=''");
							eval(base + partir[tam] + ".focus()");
							return;
						}
					} // fin funcion
			      } // fin conexion
			    //contenedor.innerHTML ="";
		conexion.send(null) // limpia conexion
	}
	}else{
		if(valor=="")eval(base+"submit()");
	}
	//if (valor=="")
}


function ocultar(capa) {
	var base=document.getElementById(capa);

	if (base) base.style.display="none";
}
//-->
</script>

</head>

<body>

	<section id="cont_admin">

	<div id="wrapper">

	<form action="../../modulos/validaciones/validar.php" method="post" name="uforma" id="uforma" class="login-form" >

		<div class="logo_admin">
            <? if(is_file($rutaImagend.$dsimg1empresa)){ ?>
				<img src="<? echo $rutaImagend.$dsimg1empresa ?>" >
            <? } ?>
		</div>

		<div class="header">
			<p valign="bottom">versi&oacute;n: <? echo $version;?>v<p></p>
		</div>

		<div class="content">
			<input name="l" id="l" type="text" class="input username" placeholder="Usuario *" onclick="ocultar('capax_l');ocultar('capax_error')" />
			<div class="user-icon"></div>

			<input name="c" id="c" type="password" class="input password" placeholder="Clave *" onclick="ocultar('capax_c')" />
			<div class="pass-icon"></div>

		</div>

		<div class="captcha_admin">
			<img src="../../captcha/captcha.php" id="captcha" />
				<a href="#a" onclick="document.getElementById('captcha').src='../../captcha/captcha.php?'+Math.random();"  id="change-image"><p >Cambiar imagen</p></a>
					<div class="input_admin">
						<input type="text" name="captcha" id="captcha" onclick="ocultar('capax_cap');ocultar('capax_captcha')"  />
					</div>
		</div>

		<div class="footer" valign="bottom" >
			<input type="button" name="botonera" value="INGRESAR" class="boton" onclick="valAcceso('uforma','l,c,captcha')" />
			<div id="capax_cap" style="display:none"  class="validacion">Debe ingresar captcha correctamente</div>
			<div id="capax_l" style="display:none"  class="validacion">Debe ingresar el usuario</div>
			<div id="capax_c" style="display:none"  class="validacion">Debe ingresar la clave</div>
			<div id="capax_captcha" style="display:none"  class="validacion">Debe ingresar la captcha</div>
			<? if($_REQUEST["mensaje"]==1){ ?>
			<div id="capax_error" class="validacion">Usuario o clave esta equivocados</div>
			<?}?>
		</div>

		<div class="remate_admin">

			<div class="derechos">
				<p>Diseño y Desarrollo  <a href="http://www.comprandofacil.co">Comprandofacil <img src="../../images/cf.png"> </a></p>
			</div>


		</div>


		</form>

	</div>

	<div class="bql_derecho_admin">

		<article class="bloque_superior">
			<img src="img_modulos/modulos/plataforma.png">
		</article>

		<ul>
			<li>
				<h2>CMS</h2>
				<img src="img_modulos/modulos/cms.png">
				<p>Administre su sitio web.</p>
			</li>

			<li>
				<h2>CRM</h2>
				<img src="img_modulos/modulos/crm.png">
				<p>Administre gestione sus clientes.</p>
			</li>

			<li>
				<h2>E-COMMERCE</h2>
				<img src="img_modulos/modulos/e-commerce.png">
				<p>Administre sus catalogos de productos, precios.</p>
			</li>

			<li>
				<h2>APPS</h2>
				<img src="img_modulos/modulos/apps.png">
				<p>Fortalezca su sitio web con nuevas aplicaciones.</p>
			</li>
		</ul>
	</div>

		<div class="info_contacto">
			<div>
				<img src="img_modulos/modulos/logo.png">
			</div>
			<div class="txt">
				<p>Teléfono: (574) 604 04 58</p>
				<p>Dirección: Calle 30 #75 - 23 (Interior 101)</p>
			</div>

			<div class="txt">
				<p>Colombia - Ecuador - UK - USA</p>
			</div>
		</div>

	</section>


</body>
</html>
