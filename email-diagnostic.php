<?php

// Test email configuration
echo "=== Email Configuration Diagnostic ===\n\n";

// Load Laravel environment
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Check .env settings
echo "1. MAIL Configuration from .env:\n";
echo "   MAIL_MAILER: " . env('MAIL_MAILER') . "\n";
echo "   MAIL_HOST: " . env('MAIL_HOST') . "\n";
echo "   MAIL_PORT: " . env('MAIL_PORT') . "\n";
echo "   MAIL_USERNAME: " . env('MAIL_USERNAME') . "\n";
echo "   MAIL_FROM_ADDRESS: " . env('MAIL_FROM_ADDRESS') . "\n\n";

// Check if email view exists
echo "2. Email View Files:\n";
$emailViewPath = __DIR__ . '/resources/views/emails/new-request.txt';
if (file_exists($emailViewPath)) {
    echo "   ✓ new-request.txt exists\n";
    echo "   Size: " . filesize($emailViewPath) . " bytes\n";
} else {
    echo "   ✗ new-request.txt NOT found!\n";
}
echo "\n";

// Check if Mailable class exists
echo "3. Mailable Class:\n";
$mailableClass = 'App\\Mail\\NewRequestSubmitted';
if (class_exists($mailableClass)) {
    echo "   ✓ NewRequestSubmitted class exists\n";
    $reflection = new ReflectionClass($mailableClass);
    echo "   File: " . $reflection->getFileName() . "\n";
} else {
    echo "   ✗ NewRequestSubmitted class NOT found!\n";
}
echo "\n";

// Check Mail facade
echo "4. Mail Facade:\n";
try {
    $mailer = app('mail.manager');
    echo "   ✓ Mail manager available\n";
    echo "   Default mailer: " . $mailer->getDefaultDriver() . "\n";
} catch (\Exception $e) {
    echo "   ✗ Error: " . $e->getMessage() . "\n";
}
echo "\n";

// Test send simple email
echo "5. Attempting test email send:\n";
try {
    $testEmail = 'plnintership@gmail.com';
    
    // Create a simple test mailable
    \Illuminate\Support\Facades\Mail::raw('Test email from Laravel', function($message) use ($testEmail) {
        $message->to($testEmail)
                ->subject('Test Email from Request System')
                ->from('admin@vale.example.com');
    });
    
    echo "   ✓ Test email queued/sent successfully!\n";
    echo "   Sent to: $testEmail\n";
} catch (\Exception $e) {
    echo "   ✗ Error: " . $e->getMessage() . "\n";
    echo "   File: " . $e->getFile() . "\n";
    echo "   Line: " . $e->getLine() . "\n";
}
echo "\n";

echo "=== End Diagnostic ===\n";
