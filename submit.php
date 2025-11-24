<?php

// Collect form data
$name     = $_POST['name'];
$phone    = $_POST['phone'];
$email    = $_POST['email'];
$date     = $_POST['date'];
$tickets  = $_POST['tickets'];
$message  = $_POST['message'];



$to = "uf-neyyatinkara@elbex.co.in";
$subject = "New Ticket Booking Request";

$body = "
Booking Details

Name: $name
Phone: $phone
Email: $email
Travel Date: $date
Tickets: $tickets
Message: $message
";

$headers = "From: no-reply@yourwebsite.com";

mail($to, $subject, $body, $headers);



$account_sid = "YOUR_TWILIO_SID";
$auth_token  = "YOUR_TWILIO_AUTH_TOKEN";
$twilio_number = "YOUR_TWILIO_PHONE";

$holder_phone = "+918136806456";

$sms_message = "New ticket booking: $name, $phone, Tickets: $tickets, Date: $date";


$url = "https://api.twilio.com/2010-04-01/Accounts/$account_sid/Messages.json";

$data = array(
    'From' => $twilio_number,
    'To' => $holder_phone,
    'Body' => $sms_message
);

$post = http_build_query($data);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "$account_sid:$auth_token");
$response = curl_exec($ch);
curl_close($ch);



echo "<h2>Thank you, your booking has been submitted!</h2>";
echo "<p>We will contact you soon.</p>";

?>
