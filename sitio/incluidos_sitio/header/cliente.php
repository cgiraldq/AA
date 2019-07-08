<?
session_start();
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2012Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
//ACCESO GENERICO DEL CLIENTE
$dsid=session_id();
$_SESSION['dsfecha']=date("YmdHis");
$pedir=$_REQUEST['pedir'];
if ($corporativo=="") $corporativo=0; // indica que debe pedir todos los datos
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/modulos.funciones.php");
$horario=modulos_activos("Horario no disponible");
?>
<html>
<head>
<title><? echo $AppNombre;?></title>
<link rel="stylesheet" type="text/css" href="../../css_modulos/chat.accesos.css">
<script language="JavaScript" src="../../js_modulos/ajax.js" type="text/javascript" ></script>
<script language="JavaScript" src="../../js_modulos/chat.js" type="text/javascript" ></script>
<script language="JavaScript" src="../../js_modulos/javageneral.js" type="text/javascript" ></script>


<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
     // validacion acceso
     function valI(){
     	<? if ($pedir=="1"){ ?>
		if (document.u.dsnit.value==""){
			alert("Ingrese su NIT o identificacion");
			document.u.dsnit.focus();
			return false;
	     }
     	<? }?>
		if (document.u.l.value==""){
			alert("Ingrese su nombre");
			document.u.l.focus();
			return false;
	     }

	     return true;

	  }
//-->
</SCRIPT>
<style>
body{
		background:url(../../img/bg.png) repeat;
}
</style>


</head>

<body color=#ffffff  topmargin=0 leftmargin=0 onLoad="javascript:document.u.l.focus();<? if ($horario==1 ){ ?>validar_horario('chat_estado','u');<?}?>
">

<body>
    <div id="chat_contenedor1">
    	<div class="chat_logo">
    <?
    $logoempresa=logoempresa();
    $rutaimagen="../../imagenes/empresa/";
    if (is_file($rutaimagen.$logoempresa)) {
    ?>
    <img src="<? echo $rutaimagen.$logoempresa?>"/>
    <? } ?>

	</div>
        <div id="chat_contenedor2">
        	<div class="chat_nombre">
                <h1>ASISTENCIA EN LINEA</h1>
            </div>

        	<div class="chat_formulario">
             <div class="chat_estado" id="chat_estado">
            	<p class="chat_remate">
                	<img src="../../img/on.png">
                </p>

            </div>

				<form action="../../modulos/validaciones/validar.registro.cliente.php" method=post name=u onSubmit="return valI();" id="u">
<?
$nit=modulos_activos("Pedir nit cliente");
if ($nit==1 && $pedir=="1"){
?>

			  <!--[if IE]>
                NIT:
                <![endif]-->

				<input type="text" name="dsnit" placeholder="NIT" class="" />
<?
}
?>

			  <!--[if IE]>
                Nombre:
                <![endif]-->

				<input type="text" name="l" placeholder="Nombre" class="chat_nombre" />

<?
if ($pedir=="0") {
?>
<fieldset>
								                <!--[if IE]>
								                Email:
								                <![endif]--><input type="text" name="dscorreo" placeholder="E-mail" class="chat_mail" />
								<?
								$tel=modulos_activos("Pedir Telefono Cliente");
								if ($tel==1 && $pedir=="0"){
								?>
</fieldset>
<fieldset>
												<!--[if IE]>
								                Telefono:
								                <![endif]--><input type="text" name="dstelefono" placeholder="Telefono" class="" />
								<?
								}
								$ciudad=modulos_activos("Pedir Ciudad Cliente");
								if ($ciudad==1 && $pedir=="0"){

								?>
</fieldset>
<fieldset>
												<!--[if IE]>
								                Ciudad:
								                <![endif]--><input type="text" name="dsciudad" placeholder="Ciudad" class="" />
</fieldset>
								<?
								}
} // fin validacion que el corporatiuvo este activo
$servicio=modulos_activos("Seleccione opcion Cliente");
if ($servicio==1){

?>

				<div class="chat_select">
                 <!--[if IE]>
                Seleccione:
                <![endif]-->

				<?
		$sql="select id,dsm from tblservicios where idactivo=1 order by dsm asc ";
		$result = $db->Execute($sql);
		 if (!$result->EOF) {
		?>
		<select name=servicio>
				<option value="">En que le podemos ayudar?</option>
				<option value="En General">En General</option>
		<?
			while (!$result->EOF) {
				$id=$result->fields[0];
				$dsm=$result->fields[1];

			?>
			<option value="<? echo $dsm?>"> <? echo $dsm?></option>
			<?
			$result->MoveNext();
			} // fin while
	?>
	</select>
	<?
	}


	$result->Close();
			?>
</div>
<?
}
?>
                <input type="submit" name="chat_entrar" value="Entrar" />
                <input type="button" name="chat_entrar" value="Cancelar" onClick="window.close();" />
                <input type="hidden" name="pedir" value="<? echo $pedir?>" />

                </form>
            <div class="chat_remate">
            <p>Sistemas de chat version 2.0 (c) 2000 - <? echo date("Y")?>.<br>
            Desarrollado por <a href="http://www.comprandofacil.co" target="_blank">Comprandofacil</a><img src="../../img/logo-cf.gif">
            </p>
            </div>
            </div>
         </div>
         <div class="sombra2"><img src="../../img/sombra.png"></div>
         <!--div class="chat_txtcondiciones">
             <p>
             	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec at dolor nec arcu ultrices elementum. Nullam et ipsum risus. Nam congue dolor non augue lobortis vehicula.
             </p>
         </div-->
    </div>
</body>
</html>



</body>
</html>
<?
include("../../incluidos_modulos/cerrarconexion.php");

?>