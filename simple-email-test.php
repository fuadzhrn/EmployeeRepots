<?php
// Simple email test - no Laravel overhead

require __DIR__ . '/vendor/autoload.php';

echo "=== Simple Gmail SMTP Test ===\n\n";

// Load env vars
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

echo "1. Config Check:\n";
echo "   HOST: " . getenv('MAIL_HOST') . "\n";
echo "   PORT: " . getenv('MAIL_PORT') . "\n";
echo "   USERNAME: " . getenv('MAIL_USERNAME') . "\n";
echo "   PASSWORD: " . (getenv('MAIL_PASSWORD') ? '***' . substr(getenv('MAIL_PASSWORD'), -4) : 'NOT SET') . "\n";
echo "   FROM: " . getenv('MAIL_FROM_ADDRESS') . "\n\n";

// Test SMTP connection
echo "2. Testing SMTP Connection:\n";

try {
    $host = getenv('MAIL_HOST');
    $port = getenv('MAIL_PORT');
    
    echo "   Connecting to $host:$port...\n";
    
    $socket = @fsockopen($host, $port, $errno, $errstr, 5);
    
    if ($socket) {
        echo "   ✓ Connection successful!\n";
        fclose($socket);
    } else {
        echo "   ✗ Connection failed: $errstr ($errno)\n";
    }
} catch (Exception $e) {
    echo "   ✗ Error: " . $e->getMessage() . "\n";
}

echo "\n3. Next Step:\n";
echo "   Go to http://localhost and submit a request.\n";
echo "   Then check Laravel logs: storage/logs/laravel.log\n";
echo "   Look for 'Email notification' messages.\n\n";

echo "=== End Test ===\n";
