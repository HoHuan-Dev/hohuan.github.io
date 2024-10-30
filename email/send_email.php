<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone = htmlspecialchars($_POST['phone']);
    $captcha = htmlspecialchars($_POST['captcha']);
    $to = "antinet.mac@gmail.com";
    $subject = "Liên hệ từ $name";
    $message = "Họ tên: $name\nEmail: $email\nSố điện thoại: $phone";

    // Kiểm tra CAPTCHA
    if ($captcha != "7") {
        die("Sai CAPTCHA!");
    }

    // Kiểm tra file đính kèm
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $file = $_FILES['file'];
        $fileSize = $file['size'];
        $fileTmp = $file['tmp_name'];
        $fileType = $file['type'];
        $fileName = $file['name'];
        
        // Kiểm tra kích thước file
        if ($fileSize > 2 * 1024 * 1024) {
            die("File đính kèm quá lớn. Vui lòng chọn file dưới 2MB.");
        }

        // Đường dẫn tạm thời để lưu file
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $filePath = $uploadDir . basename($fileName);

        // Lưu file
        if (move_uploaded_file($fileTmp, $filePath)) {
            $message .= "\nFile đính kèm: " . $filePath;
        } else {
            die("Có lỗi xảy ra khi upload file.");
        }
    } else {
        die("Vui lòng chọn file đính kèm.");
    }

    // Gửi email
    $headers = "From: $email";
    if (mail($to, $subject, $message, $headers)) {
        echo "Email đã được gửi thành công!";
    } else {
        echo "Có lỗi xảy ra khi gửi email.";
    }
} else {
    echo "Yêu cầu không hợp lệ.";
}
?>
