<?php
require_once('vendor/autoload.php');
$mail = new PHPMailer();

$errors = array();  	// array to hold validation errors
$data = array(); 		// array to pass back data
$toemail = ''; // Your Email Address
$toname = ''; // Your Name

// Getting posted data and decoding json
$data = json_decode(file_get_contents('php://input'), true);

/**
 * validate the variables
 */
if (empty($_POST['fullname'])) {
	$errors['fullname'] = 'Name is required.';
} else {
	$fullname = $_POST['fullname'];
}

if (empty($_POST['email'])) {
	$errors['email'] = 'E-mail is required.';
} else {
	$email = $_POST['email'];
}

if (empty($_POST['mobile'])) {
	$errors['mobile'] = 'Mobile is required.';
} else {
	$mobile = $_POST['mobile'];
}

if (empty($_POST['subject'])) {
	$errors['subject'] = 'Subject is required.';
} else {
	$subject = $_POST['subject'];
}

if (empty($_POST['content'])) {
	$errors['content'] = 'Message is required.';
} else {
	$content = $_POST['content'];
}

// return a response ===========================================================

// response if there are errors
if ( ! empty($errors)) {

	// if there are items in our errors array, return those errors
	$data['success'] = false;
	$data['errors']  = $errors;
	$data['message'] = 'Please Check The Form Again.';

}
else {
	$mail->SetFrom( $email , $fullname );
	$mail->AddReplyTo( $email , $fullname );
	$mail->AddAddress( $toemail , $toname );
	$mail->Subject = $subject;

	$fullname = isset($fullname) ? "Name: $fullname<br><br>" : '';
	$email = isset($email) ? "Email: $email<br><br>" : '';
	$mobile = isset($mobile) ? "Phone: $mobile<br><br>" : '';
	$content = isset($content) ? "Message: $content<br><br>" : '';

	$referrer = $_SERVER['HTTP_REFERER'] ? '<br><br><br>This Form was submitted from: ' . $_SERVER['HTTP_REFERER'] : '';

	$body = "$fullname $email $mobile $content $referrer";

	$mail->MsgHTML( $body );
	$sendEmail = $mail->Send();

	if( $sendEmail == true ) {
		$data['success'] = true;
		$data['message'] = 'Thank you for sending e-mail.';
	}
	else {
		echo 'Email <strong>could not</strong> be sent due to some Unexpected Error. Please Try Again later.<br /><br /><strong>Reason:</strong><br />' . $mail->ErrorInfo . '';
	}
		
}
echo json_encode($data);