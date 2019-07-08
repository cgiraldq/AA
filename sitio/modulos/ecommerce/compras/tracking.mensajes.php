<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fern�ndez <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe S�nchez <graficoweb@comprandofacil.com> - Dise�o
  Jos� Fernando Pe�a <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- | 
*/
// mensajes por estados
$sqlx="select dsd,dsd2 from ecommerce_tblestadoscompra where id='$idestado'";
$resultx= $db->Execute($sqlx);
  if (!$resultx->EOF) {
$titulo=$resultx->fields[0];
$txtbase=$resultx->fields[1];
  } // fin si 
$resultx->Close();

/*
if ($idestado==0){
$titulo="Su pedido aun no se ha finalizado ";
$txtbase="
Apreciado Sr(a) -Nombre-
Cordial Saludo,

El presente mensaje es con fin de notificarle que  el pedido con referencia -Idpedido- que usted a comenzado no lo ha finalizado.

";
}elseif ($idestado==1){

$titulo="Su pedido se encuentra en proceso";
$txtbase="
Apreciado Sr(a) -Nombre-
Cordial Saludo,

El presente mensaje es con fin de notificarle que el pedido con referencia -Idpedido- se encuentra en proceso y aun no ha realizado el pago. 

Por favor realicelo por el medio seleccionado para continuar con el proceso.

";
}elseif ($idestado==2){

$titulo="Su pedido ha sido confirmado ";
$txtbase="
Apreciado Sr(a) -Nombre-
Cordial Saludo,

El presente mensaje es con fin de notificarle que el pedido con referencia -Idpedido- ha sido confirmado por el(los) proveedor(es) de los producto(s) que usted solicito. 
";

}elseif ($idestado==3){
$titulo="Su pedido ha sido cancelado o rechazado ";

$txtbase="
Apreciado Sr(a) -Nombre-
Cordial Saludo,

El presente mensaje es con fin de notificarle que el pedido con referencia -Idpedido- se le ha presentado problemas y 
ha sido rechazado.

Gracias por realizar su pedido en nuestra tienda virtual.  

La oferta a la cual usted aplico [COLOCAR ACA EL(LOS) PRODUCTO(S)] no se encuentra ya disponible en el proveedor, 
era una oferta por tiempo limitado y hasta agotar existencias.

** TEXTO EN CASO QUE SEA TARJETA DE CREDITO:

A trav&eacute;s de nuestra plataforma de pagos virtuales hemos tramitado el reintegro de la transacci&oacute;n realizada con su tarjeta XXXX, la cual sera abonada a la misma en un plazo de 5 d&iacute;as h&aacute;biles.
*** 
Para cualquier inquietud puede citar el consecutivo de su proceso de compra [COLOCAR ACA EL CONSECUTIVO] en el asunto de su correo remitiendo la consulta  cuenta servicioalcliente@comprandofacil.com. Tambi&eacute;n puede llamarnos al PBX de la ciudad de Medellin (57) 4 6040458.

Si considera que podemos ayudarle de otra manera puede remitir copia de su correo tambi&eacute;n a soporteweb@comprandofacil.com

Gracias por utilizar nuestros servicios.
";

}elseif ($idestado==4){

$titulo="Su pedido se encuentra en transito hacia nuestra bodega en -origen- ";

$txtbase="
Apreciado Sr(a) -Nombre-
Cordial Saludo,

El presente mensaje es con fin de notificarle el pedido con referencia -Idpedido- se encuentra en transito desde la tienda hacia nuestras bodegas en -origen- .

";

}elseif ($idestado==5){

$titulo="Su pedido se encuentra nuestra bodega  ".$bodega[0];

$txtbase="
Apreciado Sr(a) -Nombre-
Cordial Saludo,

El presente mensaje es con fin de notificarle que hemos recibido en nuestra bodega de ".$bodega[0]." el pedido con referencia -Idpedido-.

";

}elseif ($idestado==6){

$titulo="Su pedido se encuentra en transito desde nuestra bodega en ".$bodega[0]." hacia nuestras bodegas en  ".$bodega[1];

$txtbase="
Apreciado Sr(a) -Nombre-
Cordial Saludo,

El presente mensaje es con fin de notificarle el pedido con referencia -Idpedido- se encuentra en transito desde nuestras bodegas en ".$bodega[0]." hacia ".$bodega[1].".

";




}elseif ($idestado==7){

$titulo="Su pedido se encuentra nuestra bodega ".$bodega[1];

$txtbase="
Apreciado Sr(a) -Nombre-
Cordial Saludo,

El presente mensaje es con fin de notificarle que hemos recibido en nuestra bodega de ".$bodega[1]." el pedido con referencia -Idpedido-.

";


}elseif ($idestado==8){

$titulo="Su pedido se encuentra en transito desde nuestra bodega -destino- hacia la direccion de entrega ";

$txtbase="
Apreciado Sr(a) -Nombre-
Cordial Saludo,

El presente mensaje es con fin de notificarle que el pedido con referencia -Idpedido- se encuentra en transito hacia la direccion de entrega.

";


}elseif ($idestado==9){

$titulo="Su pedido ha sido entregado en la direccion de destino ";

$txtbase="
Apreciado Sr(a) -Nombre-
Cordial Saludo,

El presente mensaje es con fin de notificarle el pedido con referencia -Idpedido- fue entregado en la direccion de destino.

";

}elseif ($idestado==10){

$titulo="Su Mercancia se encuentra en proceso de nacionalizaci&oacute;n ";

$txtbase="
Apreciado Sr(a) -Nombre-
Cordial Saludo,

El presente mensaje es con fin de notificarle el pedido con referencia -Idpedido- se encuentra en proceso de nacionalizaci&oacute;n.

Constituye un compromiso de servicio de ".$autorizado." el ubicar e importar productos novedosos y 
que satisfagan las expectativas de nuestros clientes, labor que realizamos de manera comprometida con el apoyo de 
nuestras oficinas de negocios de los Estados Unidos e Inglaterra y operadores log&iacute;sticos y aduaneros expertos. 

Para completar nuestra gesti&oacute;n de servicio, la cual usted acepto al suscribir el contrato de mandato 
para que por su cuenta y riesgo ".$autorizado." adquiriera los productos elegidos por Usted 
en la orden de servicio precio todo incluido, es necesario cumplir las reglamentaciones y 
procedimientos de nacionalizaci&oacute;n dispuestos por las autoridades aduaneras Colombianas. 

Por razones ajenas a nuestra voluntad la referida autoridad aduanera ha tomado m&aacute;s tiempo del corriente en 
la verificaci&oacute;n de la correcta importaci&oacute;n de los productos elegidos por Usted lo que nos ha impedido cumplir 
con los plazos de entrega propuestos inicialmente al momento de su compra. 

As&iacute; pues, su pedido se encuentra actualmente en aduana en la ciudad de Bogot&aacute; a la espera de culminar el proceso de 
nacionalizaci&oacute;n para proceder con el despacho posterior a la direcci&oacute;n de entrega por Usted se&ntilde;alada, para esta &uacute;ltima 
parte del proceso y con el animo de aminorar retrasos esta prevista la entrega en servicio de correo el mismo d&iacute;a o expreso 
lo que resulte mas &aacute;gil. En su caso no aplica la devoluci&oacute;n o reversi&oacute;n de la transacci&oacute;n puesto que los retrasos en la entrega 
est&aacute;n motivados en fuerza mayor, cual es la actuaci&oacute;n de un tercero, la autoridad aduanera nacional. 

Entendemos la importancia de estas fechas y le agradecemos su confianza, por lo que haremos nuestro mejor esfuerzo en 
cumplir la entrega de su pedido en el menor tiempo posible. 

Cordialmente, 

SERVICIO AL CLIENTE

";

}elseif ($idestado==11){

$titulo=" Nuestros horarios de atencion ";

$txtbase="
Apreciado Sr(a) -Nombre-
Cordial Saludo,

El presente mensaje es con fin de notificarle nuestros horarios de atenci&oacute;n. 

S&aacute;bado 21 de diciembre de 8 am a 1 pm 

Lunes 24 de diciembre de 8 am a 1 pm 

Mi&eacute;rcoles 26 a viernes 28 de diciembre de 8 am a 6 pm 

S&aacute;bado 29 de diciembre de 8 am a 1 pm 

Mi&eacute;rcoles 3 de enero en adelante de 8 am a 6 pm 

Usted tiene un pedido -Idpedido- el cual se encuentra cumpliendo los tr&aacute;mites aduaneros para la legal importaci&oacute;n al pa&iacute;s, 
este tr&aacute;mite est&aacute; sujeto a los cronogramas, tiempos y procedimientos propios de la autoridad aduanera. 

Una vez la mercanc&iacute;a este a disposici&oacute;n de nuestra compa&ntilde;&iacute;a la misma ser&aacute; remitida 
a las direcciones por usted suministradas. 

Cualquier informaci&oacute;n por favor mencione esta comunicaci&oacute;n. 

";

}
// concatenar al txtbase los datos de direccion 
$remate="
Datos de contacto:
Medell&iacute;n - Colombia
Tel&eacute;fono  (574) ---  
Direcci&oacute;n Punto de Atenci&oacute;n y Centro de Experiencia ---- 
";
$txtbase.=$remate;
*/
?>