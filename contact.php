<?php
// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Form fields
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';
    
    // Basic validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email format']);
        exit;
    }
    
    // If you have Composer installed, use autoloader
    // require 'vendor/autoload.php';
    
    // Or include the PHPMailer files manually
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->SMTPDebug = 0;                      // Enable verbose debug output (set to 0 in production)
        $mail->isSMTP();                           // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';      // Set the SMTP server to send through (change to your SMTP server)
        $mail->SMTPAuth   = true;                  // Enable SMTP authentication
        $mail->Username   = 'kmadhurendra59@gmail.com'; // SMTP username (change to your email)
        $mail->Password   = 'olepdejaapjaswop';       // SMTP password (change to your email password or app password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port       = 587;                   // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS`
        
        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('kmadhurendra59@gmail.com'); // Add a recipient (your email)
        $mail->addReplyTo($email, $name);
        
        // Content
        $mail->isHTML(true);                       // Set email format to HTML
        $mail->Subject = "Portfolio Contact: $subject";
        
        // Email body
        $mail->Body = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; }
                    .container { padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
                    h2 { color: #333; }
                    .footer { margin-top: 20px; font-size: 12px; color: #777; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h2>New Contact Form Submission</h2>
                    <p><strong>Name:</strong> {$name}</p>
                    <p><strong>Email:</strong> {$email}</p>
                    <p><strong>Subject:</strong> {$subject}</p>
                    <p><strong>Message:</strong></p>
                    <p>{$message}</p>
                    <div class='footer'>
                        This email was sent from your portfolio contact form.
                    </div>
                </div>
            </body>
            </html>
        ";
        
        $mail->AltBody = "Name: $name\nEmail: $email\nSubject: $subject\nMessage: $message";
        
        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Message has been sent']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
    }
    
    exit;
}

// If not a POST request, redirect to the homepage
header('Location: index.html');
exit; 