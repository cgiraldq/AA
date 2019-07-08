
<article class="bloque_texto">
	<article class="bloques_gracias">


<? if ($_REQUEST['msg']==3)  {?>
	<h1><? echo $dstituloPagina;?></h1>
	<? if ($dsimgpaginas<>"")  {?><img src="<? echo $rutaPaginas.$dsimgpaginas?>"><? } ?>
	<p><? echo $dsd2Pagina;?></p>
	<h1>Gracias por enviar su solicitud</h1>
<? if  ($_REQUEST['dsnombre']<>""){?>
	<article class="datos">
		<p>Estos son los datos generales:</p>
		<p>Nombre: <? echo $_REQUEST['dsnombre']?></p>
		<p>Email: <? echo $_REQUEST['dscorreocliente']?></p>
		<p>Tel&eacute;fono: <? echo $_REQUEST['dstelefono']?></p>
	</article>
<? } ?>
	<p class="confirmacion">Uno de nuestros asesores se contactar&aacute; con usted</p>

	<article class="cont_frm_vertical">
	<a href="index.php" class="btn_color"><p>Regresar</p></a>
	</article>

<? } ?>


<? if ($_REQUEST['msg']==1)  {?>
	<h1><? echo $dstituloPagina;?></h1>
	<? if ($dsimgpaginas<>"")  {?><img src="<? echo $rutaPaginas.$dsimgpaginas?>"><? } ?>
	<p><? echo $dsd2Pagina;?></p>
	<h1>Gracias por registrarse en nuestro sitio</h1>
	<article class="datos">
		<p>Sus datos registrados son:</p>
		<table >
			<tr>
				<td>
					<p><? echo reemplazar($_REQUEST['datos']);?></p>	
	<p class="confirmacion">Usted recibir&aacute; un correo electr&oacute;nico con la confirmación de su registro </p>
				</td>
			</tr>
		</table>

	</article>



	<!--article class="cont_frm_vertical">
	<a href="zona.privada.php" class="btn_color"><p>Ingrese a la zona privada</p></a>
	</article-->


<? } ?>


<? if ($_REQUEST['msg']==2)  {?>
	<h1>Recuerde:</h1>
	<? if ($dsimgpaginas<>"")  {?><img src="<? echo $rutaPaginas.$dsimgpaginas?>"><? } ?>
	<p><? echo $dsd2Pagina;?></p>
	<h1>Usted ya se encuentra registrado en nuestro sitio. No es necesario volverlo a hacer</h1>
	<article class="cont_frm_vertical">
	<a href="zona.clientes.php" class="btn_color"><p>Ingrese a la zona privada</p></a>
	</article>


<? } ?>


<? if ($_REQUEST['msg']==4)  {?>
	<h1>Recuerde:</h1>
	<? if ($dsimgpaginas<>"")  {?><img src="<? echo $rutaPaginas.$dsimgpaginas?>"><? } ?>
	<p><? echo $dsd2Pagina;?></p>
	<h1>Su contrase&ntilde;a ha sido enviado al correo registrado</h1>
	<article class="cont_frm_vertical">
	<a href="zona.clientes.php" class="btn_color"><p>Ingrese a la zona privada</p></a>
	</article>


<? } ?>


<? if ($_REQUEST['msg']==5){?>
	<? if ($dsimgpaginas<>"")  {?><img src="<? echo $rutaPaginas.$dsimgpaginas?>"><? } ?>
	<h1>La recomendaci&oacute;n fue enviada al correo electr&oacute;nico deseado </h1>

	<article class="cont_frm_vertical">
	<a href="http://<? echo $_REQUEST['dsrutax']?>" class="btn_color"><p>Regresar</p></a>
	</article>

<? } ?>



<? if ($_REQUEST['registro']==1){?>
	<? if ($dsimgpaginas<>"")  {?><img src="<? echo $rutaPaginas.$dsimgpaginas?>"><? } ?>
	<h3 class="gracias">Gracias, sus datos han sido registrados exitosamente.</h3>
	<article class="cont_frm_vertical">
	<a href="proceso.pago.1.php" class="btn_color"><p>Haga click para finalizar la compra</p></a>
	</article>

<? } ?>

<? if ($_REQUEST['entrar']==1){?>
<article class="cont_frm_horizontal">
	<h3 class="gracias"><a href="proceso.pago.2.php" class="btn_color"><p>Puede continuar para realizar el pago<p></a></h3>
</article>
<? } ?>



	</article>
</article>