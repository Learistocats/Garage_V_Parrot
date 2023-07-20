<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    $to = "info@example.com"; 

    $email_subject = "Contact Form Submission: " . $subject;

    $email_body = "Email: $email\n";
    $email_body .= "Phone Number: $phone\n";
    $email_body .= "Subject: $subject\n";
    $email_body .= "Message:\n$message";

    $headers = "From: $email";
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Thank you for your message. We will get back to you soon!";
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
} else {
    header("Location: contact_form.html");
    exit;
}
?>
