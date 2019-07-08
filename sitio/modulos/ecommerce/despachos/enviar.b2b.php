				
			<?	
			$rutx=1;
$rutxx="../";
include("../../../incluidos_modulos/modulos.globales.php");
		
			 
		 $contar=count($_REQUEST['validar']);


					for ($i=0; $i < $contar; $i++) { 
					
				
				if ($_REQUEST['validar']<>"")
			{

			$id=$_REQUEST['validar'][$i];	
		 $idpedido=$_REQUEST['id'][$i];
		 $idnumero=$_REQUEST['num'][$i];
		
		 $ciudad_origen=$_REQUEST['ciudad_origen'][$i];
		 $ciudad_destino=$_REQUEST['ciudad_destino'][$i];
		  $transporte=$_REQUEST['Transporte'][$i]."<br>";
		  $Cantidad=$_REQUEST['Cantidad'][$i]."<br>";
	 	 $direccion=$_REQUEST['direccion'][$i]."<br>";
		 $dstelefono=$_REQUEST['dstelefono'][$i]."<br>";
		 $celular=$_REQUEST['celular'][$i];
		// exit();
		 $dsidentificacion=$_REQUEST['dsidentificacion'][$i];
		 $idcomprax=$_REQUEST['idcompra'][$i];
			$idcompra=$idcomprax.$idnumero;
		 $idcliente=$_REQUEST['idcliente'][$i];	
		$nombrecliente=$_REQUEST['nombrecliente'][$i];

		 $totalvalorguia=$_REQUEST['totalvalorguia'][$i];


     $sqlr=" update ecommerce_tblpagos set ";
	$sqlr.=" iddespachado=1";
	$sqlr.=" where id='".$id."'";
	echo $sqlr;
	 $db->Execute($sqlr);
//	exit();
	$codigo="21"; //el usuario 
		
        $descripcion="pruebax";
     $tutax= $rutax="http://www.granmarkcolombia.com/zapf/core/modulos/despachos/ingresar.tienda.php?idcompra=$idcompra&idcliente=$idcliente&ciudad_origen=$ciudad_origen&ciudad_destino=$ciudad_destino&transporte=$transporte&Cantidad=$Cantidad&direccion=$direccion&dstelefono=$dstelefono&celular=$celular&dsidentificacion=$dsidentificacion&totalvalorguia=$totalvalorguia&nombrecliente=$nombrecliente&rutat=$rutat";
     //   $rutax="http://localhost:8082/wcw/maison/zapf/core/modulos/despachos/ingresar.tienda.php?idcompra=$idcompra&idcliente=$idcliente&ciudad_origen=$ciudad_origen&ciudad_destino=$ciudad_destino&transporte=$transporte&Cantidad=$Cantidad&direccion=$direccion&dstelefono=$dstelefono&celular=$celular&dsidentificacion=$dsidentificacion&totalvalorguia=$totalvalorguia&nombrecliente=$nombrecliente&rutat=$rutat";
       
        $var=file_get_contents($rutax);
		echo  $var;
			   }
	   }
	//exit();
	?>
	<script type="text/javascript">
window.location.href="default.php";
</script>

	