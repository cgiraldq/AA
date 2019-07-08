<? 

/*serror_reporting(E_ALL);

ini_set("display_errors", 1);*/
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

include ($rutxx."../../incluidos_modulos/comunes.php");
include ($rutxx."../../incluidos_modulos/varconexion.php");
include ($rutxx."../../incluidos_modulos/modulos.funciones.php");
include ($rutxx."../../incluidos_modulos/sessiones.php");
include ($rutxx."../../incluidos_modulos/func.calendario_2.php"); // funcion nueva del calendario
//$db->debug=true;
$idcampana=$_REQUEST['idcampana'];
$guion = seldato('guion_telefonico_asociado','id','crm_campaas',$idcampana,1); 
$dsdguion = seldato('descripcion','id','crm_guion_telefonico',$guion,1);
$dsmguion = seldato('titulo','id','crm_guion_telefonico',$guion,1);
?>

<section style="margin-top:25px;margin-legt:20px;">
<h1><? echo $dsmguion; ?></h1>

<p>
<? echo  $dsdguion; ?>
</p>

</section>