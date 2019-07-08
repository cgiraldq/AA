<? 
/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
*/
$rutx=1;

if($rutx==1) $rutxx="../";
$titulomodulo="Configurar filtros de la campaña";

include ($rutxx."../../incluidos_modulos/comunes.php");
include ($rutxx."../../incluidos_modulos/varconexion.php");
include ($rutxx."../../incluidos_modulos/modulos.funciones.php");
include ($rutxx."../../incluidos_modulos/sessiones.php");
include ($rutxx."../../incluidos_modulos/func.calendario_2.php"); // funcion nueva del calendario
include ($rutxx.'../../PHPMailer_v5.1/class.phpmailer.php');
include ($rutxx."../../PHPMailer_v5.1/class.smtp.php");

$idcampana=$_REQUEST['idcampana'];

$dsmcampana=seldato('nombre','id','crm_campaas',$idcampana,1);
$dsdcampana=seldato('descripcion','id','crm_campaas',$idcampana,1);
$contarmail=seldato('count(id)','1','crm_mailing','1 and idactivo not in (2,9)',1);

include('filtros.enviar.mail.proceso.php');

?>
<html>

  <?include($rutxx."../../incluidos_modulos/head.php");?>

  <link rel="stylesheet" href="http://www.comprandofacil.com/pide/corehome/css_modulos/style.core.css" type="text/css" media="all" rel="stylesheet" >
  <link rel="stylesheet" href="<? echo $rutxx;?>../../css_modulos/core.graficas.css">
  <link rel="stylesheet" href="<? echo $rutxx;?>../../css_modulos/core.crm.css">
  <script type="text/javascript">
  function MostraPreview(){

	var mail = document.getElementById("mail").value; 
	    
	conexion1=AjaxObj();
    contenedor1="cargar_mail";
    conexion1.open("POST","../../validaciones/mostrar.preview.email.php?mail="+mail,true);

    conexion1.onreadystatechange =function() {
    if (conexion1.readyState==4) {
        var _resultado = conexion1.responseText;
        if (_resultado !="0" && _resultado !="-1" && _resultado !="") {
        if (contenedor1){
	        contenedor1=document.getElementById(contenedor1);
	        contenedor1.innerHTML = _resultado;
	        document.getElementById('enviar').style.display='';
        	}
      	  } 
        } // fin conexion1
      } // fin funcion conexion1 interna
      conexion1.send(null) // limpia conexion    

}
function ActivarPreview()
{
	document.getElementById('link_preview').style.display='';
}
  </script>

<body>
	<?if($contarmail > 0){ ?>
<section>
	<h1><? echo $dsmcampana; ?></h1>
	<p><? echo $dsdcampana; ?></p>
	<form action="" method="post">
		<fieldset>
			<label>Seleccione email a enviar</label>
			<select name="mail" id="mail" onchange="ActivarPreview()">
				<option value="0">-- Mail --</option>
				<? 
					$sql="select id,asunto from crm_mailing where idactivo not in (2,9)";
					$resultM=$db->Execute($sql);

					if(!$resultM->EOF)
					{
						while(!$resultM->EOF)
						{
							$idmail=$resultM->fields[0];
							$dsmasunto=$resultM->fields[1];
						?>	

					<option value="<? echo $idmail; ?>"><? echo $dsmasunto; ?></option>

				<?
						$resultM->MoveNext();
						}
					}
					$resultM->Close();

				?>
				
			</select>
			<label onclick="MostraPreview()" style="display:none;cursor:pointer;" id="link_preview">Previsualizar</label>
		</fieldset>
		<fieldset>
			<label>Seleccione servicio de envio</label>
			<select name="servicio" id="servicio">
				<option value="0">-- Servicio --</option>
				<? 
					$sql="select id,titulo from crm_servicios_mailing where idactivo not in (2,9)";
					$resultS=$db->Execute($sql);

					if(!$resultS->EOF)
					{
						while(!$resultS->EOF)
						{
							$idsermail=$resultS->fields[0];
							$dsmtituser=$resultS->fields[1];
						?>	

					<option value="<? echo $idsermail; ?>"><? echo $dsmtituser; ?></option>

				<?
						$resultS->MoveNext();
						}
					}
					$resultS->Close();

				?>
				
			</select>	
		</fieldset>
		<div style="text-align:center;">
			<input type="submit" value="Enviar" id="enviar" style="display:none">
			<input type="hidden" name="enviar" value="1">
			<input type="hidden" name="idcampana" value="<? echo $idcampana; ?>">
		</div>
	</form>
<div id="cargar_mail"></div>
</section>
<? }else{?>
	<h1>No se han creado mails para enviar</h1>
<? } ?>

    </body>
</html>