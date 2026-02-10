<?php
// SMTP Configuration for Inquiry Emails
return [
    // Your Gmail Address (Must be the same as the one generating the App Password)
    'smtp_user' => 'dipalishinde560@gmail.com',

    // Your Gmail App Password (NOT your login password)
    // Generate here: https://myaccount.google.com/apppasswords
    'smtp_pass' => '', 

    // Server Settings (Default for Gmail)
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 465 // Use 465 for SSL (Recommended) or 587 for TLS
];
?>