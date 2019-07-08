<?	if ($mensajes<>"") { ?>


<?	if ($error=="0") { ?>


	<table  border="0" cellpadding="2" cellspacing="1" class="msm_verde">
	     <tr>
		  <td align="center">
		  	<img src="<? echo $rutxx;?>../../img_modulos/modulos/guardar.png">
		  	<h3>&nbsp;Resultado de la operaci&oacute;n: <? echo $mensajes?></h3>
		  </td>
		</tr>
	</table>
<? } ?>

<?	if ($error=="1") { ?>

	<table  border="0" cellpadding="2" cellspacing="1" class="msm_rojo">
	     <tr>
		  <td align="center">
		  	<img src="<? echo $rutxx;?>../../img_modulos/modulos/error.png">
		  	<h3>&nbsp;Resultado de la operaci&oacute;n: <? echo $mensajes?></h3>
		  </td>
		</tr>
	</table>

<? } ?>


<?	if ($h>0) { ?>


	<table  border="0" cellpadding="2" cellspacing="1" class="msm_verde">
	     <tr>
		  <td align="center">
		  	<img src="<? echo $rutxx;?>../../img_modulos/modulos/guardar.png">
		  	<h3>&nbsp;Resultado de la operaci&oacute;n: <? echo $mensajes?></h3>
		  </td>
		</tr>
	</table>
<? } ?>


<? } ?>