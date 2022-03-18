<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once ("../../settings/settings_db.php");

function sendEmail()
{
    global $connection;

    //if(isset($_POST['send_message']))
    //{


        $today = date("Y-m-d");

        $nextMonthDate = date("Y-m-d", strtotime("+30 days",time()));

        echo $query = "SELECT * FROM request WHERE date_requested < '$today'";
        $result = mysqli_query($connection, $query);

        $row = mysqli_fetch_array($result);

        $tender_number = "T-". date("Y") ."-" . $row['id'];





        if($result)
        {

            //Load Composer's autoloader
            require ("vendor/autoload.php");

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP(false);                                            //Send using SMTP
                $mail->Host       = '192.168.2.8';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = false;                                   //Enable SMTP authentication
                $mail->Username   = 'jgomez@martechmedical.com';                     //SMTP username
                $mail->Password   = 'joseLuis15!';                               //SMTP password
                $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                $mail->SMTPOptions = array(
                    'ssl'=>array(
                        'verify_peer'=>false,
                        'verify_peer_name'=>false,
                        'allow_self_signed'=>true
                    )
                );

                //Recipients
                $mail->setFrom('mailer@martechmedical.com', 'Mailer');
                $mail->addAddress('jgomez@martechmedical.com', 'JGomez');     //Add a recipient
                //$mail->addAddress('slandis2@martechmedical.com');               //Name is optional
                //$mail->addAddress('avalle@martechmedical.com');
                //$mail->addAddress('jvargas@martechmedical.com');
                //$mail->addAddress('jbrzyski@martechmedical.com');
                $mail->addReplyTo('info@martechmedical.com', 'Information');
                //$mail->addCC('jmorimoto@martechmedical.com');
                //$mail->addBCC('bcc@example.com');


                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Tender Request Late: ' . $tender_number;
                $mail->Body    = "$tender_number is late please finish filling the form";
                $mail->AltBody = "$tender_number is late please finish filling the form";

                $mail->send();
                echo "Mail is sent";
            } catch (Exception $e) {
                echo "Could not send mail";
            }
        }
    //}
}

sendEmail();
