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

$respuestas = $_REQUEST['respuetas'];
$preguntas = $_REQUEST['preguntas'];
$idcliente = $_REQUEST['idcliente'];
$idcampana = $_REQUEST['idcliente'];

$contarpreguntas=count($preguntas);
if($_REQUEST['enviar']==1)
{
	$h=0;
	for($i=0;$i<$contarpreguntas;$i++)
	{
		$sql="insert into crm_cliente_por_encuesta (cliente_asociado,pregunta_asociada,respuesta_asociada,campaa_asociada) values (";
		$sql.= "'".$idcliente."', '".$preguntas[$i]."','".$respuestas[$i]."','".$idcampana."'";
		$sql.=")";
		
		if($db->Execute($sql))
		{
			$h++;
		}
	
	}
	if($h>0)
		{
			echo "<table border='0' cellpadding='2' cellspacing='1' class='msm_verde'>
	     <tbody><tr>
		  <td align='center'>
		  	<h3>&nbsp;Se uardo la encuesta exitosamente.</h3>
		  </td>
		</tr>
	</tbody></table>";
	}else
	{
		echo "<table border='0' cellpadding='2' cellspacing='1' class='msm_rojo'>
	     <tbody><tr>
		  <td align='center'>
		  	<h3>&nbsp;Error guardando la encuesta</h3>
		  </td>
		</tr>
	</tbody></table>";
	}


}






?>