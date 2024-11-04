<?php
session_start();


// 데이터베이스 연결 설정
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

// MySQL 연결
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 사용자가 입력한 새 비밀번호
$new_password = $_POST['newPassword'];
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT); // 비밀번호 해시

// 세션에서 사용자 ID 가져오기
$user_id = $_SESSION['id'];

// 비밀번호 업데이트
$sql = "UPDATE users SET password = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $hashed_password, $user_id);

if ($stmt->execute()) {
    echo "<script>alert('비밀번호가 성공적으로 변경되었습니다.'); location.href='./mypage.php';</script>";
} else {
    echo "<script>alert('비밀번호 변경에 실패했습니다. 다시 시도해주세요.'); location.href='./mypage.php';</script>";
}

$conn->close();
?>

