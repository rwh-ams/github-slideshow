<?php
require("./sendgrid-php/sendgrid-php.php");
$from = new SendGrid\Email(null, "bluevsgreen@example.com");
$sub = isset( $_REQUEST['subject'] ) ? $_REQUEST['subject'] : 'unknown2' ;
$data =  isset( $_REQUEST['data'] ) ? $_REQUEST['data'] : 'unknown';
$datetxt = date('Y-m-d-H-s');
$subject =  "bluevsgreen" . "-" . $sub . '-' . $datetxt;
$to = new SendGrid\Email(null, "bluegreenspace2017@gmail.com");
$content = new SendGrid\Content("text/plain", $data);
$mail = new SendGrid\Mail($from, $subject, $to, $content);
$att1 = new SendGrid\Attachment();
$att1->setContent( base64_encode($data) );
$att1->setType("text/plain");
$att1->setFilename($subject . ".txt");
$att1->setDisposition("attachment");
$mail->addAttachment( $att1 );
$apiKey = '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';
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);
echo $response->statusCode();
echo $response->headers();
echo $response->body();
?>