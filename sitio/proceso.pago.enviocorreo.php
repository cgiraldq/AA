<?
// constructor del correo hacia cf

if($tipoenviocorreo==1){
include_once('PHPMailer_v5.1/class.phpmailer.php');
include("PHPMailer_v5.1/class.smtp.php"); 

$mail=new PHPMailer();
$cuerpo=eregi_replace("[\]",'',$cuerpo);
$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = $correobase; // SMTP username
$mail->Password = $clavebase; // SMTP password
$mail->Port=$dsport;// 

$mail->Host       = $smtpbase; // SMTP server
$mail->From       = $correobase;
}
$mail->FromName   = $autorizado;
     if ($tipotransc=="1") {
      $asunto="Se ha generado una cotizacion numero $idpedido desde  ".$autorizado;
    } else {
      $asunto="Se ha generado un pedido numero $idpedido desde  ".$autorizado;

    }
    // enviar aviso de contactenos a los de la configuracion
    $sql="select dscorreo1,dscorreo2,dscorreo3,dscorreo4,dsnombre from tblempresa where id=$idtienda ";
    //echo $sql;
    $resultb = $db->Execute($sql);
       //$atac="";
       if (!$resultb->EOF) {
           $dscorreobase0=trim($resultb->fields[0]);
           $dscorreobase1=trim($resultb->fields[1]);
           $dscorreobase2=trim($resultb->fields[2]);
           $dscorreobase3=trim($resultb->fields[3]);
           $empresa=trim($resultb->fields[4]);
           

           if($tipoenviocorreo==1){
           if (comprobar_email($dscorreobase0) && $dscorreobase0<>"") $mail->AddAddress($dscorreobase0, $empresa); 
           if (comprobar_email($dscorreobase1) && $dscorreobase1<>"") $mail->AddAddress($dscorreobase1, $empresa); 
           if (comprobar_email($dscorreobase2) && $dscorreobase2<>"") $mail->AddAddress($dscorreobase2, $empresa); 
           if (comprobar_email($dscorreobase3) && $dscorreobase3<>"") $mail->AddAddress($dscorreobase3, $empresa); 
           
           }else{
               if (comprobar_email($dscorreobase0) && $dscorreobase0<>"") mail($dscorreobase0,$asunto,$cuerpo ,$headers); 
               if (comprobar_email($dscorreobase1) && $dscorreobase1<>"") mail($dscorreobase1,$asunto,$cuerpo ,$headers); 
               if (comprobar_email($dscorreobase2) && $dscorreobase2<>"") mail($dscorreobase2,$asunto,$cuerpo ,$headers); 
               if (comprobar_email($dscorreobase3) && $dscorreobase3<>"") mail($dscorreobase3,$asunto,$cuerpo ,$headers); 
           }
       }
       $resultb->Close();
    if($tipoenviocorreo==1){
        $mail->Subject = $asunto;
        $mail->IsHTML(true);
        $mail->MsgHTML($cuerpo);

      if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        //exit();
      } else {
      
      }
    $mail->ClearAddresses();  
    unset($mail);


    }   
// constructor del correo hacia el cliente

     if ($tipotransc=="0") { // envuiar solamente si no es cotizacion

        $asunto="Usted ha realizado un pedido desde  ".$autorizado." y se encuentra en proceso de verificacion";
        if ($dscorreocliente<>""){

          $mail=new PHPMailer();
          $mail->IsSMTP(); // telling the class to use SMTP
          $mail->SMTPAuth = true; // turn on SMTP authentication
          $mail->Username = $correobase; // SMTP username
          $mail->Password = $clavebase; // SMTP password
          $mail->Port=$dsport;// 

          $mail->Host       = $smtpbase; // SMTP server
          $mail->From       = $correobase;
          $mail->FromName   = $autorizado;
          $mail->Subject = $asunto;
          $mail->IsHTML(true);
          $mail->MsgHTML($cuerpo);
      
          $mail->AddAddress($dscorreocliente, $dsnombres." ".$dsapellidos);
           if(!$mail->Send()) {
              echo "Mailer Error: " . $mail->ErrorInfo;
              //exit();
            } else {
            
            }
            $mail->ClearAddresses();  
            unset($mail);


        }
    }
?>
