<?php
declare(strict_types=1);

namespace TrainingApp\App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Mailer
{
    private $debugLog = [];

    // 1. Central SMTP Config
    private function get_smtp_config(): array
    {
        return [
            'host'     => 'smtp.hostinger.com',
            'port'     => 465,
            'username' => 'support@whitecode.biz',
            'password' => 'Wcodebiz@23#',
            'secure'   => PHPMailer::ENCRYPTION_SMTPS,
            'from_email' => 'support@whitecode.biz',
            'from_name'  => 'Consynex Inquiry System'
        ];
    }

    // 2. Generic Send Function
    public function sendEmailGeneric(string $to, string $subject, string $message, ?string $replyTo = null, ?string $replyToName = null): bool
    {
        $config = $this->get_smtp_config();
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = $config['host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $config['username'];
            $mail->Password   = $config['password'];
            $mail->SMTPSecure = $config['secure'];
            $mail->Port       = $config['port'];

            // Recipients
            $mail->setFrom($config['from_email'], $config['from_name']);
            $mail->addAddress($to);

            // Optional Reply-To
            if ($replyTo && filter_var($replyTo, FILTER_VALIDATE_EMAIL)) {
                $mail->addReplyTo($replyTo, $replyToName ?? '');
            }

            // Content
            $mail->isHTML(false); // Default to plain text for inquiries, can be changed if HTML passed
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            return true;

        } catch (Exception $e) {
            $this->log("Email sending failed: " . $mail->ErrorInfo);
            return false;
        }
    }

    // 3. Specific Wrapper for Inquiries
    public function sendInquiry(array $data): bool
    {
        $adminEmail = 'dipalishinde560@gmail.com';
        
        $type = $data['inquiry_type'] ?? 'Unknown';
        $reference = $data['reference_name'] ?? 'N/A';
        $name = $data['name'] ?? 'N/A';
        $mobile = $data['mobile'] ?? 'N/A';
        $email = $data['email'] ?? '';
        $message = $data['message'] ?? '';

        $subject = "New Inquiry Received - $type";
        
        $body = "New Inquiry Received\n";
        $body .= "--------------------\n";
        $body .= "Type: $type\n";
        $body .= "Interest: $reference\n\n";
        $body .= "Name: $name\n";
        $body .= "Mobile: $mobile\n";
        $body .= "Email: $email\n";
        $body .= "Selected Service / Course: $reference\n";
        $body .= "Message: $message\n\n";
        $body .= "Date: " . date('Y-m-d H:i:s') . "\n";

        // Reuse generic function
        return $this->sendEmailGeneric($adminEmail, $subject, $body, $email, $name);
    }

    // 4. Specific Wrapper for Service Requests
    public function sendServiceRequest(array $data): bool
    {
        $adminEmail = 'dipalishinde560@gmail.com';
        
        $serviceName = $data['service_name'] ?? 'N/A';
        $name = $data['name'] ?? 'N/A';
        $mobile = $data['mobile'] ?? 'N/A';
        $email = $data['email'] ?? '';
        $message = $data['message'] ?? '';

        $subject = "New Service Request - $serviceName";
        
        $body = "New Service Request Received\n";
        $body .= "----------------------------\n";
        $body .= "Service: $serviceName\n\n";
        $body .= "Name: $name\n";
        $body .= "Mobile: $mobile\n";
        $body .= "Email: $email\n";
        $body .= "Message: $message\n\n";
        $body .= "Date: " . date('Y-m-d H:i:s') . "\n";

        // Reuse generic function
        return $this->sendEmailGeneric($adminEmail, $subject, $body, $email, $name);
    }

    private function log($message)
    {
        $this->debugLog[] = $message;
        // error_log($message); // Optional: log to PHP error log
    }

    public function getLogs()
    {
        return implode("\n", $this->debugLog);
    }
}
