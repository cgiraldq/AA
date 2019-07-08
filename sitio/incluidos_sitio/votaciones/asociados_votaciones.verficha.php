<?
include('asociados_variables.php');
include('../incluidos_modulos/varconexion.php');
include('../incluidos_modulos/comunes.php');

$idx=$_REQUEST['idx'];
$dsx=$_REQUEST['dsx'];

$idy=$_REQUEST['idy'];
$dsy=$_REQUEST['dsy'];

$idtv=$_REQUEST['idtv'];
$dstv=$_REQUEST['dstv'];

$idfichax=$_REQUEST['idfichax'];
$idcandidatox=$_REQUEST['idcandidatox'];
$dscandidatox=$_REQUEST['dscandidatox'];




$dsrutax="../../contenidos/images/menuasociados/";
include('asociados_contenidogeneral.php');
include('asociados_head.php');
$rutaImagen="../../contenidos/images/auxilios/";
$fechafull=date("Ymd");
$horafull=date("Hi");

?>


<body>


<div class="principal">
	<div class="contenedor_principales">
	
	<div class="centro">
		
	
	
					<table style="width: 100%; border:1px #DDD solid; margin: 5px 0" cellpadding="3" cellspacing="3">
			
						<tr>
							<td><span class="tit_azullateral3">	Ficha de <? echo $dscandidatox?></span>
							<span class="subtitulo_asociados"></span></td> 
						</tr>
					</table>
					
		
<?
// los certificados
// FECHAS DE INSCRIPCION
							
include("asociados_votaciones.verficha.cuerpo.php");

// FIN FECHAS DE INSCRIPCION
?>

			


			
		
		
		</div><!-- Cierra centro -->
				
	</div><!-- Cierra contenedores_principales -->
	
</div><!-- Cierra principal -->

	
</body>

</html>
