<?php
declare(strict_types=1);

namespace TrainingApp\App;

class SimpleSMTP
{
    private $host;
    private $port;
    private $username;
    private $password;
    private $socket;
    private $log = [];
    private $timeout = 30;

    public function __construct(string $host, int $port, string $username, string $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
    }

    private function log($msg)
    {
        $this->log[] = "[" . date('H:i:s') . "] " . $msg;
    }

    public function getLog()
    {
        return implode("\n", $this->log);
    }

    public function send(string $to, string $subject, string $body, string $fromName = 'Consynex'): bool
    {
        try {
            // Auto-detect SSL/TLS based on port
            $protocol = '';
            if ($this->port == 465) {
                $protocol = 'ssl://';
            }

            $this->log("Connecting to {$protocol}{$this->host}:{$this->port}...");
            
            $this->socket = fsockopen($protocol . $this->host, $this->port, $errno, $errstr, $this->timeout);
            
            if (!$this->socket) {
                $this->log("Connection failed: $errno $errstr");
                return false;
            }

            // Read initial greeting
            if (!$this->expect(220, 'Greeting')) return false;

            // Hello
            $this->cmd('EHLO ' . gethostname());
            if (!$this->expect(250, 'EHLO')) return false;

            // STARTTLS for port 587
            if ($this->port == 587) {
                $this->cmd('STARTTLS');
                if (!$this->expect(220, 'STARTTLS')) return false;
                
                // Enable crypto
                if (!stream_socket_enable_crypto($this->socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
                     $this->log("Failed to enable crypto");
                     return false;
                }
                
                // Resend EHLO after STARTTLS
                $this->cmd('EHLO ' . gethostname());
                if (!$this->expect(250, 'EHLO after STARTTLS')) return false;
            }
            
            // Auth
            if ($this->username && $this->password) {
                $this->cmd('AUTH LOGIN');
                if (!$this->expect(334, 'AUTH LOGIN')) return false;
                
                $this->cmd(base64_encode($this->username));
                if (!$this->expect(334, 'Username')) return false;
                
                $this->cmd(base64_encode($this->password));
                if (!$this->expect(235, 'Password')) return false;
            }

            // Mail
            $this->cmd("MAIL FROM: <{$this->username}>");
            if (!$this->expect(250, 'MAIL FROM')) return false;

            $this->cmd("RCPT TO: <$to>");
            if (!$this->expect([250, 251], 'RCPT TO')) return false;

            $this->cmd('DATA');
            if (!$this->expect(354, 'DATA')) return false;
            
            // Headers
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
            $headers .= "Date: " . date('r') . "\r\n";
            $headers .= "From: $fromName <{$this->username}>\r\n";
            $headers .= "To: $to\r\n";
            $headers .= "Subject: =?UTF-8?B?" . base64_encode($subject) . "?=\r\n";
            $headers .= "X-Mailer: SimpleSMTP/1.0\r\n";
            
            $this->cmd($headers . "\r\n" . $body . "\r\n.");
            if (!$this->expect(250, 'Message Body')) return false;

            $this->cmd('QUIT');
            
            fclose($this->socket);
            return true;
        } catch (\Exception $e) {
            $this->log("Error: " . $e->getMessage());
            if ($this->socket) fclose($this->socket);
            return false;
        }
    }

    private function cmd($cmd)
    {
        fputs($this->socket, $cmd . "\r\n");
        // Don't log password
        if (base64_decode($cmd, true) === $this->password) {
            $this->log("C: [PASSWORD HIDDEN]");
        } else {
            $this->log("C: $cmd");
        }
    }

    private function expect($code, $stage)
    {
        $response = '';
        while ($str = fgets($this->socket, 515)) {
            $response .= $str;
            if (substr($str, 3, 1) == ' ') break;
        }
        $this->log("S: " . trim($response));
        
        $received = (int)substr($response, 0, 3);
        $expected = is_array($code) ? $code : [$code];
        
        if (!in_array($received, $expected)) {
            $this->log("Error at $stage: Expected " . implode('/', $expected) . ", got $received");
            return false;
        }
        return true;
    }
}
?>