<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Envio de correo con funcion mail de PHP</title>
        <style>
            body{
                font-family: Roboto, Arial;
            }
            form{
                margin: 1em auto;
                text-align: center;
            }
            span{
                color: #F60;
                font-size: 1.5em;
            }
        </style>
        <script>
            function validarForm(){
                var verificar = true;
                var expRegEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                if(!document.mail_frm.de_txt.value){
                    alert("El campo 'De: ' es requerido");
                    document.mail_frm.de_txt.focus();
                    verificar = false;
                } else if(!expRegEmail.exec(document.mail_frm.de_txt.value)){
                    alert("El campo 'De: ' no es válido");
                    document.mail_frm.de_txt.focus();
                    verificar = false;
                } else if(!document.mail_frm.para_txt.value){
                    alert("El campo 'Para: ' es requerido");
                    document.mail_frm.para_txt.focus();
                    verificar = false;
                } else if(!expRegEmail.exec(document.mail_frm.para_txt.value)){
                    alert("El campo 'Para: ' no es válido");
                    document.mail_frm.para_txt.focus();
                    verificar = false;
                } else if(!document.mail_frm.asunto_txt.value){
                    alert("El campo 'Asunto: ' es requerido");
                    document.mail_frm.asunto_txt.focus();
                    verificar = false;
                } else if(!document.mail_frm.mensaje_txa.value){
                    alert("El campo 'Mensaje: ' es requerido");
                    document.mail_frm.mensaje_txa.focus();
                    verificar = false;
                }

                if(verificar){
                    document.mail_frm.submit();

                }

            }
            window.onload=function(){
                document.mail_frm.enviar_btn.onclick = validarForm;
            }
        </script>
    </head>
    <body>
        <form name="mail_frm" action="http://bextlan.com/alumnos/recursos/curso-PHP/enviar-mail.php" method="POST" enctype="application/x-www-form-urlencoded">
            <label>De: </label>
            <input type="text" name="de_txt" /><br/><br/>
            <label>Para: </label>
            <input type="text" name="para_txt" /><br/><br/>
            <label>Asunto: </label>
            <input type="text" name="asunto_txt" /><br/><br/>
            <label>Mensaje: </label>
            <textarea name="mensaje_txa"></textarea><br/><br/>
            <input type="button" name="enviar_btn" value="Enviar" /><br/>
            <?php
                error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
                if(isset($_GET["respuesta"])){
                    echo("<span>".$_GET["respuesta"]."</span>");
                }
            ?>
        </form>
    </body>
</html>