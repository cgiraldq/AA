<tr>
	<td align="left" colspan="4">
		<strong>RELACIONES.</strong> Asociar campos al informe seleccionado. Los campos seleccionados sirven tambien como filtros:

		<?

		$validar="where idactivo=1 and idtipoformulario=".$_REQUEST['idform']." ";
		include($rutxx."../relaciones/default.php");


		?>
	</td>

</tr>