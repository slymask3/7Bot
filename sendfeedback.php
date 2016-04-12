<?php
$page = 'about';
$pagename = 'Feedback';
require_once 'header.php';

require 'phpmailer/PHPMailerAutoload.php';

echo '<div class="about">';

if(!empty($_POST['question'])) {
    $mail = new PHPMailer;

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.gandi.net';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'help@7bot.lol';                 // SMTP username
    $mail->Password = $mailpassword;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('help@7bot.lol', '7 Bot Help');
    $mail->addAddress('help@7bot.lol', '7 Bot');     // Add a recipient

    if (!empty($_POST['email'])) {
        $mail->addAddress($_POST['email'], $_POST['name']);
    }
//$mail->addAddress($POS);               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = '7 Bot Feedback - ' . $_POST['topic'];
    $mail->Body = 'This is a confirmation email that we have recieved your message:<br><br><b>Topic:</b> ' . $_POST['topic'] . '<br><b>Message:</b><br>' . $_POST['question'];
    $mail->AltBody = 'This is a confirmation email that we have recieved your message:

                  Topic: ' . $_POST['topic'] .
        'Question:' .
        $_POST['question'];

    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Your message has been sent!<br><br><b>Topic:</b> ' . $_POST['topic'] . '<br><b>Message:</b><br>' . $_POST['question'];
    }
} else {
    echo 'No message found.';
}

echo '</div>';

?>
<?php require_once 'footer.php'; ?>