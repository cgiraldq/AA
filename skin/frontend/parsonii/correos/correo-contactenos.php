<?php

date_default_timezone_set('America/Bogota');

include_once 'conexion.php';

$link = new Conexion();
$conexion = $link->conectar();

$opcion = isset($_GET['opcion']) ? htmlspecialchars(stripcslashes($_GET['opcion'])) : '0';
$result = "";
$msg = "";

switch ($opcion) {

    case '1': {

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
            $email = isset($_POST['email']) ? $_POST['email'] : "";
						$email_zona = isset($_POST['email_zona']) ? $_POST['email_zona'] : "";
						$zona = isset($_POST['zona']) ? $_POST['zona'] : "";
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : "";
            $mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : "";

            //$email_from = "info@parsoniisolutions.com";
            //$email_to = $email_zona; 
  
            $email_from = $email;
           	$email_to = $email_zona;  
  
            $email_subject = "Mensaje $zona";

            $email_message = "<html><body>";

            $email_message .= "<h3>" . strtoupper(strtr($zona, "áéíóú", "ÁÉÍÓÚ")) . "</h3>";

            $email_message .= "Nombre: $nombre <br>";
            $email_message .= "Email: $email <br>";
						//$email_message .= "Zona: $zona $email_zona<br>";
            $email_message .= "Teléfono: $telefono <br>";
            $email_message .= "Mensaje: $mensaje <br>";

            $email_message .= "</body></html>";

            $headers = "From: " . $email_from . "\r\n" .
                    "Reply-To: " . $email . "\r\n" .
                    "MIME-Version: 1.0\r\n" .
                    "Content-Type: text/html; charset=UTF-8\r\n" .
                    "Date: " . date("r") . "\r\n" .
                    "X-MSMail-Priority: Normal\n" .
                    "X-Mailer: php\n";
  
            $result = "fail";
	
            if (!$conexion) {
              
              $result = "fail";
              $msg = $link->getError();
            }else{
                
            		$sql = "INSERT INTO `contactenos_comercializa`(`zona`, `email_zona`, `nombre`, `email`, `telefono`, `mensaje`)"
                        ."VALUES ('$zona', '$email_zona', '$nombre', '$email', '$telefono', '$mensaje')";
                $rs = $conexion->query($sql);

                /*if ($rs > 0) {
                    $result = "all";
                    $msg = "El registro de la persona se realizó con éxito.";
                } else {

                    $result = "fail";
                    $msg = "El registro no se pudo realizar por una falla en la solicitud.";
                }*/ 

                if (mail($email_to, $email_subject, $email_message, $headers)) {
                    $result = "all";
                    $msg = "Mensaje enviado, pronto nos pondremos en contacto.";
                } else {
                    $result = "fail";
                    $msg = "No se pudo enviar el mensaje.";
                } 
            }
      

            echo json_encode(array('res' => $result, 'msg' => $msg));
            break;
        }
		
		case '2': {
			
			$imagen="https://www.adrianaarango.com/skin/frontend/parsonii/default/images/logo-encasa.png";
			
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
			$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : "";
            $email_zona = isset($_POST['email_zona']) ? $_POST['email_zona'] : "";
			$zona = isset($_POST['zona']) ? $_POST['zona'] : "";
            $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : "";
            $celular = isset($_POST['celular']) ? $_POST['celular'] : "";
			$email = isset($_POST['email']) ? $_POST['email'] : "";
			$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : "";
			$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : "";
			$barrio = isset($_POST['barrio']) ? $_POST['barrio'] : "";
			$dia = isset($_POST['day']) ? $_POST['day'] : "";
			$mes = isset($_POST['month']) ? $_POST['month'] : "";
			$ano = isset($_POST['year']) ? $_POST['year'] : "";
			$ref_personal_nom_apell = isset($_POST['ref_personal_nom_apell']) ? $_POST['ref_personal_nom_apell'] : "";
			$ref_personal_cel = isset($_POST['ref_personal_cel']) ? $_POST['ref_personal_cel'] : "";
			$ref_parentesco = isset($_POST['ref_parentesco']) ? $_POST['ref_parentesco'] : "";
			$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : "";
			$categoria = implode(",", $categoria);
			$talla = isset($_POST['talla']) ? $_POST['talla'] : "";
			$talla = implode(",", $talla);
			$colores = isset($_POST['colores']) ? $_POST['colores'] : "";
			$dormir = isset($_POST['dormir']) ? $_POST['dormir'] : "";
			$dormir = implode(",", $dormir);
			$intima = isset($_POST['intima']) ? $_POST['intima'] : "";
			$intima = implode(",", $intima);
			$intima2 = isset($_POST['intima2']) ? $_POST['intima2'] : "";
			$intima2 = implode(",", $intima2);
			$ref = isset($_POST['ref']) ? $_POST['ref'] : "";
			$empaque = isset($_POST['empaque']) ? $_POST['empaque'] : "";
			$fecha_motivo = isset($_POST['fecha_motivo']) ? $_POST['fecha_motivo'] : "";
			
			
			
			 $email_from = $email_zona;
			 $email_to = $email; 

           
            $email_subject = "Mensaje $zona";

            $email_message = "<html><body style='background: #f6f6f6;'>";

            $email_message .= "<center><table border='0' width='60%' style='background: #fff;'><tr><td colspan='4'><center><img src='".$imagen."'></center></td></tr>";
			$email_message .= "<tr><td colspan='4'>&nbsp;<br><br></td></tr>";
			$email_message .= '<tr><h1 style="font-size:22px;font-weight:normal;line-height:22px;margin:0 0 11px 0">Estimado/a, '.$nombre.' '.$apellido.',</h1></td></tr>';
			$email_message .= "<tr><td colspan='4'>&nbsp;<br><br></td></tr>";
			$email_message .= '<tr><td colspan="4">Muy pronto una de nuestras asesoras se contactará contigo para coordinar la entrega de la caja de ADRIANA ARANGO EN CASA.<br>
Te recordamos que el envió de esta no tiene ningún costo en la ciudad de Medellin, y que después de recibida tienes 2 días hábiles para probarte las prendas y escoger con que diseños te quieres quedar; 
después de esto enviaremos a nuestro personal a recogerla y nos pondremos en contacto contigo para informarte el valor a pagar, el cual será en método no presencial a través de nuestra pasarela de pagos o transferencia bancaria.
Cualquier duda durante el proceso puedes escribirnos al correo info@adrianaarango.com o al WhatsApp 318 3353761.</td></tr>';
			$email_message .= "<tr><td colspan='4'>&nbsp;<br><br></td></tr>";
			$email_message .= "<tr><td colspan='4'>&nbsp;<br><br></td></tr>";
            $email_message .= "</table></center></body></html>";

            $headers = "From: " . $email_from . "\r\n" .
                    "Reply-To: " . $email . "\r\n" .
                    "MIME-Version: 1.0\r\n" .
                    "Content-Type: text/html; charset=UTF-8\r\n" .
                    "Date: " . date("r") . "\r\n" .
                    "X-MSMail-Priority: Normal\n" .
                    "X-Mailer: php\n";
			
			mail($email_to, $email_subject, $email_message, $headers);
			


            $email_from = $email_zona;
            $email_to = $email_zona; 
			  //$email_to = "Luisaalvarez86@Gmail.com";
  
           /* $email_from = $email;
           	$email_to = $email_zona;  */
  
            $email_subject = "Mensaje $zona";

            $email_message = "<html><body>";

            $email_message .= "<center><table border='0' width='60%'><tr><td colspan='4'><center><img src='".$imagen."' width='165' height='50'></center></td></tr>";
			$email_message .= "<tr><td colspan='4'>&nbsp;<br><br></td></tr>";
            $email_message .= "<tr><td colspan='2'><b>Nombres y Apellidos:</b> $nombre $apellido</td><td colspan='2'><b>Fecha de Nacimiento:</b>  $dia/$mes/$ano </td></tr>";
            $email_message .= "<tr><td><b>Cedula:</td><td>$cedula</td><td>Celular:</td><td>$celular</td></tr>";
			$email_message .= "<tr><td><b>Email:</td><td>$email</td><td>Ciudad:</td><td>$ciudad</td></tr>";
			$email_message .= "<tr><td><b>Dirección de envió:</b></td><td>$direccion</td><td><b>Barrio:</b></td><td>$barrio</td></tr>";
			$email_message .= "<tr><td colspan='4'>&nbsp;<br><br></td></tr>";
			$email_message .= "<tr><td colspan='4'><b><center>Referencia Personal<center><b></td></tr>
			<tr><td colspan='3'><b>Nombre:</b>  $ref_personal_nom_apell</b></td><td><b>parentesco:</b> $ref_parentesco -- <b>Celular:</b>  $ref_personal_cel </td></tr>";
			$email_message .= "<tr><td colspan='4'>&nbsp;<br><br></td></tr>";
			$email_message .= "<tr><td><b>Categorias de preferencia:</b></td><td colspan='3'>$categoria</td></tr>";
			$email_message .= "<tr><td><b>Tallas:</b></td><td colspan='3'>$talla</td></tr>";
			$email_message .= "<tr><td><b>Colores Favoritos:</b></td><td colspan='3'>$colores</td></tr>";
			$email_message .= "<tr><td><b>Ropa de Dormir Favorita:</b></td><td colspan='3'>$dormir</td></tr>";
			$email_message .= "<tr><td><b>Prendas Intimas Favoritas:</b></td><td colspan='3'>$intima</td></tr>";
			$email_message .= "<tr><td><b>Prendas Deportivas Favoritas:</b></td><td colspan='3'>$intima2</td></tr>";
			$email_message .= "<tr><td><b>Referencias:</b></td><td colspan='3'>$ref</td></tr>";
			$email_message .= "<tr><td><b>Empaque:</b></td><td colspan='3'>$empaque</td></tr>";
			$email_message .= "<tr><td><b>Fecha Especial y Motivo:</b></td><td colspan='3'>$fecha_motivo</td></tr>";
						//$email_message .= "Zona: $zona $email_zona<br>";
            /*$email_message .= "Teléfono: $telefono <br>";
            $email_message .= "Mensaje: $mensaje <br>";*/

            $email_message .= "</table></center></body></html>";
//echo $email_message;die;
            $headers = "From: " . $email_from . "\r\n" .
                    "Reply-To: " . $email . "\r\n" .
                    "MIME-Version: 1.0\r\n" .
                    "Content-Type: text/html; charset=UTF-8\r\n" .
                    "Date: " . date("r") . "\r\n" .
                    "X-MSMail-Priority: Normal\n" .
                    "X-Mailer: php\n";
  
            $result = "fail";
	
            if (!$conexion) {
              
              $result = "fail";
              $msg = $link->getError();
            }else{
                
            		/*$sql = "INSERT INTO `contactenos_comercializa`(`zona`, `email_zona`, `nombre`, `email`, `telefono`, `mensaje`)"
                        ."VALUES ('$zona', '$email_zona', '$nombre', '$email', '$telefono', '$mensaje')";
                $rs = $conexion->query($sql);*/

                /*if ($rs > 0) {
                    $result = "all";
                    $msg = "El registro de la persona se realizó con éxito.";
                } else {

                    $result = "fail";
                    $msg = "El registro no se pudo realizar por una falla en la solicitud.";
                }*/ 

                if (mail($email_to, $email_subject, $email_message, $headers)) {
                    $result = "all";
                    $msg = "Mensaje enviado, pronto nos pondremos en contacto.";
                } else {
                    $result = "fail";
                    $msg = "No se pudo enviar el mensaje.";
                } 
            }
      

            echo json_encode(array('res' => $result, 'msg' => $msg));
            break;
        }
}