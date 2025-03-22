<?php

// Replace with your real receiving email address
$receiving_email_address = 'dev.sanajitjana@gmail.com';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Sanitize and validate inputs
  $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
  $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
  $subject = filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING);
  $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

  // Validate email format
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format";
    exit;
  }

  // Email content
  $email_content = "From: $name\n";
  $email_content .= "Email: $email\n\n";
  $email_content .= "Message:\n$message\n";

  $headers = "From: $name <$email>" . "\r\n";
  $headers .= "Reply-To: $email" . "\r\n";
  $headers .= "Content-Type: text/plain; charset=UTF-8" . "\r\n";

  // Send email
  if (mail($receiving_email_address, $subject, $email_content, $headers)) {
    echo "Your message has been sent. Thank you!";
  } else {
    echo "Oops! Something went wrong, please try again.";
  }
} else {
  echo "Invalid request method.";
}
