<?php
    $de = $_POST["de_txt"];
    $para = $_POST["para_txt"];
    $asunto = $_POST["asunto_txt"];
    $mensaje = $_POST["mensaje_txa"];
    $cabeceras = "MIME-Version: 1.0\r\n";
    $cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $cabeceras .= "From: $de \r\n";

    $archivo = $_FILES["archivo_fls"]["tmp_name"];
    $destino = $_FILES["archivo_fls"]["name"];

    if(move_uploaded_file($archivo,$destino)){
        //incluyo la clase phpmailer
        include_once("class.phpmailer.php");
        include_once("class.smtp.php");
        
        $mail = new PHPMailer(); //creo un objeto de tipo PHPMailer
        $mail->IsSMTP(); //protocolo SMTP
        $mail->SMTPAuth=true; //autentificacion en el SMTP
        $mail->SMTPSecure="ssl"; // SSL security socket layer
        $mail->Host="smtp.gmail.com";//servidor de SMTP de gmail
        $mail->Port=465;//puerto seguro del servidor SMTP de gmail
        $mail->From = $de;//remitente del correo
        $mail->AddAddress($para); //Destinatario
        $mail->Username = "mggmonje@gmail.com";//Aquí hay que poder tu correo de gmail
        $mail->Password = "Beholder@32";//Aqui hay que poner tu contraseña de gmail
        $mail->Subject = $asunto; //Asunto del correo
        $mail->Body = $mensaje;//Contenido del correo
        $mail->WordWrap = 50; //Numero de columnas
        $mail->MsgHTML($mensaje);//Se indica que el cuerpo del correo tendrá formato html
        $mail->AddAttachment($destino); //accedemos al archivo que se subió al servidor y lo adjuntamos

        if($mail->Send()){ //enviamos el correo por PHPMailer
            $respuesta = "El mensaje ha sido enviado con la clase PHPMailer y tu cuenta de gmail";
        }else{
            $respuesta = "El mensaje no se pudo enviar con la clase PHPMailer y tu cuenta de gmail";
            $respuesta .= " Error: ".$mail->ErrorInfo;
        }

    }else{
        $respuesta = "Ha ocurrido un error al subir el archivo adjunto";
    }

    header("Location: formulario-phpmailer.php?respuesta=$respuesta");

?>