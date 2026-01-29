<?php
/**
 * Wedding Slip Upload Handler
 * บันทึกสลิปการโอนเงิน
 */

header('Content-Type: application/json; charset=utf-8');

// ตั้งค่า
$uploadDir = __DIR__ . '/uploads/';
$dataFile = __DIR__ . '/slips.json';
$maxFileSize = 5 * 1024 * 1024; // 5MB
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

// สร้างโฟลเดอร์ถ้ายังไม่มี
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// ตรวจสอบ request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// ตรวจสอบว่ามีไฟล์หรือไม่
if (!isset($_FILES['slip']) || $_FILES['slip']['error'] !== UPLOAD_ERR_OK) {
    $errorMessages = [
        UPLOAD_ERR_INI_SIZE => 'ไฟล์มีขนาดใหญ่เกินไป',
        UPLOAD_ERR_FORM_SIZE => 'ไฟล์มีขนาดใหญ่เกินไป',
        UPLOAD_ERR_PARTIAL => 'อัพโหลดไฟล์ไม่สมบูรณ์',
        UPLOAD_ERR_NO_FILE => 'กรุณาเลือกไฟล์สลิป',
    ];
    $errorCode = $_FILES['slip']['error'] ?? UPLOAD_ERR_NO_FILE;
    $message = $errorMessages[$errorCode] ?? 'เกิดข้อผิดพลาดในการอัพโหลด';
    
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $message]);
    exit;
}

$file = $_FILES['slip'];

// ตรวจสอบขนาดไฟล์
if ($file['size'] > $maxFileSize) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'ไฟล์มีขนาดใหญ่เกิน 5MB']);
    exit;
}

// ตรวจสอบประเภทไฟล์
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mimeType = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);

if (!in_array($mimeType, $allowedTypes)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'รองรับเฉพาะไฟล์รูปภาพ (JPG, PNG, GIF, WebP)']);
    exit;
}

// รับข้อมูลผู้โอน
$name = trim($_POST['name'] ?? '');
$amount = trim($_POST['amount'] ?? '');
$message = trim($_POST['message'] ?? '');

if (empty($name)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'กรุณาระบุชื่อผู้โอน']);
    exit;
}

// สร้างชื่อไฟล์ใหม่
$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
$newFileName = date('Ymd_His') . '_' . uniqid() . '.' . $extension;
$targetPath = $uploadDir . $newFileName;

// ย้ายไฟล์
if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'ไม่สามารถบันทึกไฟล์ได้']);
    exit;
}

// บันทึกข้อมูลลง JSON
$slipData = [
    'id' => uniqid(),
    'name' => $name,
    'amount' => $amount,
    'message' => $message,
    'filename' => $newFileName,
    'original_name' => $file['name'],
    'uploaded_at' => date('Y-m-d H:i:s'),
    'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
];

// อ่านข้อมูลเดิม
$slips = [];
if (file_exists($dataFile)) {
    $content = file_get_contents($dataFile);
    $slips = json_decode($content, true) ?? [];
}

// เพิ่มข้อมูลใหม่
$slips[] = $slipData;

// บันทึกกลับ
if (file_put_contents($dataFile, json_encode($slips, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) === false) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'ไม่สามารถบันทึกข้อมูลได้']);
    exit;
}

// สำเร็จ
echo json_encode([
    'success' => true, 
    'message' => 'ขอบคุณสำหรับของขวัญ 💝 บันทึกสลิปเรียบร้อยแล้ว',
    'data' => [
        'name' => $name,
        'uploaded_at' => $slipData['uploaded_at']
    ]
]);
