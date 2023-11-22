<?php
require 'phplist3-main/public_html/lists/admin/PHPMailer/PHPMailerAutoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userEmail = $_POST['user'];
    $recipientEmail = $_POST['recipient'];
    $imageData = $_POST['image'];

    // Convert base64 data to binary
    $binaryData = base64_decode($imageData);

    // Save the image to a file
    $imagePath = 'report/report_image.png';
    file_put_contents($imagePath, $binaryData);

    // Send email with attachment
    $mail = new PHPMailer;
    $mail->setFrom($userEmail);
    $mail->addAddress($recipientEmail);
    $mail->Subject = 'Weekly Report';
    $mail->Body = 'Please find the weekly report attached.';
    $mail->addAttachment($imagePath, 'report_image.png');

    if (!$mail->send()) {
        echo 'Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Email sent successfully';
    }
} else {
    echo 'Invalid request method';
}
?>
