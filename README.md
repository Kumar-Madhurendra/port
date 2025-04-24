# Kumar Madhurendra Portfolio

This is a personal portfolio website for Kumar Madhurendra.

## Contact Form Setup

The contact form on this website uses PHPMailer to send emails via SMTP. Follow the steps below to set it up:

### 1. Install PHPMailer

You have two options:

#### Option 1: Using Composer (Recommended)

If you have Composer installed:

```bash
composer require phpmailer/phpmailer
```

Then, modify the `contact.php` file to use the autoloader by uncommenting:
```php
require 'vendor/autoload.php';
```

And comment out the manual includes:
```php
// require 'PHPMailer/src/Exception.php';
// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/SMTP.php';
```

#### Option 2: Manual Download

1. Download PHPMailer from GitHub: https://github.com/PHPMailer/PHPMailer/releases
2. Extract the files and place the `src` directory in the `PHPMailer` folder of your project
3. Make sure the following files exist:
   - `PHPMailer/src/Exception.php`
   - `PHPMailer/src/PHPMailer.php`
   - `PHPMailer/src/SMTP.php`

### 2. Configure SMTP Settings

Edit the `contact.php` file and update the following lines with your email credentials:

```php
$mail->Host       = 'smtp.gmail.com';      // Use your SMTP provider (Gmail example)
$mail->Username   = 'your_email@gmail.com'; // Your email
$mail->Password   = 'your_password';       // Your password or app password
```

#### Important Note for Gmail Users:

If you're using Gmail, you'll need to:
1. Enable 2-step verification on your Google account
2. Generate an App Password: Google Account > Security > App Passwords
3. Use that App Password instead of your regular password

#### For Other Email Providers:

Adjust the SMTP settings according to your provider:
- Yahoo: `smtp.mail.yahoo.com`, Port: 465, Encryption: SSL
- Outlook/Hotmail: `smtp.office365.com`, Port: 587, Encryption: STARTTLS
- Zoho: `smtp.zoho.com`, Port: 587, Encryption: STARTTLS

### 3. Testing

After setting up, test the contact form by submitting it. Check both successful submissions and error handling.

## Security Considerations

- Never commit your email credentials to Git repositories
- Consider using environment variables for sensitive information
- Implement rate limiting to prevent form spam
- Add CAPTCHA protection if needed

## Troubleshooting

- If emails aren't being sent, check your SMTP credentials
- Ensure your email provider allows SMTP access
- Check server logs for PHP errors
- Verify that PHPMailer is properly installed and accessible 