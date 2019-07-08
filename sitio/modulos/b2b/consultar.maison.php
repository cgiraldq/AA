<?

		$ciudadorigen="54001";
		$ciudaddestino="54001";
		$peso="2";
		$valoracion="10000";
		$proceso="1";
		$descripcion="pruebax";
		$rutax="http://www.granmarkcolombia.com/zapf/webservices/wcw/webservices.b2b.php?ciudadorigen=$ciudadorigen&ciudaddestino=$ciudaddestino&peso=$peso&valoracion=$valoracion$proceso=$proceso&descripcion=$descripcion";
		$var=file_get_contents($rutax);
		echo $var;


?>

