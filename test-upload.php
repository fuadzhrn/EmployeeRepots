<?php
// Test file upload untuk debugging

// Simulate upload
echo "=== File Upload Test ===\n";

// Test 1: Check if form data would pass validation
$testData = [
    'nama' => 'Test Request',
    'nomor' => '12345',
    'category' => 'data',
    'description' => 'This is a test description for validation',
    'document' => 'test.txt'
];

echo "Test Data: " . json_encode($testData) . "\n\n";

// Test 2: Check allowed extensions
$allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png', 'txt', 'zip'];
$testFile = 'test-document.txt';
$fileExtension = strtolower(pathinfo($testFile, PATHINFO_EXTENSION));

echo "File: $testFile\n";
echo "Extension: $fileExtension\n";
echo "Is Allowed: " . (in_array($fileExtension, $allowedExtensions) ? 'YES' : 'NO') . "\n\n";

// Test 3: Check storage path
$storagePath = 'storage/app/public/documents';
echo "Storage Path: $storagePath\n";
echo "Path Exists: " . (is_dir($storagePath) ? 'YES' : 'NO') . "\n";

if (is_dir($storagePath)) {
    $files = scandir($storagePath);
    echo "Files in directory: " . implode(', ', array_diff($files, ['.', '..'])) . "\n";
}

echo "\n=== End Test ===\n";
?>
