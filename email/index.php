<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Liên Hệ</title>
</head>
<body>
    <h1>Liên Hệ</h1>
    <form action="send_email.php" method="post" enctype="multipart/form-data">
        <label for="name">Họ tên:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Số điện thoại:</label><br>
        <input type="tel" id="phone" name="phone" required><br><br>

        <label for="file">File đính kèm:</label><br>
        <input type="file" id="file" name="file" accept=".jpg,.jpeg,.png,.pdf" required><br><br>

        <label for="captcha">CAPTCHA: 3 + 4 = ?</label><br>
        <input type="text" id="captcha" name="captcha" required><br><br>

        <input type="submit" value="Gửi">
    </form>
</body>
</html>
