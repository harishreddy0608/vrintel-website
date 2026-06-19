<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request");
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $email === '' || $message === '') {
    echo "<script>
        alert('All fields are required.');
        window.history.back();
    </script>";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>
        alert('Invalid email address.');
        window.history.back();
    </script>";
    exit;
}

$to = "gamingtron06@gmail.com";
$subject = "New Contact Form Submission - Vrintel Analytics";

$email_body = "You received a new contact form submission:\n\n";
$email_body .= "Name: " . $name . "\n";
$email_body .= "Email: " . $email . "\n\n";
$email_body .= "Project Details:\n" . $message . "\n";

$headers = "From: Vrintel Analytics <no-reply@vrintelanalytics.com>\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$mailSent = mail($to, $subject, $email_body, $headers);

if ($mailSent) {
    echo "<script>
        alert('Thank you! Your message has been sent successfully.');
        window.location.href = 'index.html';
    </script>";
} else {
    echo "<script>
        alert('Failed to send email. Please try again later.');
        window.history.back();
    </script>";
}

?>