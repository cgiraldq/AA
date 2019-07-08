<? 

/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
====================================================================

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


$idcliente=$_REQUEST['idcliente'];
$idcampana=$_REQUEST['idcampana'];
//$db->debug=true;

$dsnombre=seldato('nombre_o_razn_social','id','crm_clientes',$idcliente,1);

$dsapellido=seldato('apellido_o_nombre_comercial','id','crm_clientes',$idcliente,1);


include('filtros.cargar.encuesta.cliente.proceso.php');


?>

<html>



  <?include($rutxx."../../incluidos_modulos/head.php");?>



  <link rel="stylesheet" href="http://www.comprandofacil.com/pide/corehome/css_modulos/style.core.css" type="text/css" media="all" rel="stylesheet" >

  <link rel="stylesheet" href="<? echo $rutxx;?>../../css_modulos/core.graficas.css">

  <link rel="stylesheet" href="<? echo $rutxx;?>../../css_modulos/core.crm.css">

  <script type="text/javascript">

  function MostrarEncuesta(){

	var encuesta = document.getElementById("encuesta").value;
	conexion1=AjaxObj();
    contenedor1="cargar_encuesta";
    conexion1.open("POST","../../validaciones/mostrar.encuesta.email.php?encuesta="+encuesta,true);

    conexion1.onreadystatechange =function() {

    if (conexion1.readyState==4) {

        var _resultado = conexion1.responseText;

        if (_resultado !="0" && _resultado !="-1" && _resultado !="") {

        if (contenedor1){

	        contenedor1=document.getElementById(contenedor1);

	        contenedor1.innerHTML = _resultado;

	        
	        document.getElementById("enviar").style.display='';

        	}

      	  } 

        } // fin conexion1

      } // fin funcion conexion1 interna

      conexion1.send(null) // limpia conexion    



}

  </script>
<body>
<br />
<br />
<section style='margin-left:15px;'>
	<h1>Realizar encuesta a:&nbsp;&nbsp;<br /> <? echo strtoupper($dsnombre.' '.$dsapellido); ?></h1>
	<form action="" method="post">
		<fieldset>
			<label>Seleccione Encuesta a realizar:</label>
		
			<select name="encuesta" id="encuesta" onchange="MostrarEncuesta()">
				<option value="0">-- Encuestas --</option>
				<? 
					$sql="select id,titulo from crm_encuestas where idactivo not in (2,9)";
					$resultM=$db->Execute($sql);

				if(!$resultM->EOF)
					{
						while(!$resultM->EOF)
						{
							$idencuesta=$resultM->fields[0];
							$dsmtitulo=$resultM->fields[1];
						?>	
								<option value="<? echo $idencuesta; ?>"><? echo $dsmtitulo; ?></option>
							<?

						$resultM->MoveNext();

						}
					}
					$resultM->Close();
				?>

			</select>
		</fieldset>
		<?

		$sql="select pregunta_asociada,respuesta_asociada,campaa_asociada,encuesta_asociada from crm_cliente_por_encuesta where cliente_asociado = $idcliente and campaa_asociada = $idcampana group by pregunta_asociada ";
		$result=$db->Execute($sql);
		if(!$result->EOF)
		{
			 ?>
			<div>
				<h1>
					
				</h1>
				<?
				$con=0;
				while(!$result->EOF)
				{
				$idencue=$result->fields[3];
				$encuenta=seldato('titulo','id','crm_encuestas',$idencue,1);
				if($con==0)echo "<h1>".$encuenta."</h1>";
				$idpreg=$result->fields[0];	
				$idresp=$result->fields[1];
				$pregunta=seldato('titulo','id','crm_preguntas',$idpreg,1);
				$idactivo=seldato('idactivo','id','crm_preguntas',$idpreg,1);
				$respuesta=$idresp;
				if($idactivo<>3)$respuesta=seldato('titulo','id','crm_respuestas',$idresp,1);
				echo $pregunta."<br />";
				echo "&nbsp;&nbsp;".$respuesta."<br/><br/>";
				$con++;
				$result->MoveNext();
				}	
				?>
			</div>
			<?
			$result->Close();
		}


		 ?>
		<div id="cargar_encuesta"></div>
		<div style="margin-left:15px;text-align:center;">
			<input type="submit" value="Guardar" id="enviar" style="display:none">
			<input type="hidden" name="enviar" value="1">
			<input type="hidden" name="idcliente" value="<? echo $idcliente; ?>">
			<input type="hidden" name="idcampana" value="<? echo $idcampana; ?>">
		</div>
	</form>


</section>

    </body>

</html>