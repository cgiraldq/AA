<?

		// JALAR ESTA INFORMACION DESDE EL PERIODICO EL MUNDO
		$rutacarga="http://www.elmundo.com/portal/servicios/webservices/indicadores.php";
		$content=file_get_contents($rutacarga,FALSE,NULL);
		$partir=explode("-",$content);
		$total=count($partir);

			if($total>0){
?>
<article class="barra_estadisticas">
	<h2>INDICADORES :</h2>
	<img src="images/estadistica.jpg">
	<ul>
		<?
					for ($i=1;$i<$total;$i++) {
						$x=explode("|",$partir[$i]);
						//echo $partir[$i]."<br>";
						$dsm=$x[1];
						$dsvalor=$x[2];
						$idestado=$x[3];
						if($idestado==1)$img="subio";
						if($idestado==2)$img="bajo";
						if($idestado==3)$img="estable";
					?>
		<li>
			<p><? echo reemplazar($dsm);?> <? echo $dsvalor?> <img align="absmiddle" src="images/<? echo $img?>.png"/></p>




		</li>

		<?
						} // fin for
					?>

	</ul>
	<p>Esta informaci&oacute;n es gracias a <a href='http://www.elmundo.com' target='_blank' title='Estos indicadores son gracias al periodico El Mundo Medellin'>www.elmundo.com</a></p>
</article>
<?
			}// fin total
		// FIN JALAR LA INFORMACION DESDE EL PERIODICO EL MUNDO
?>





