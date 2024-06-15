<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Set recipient email address
    $to = 'ayushsemwal648@gmail.com'; //<-- Enter your E-Mail address here.

    // Email body
    $body = "From: $name\nEmail: $email\nSubject: $subject\nMessage:\n$message";

    // Email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-type: text/plain; charset=utf-8\r\n";

    // Send email
    if (mail($to, "New Message from Website: $subject", $body, $headers)) {
        // If mail sent successfully, show success message
        echo json_encode(array("status" => "success", "message" => "Thank you! Your message has been sent."));
    } else {
        // If mail failed to send, show error message
        echo json_encode(array("status" => "error", "message" => "Something went wrong. Please try again later."));
    }
} else {
    // If accessed directly, redirect back to the form
    header("Location: /index.html");
    exit();
}
?>
