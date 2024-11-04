<?php
session_start();

// 데이터베이스 연결 설정
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

// MySQL 데이터베이스 연결
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// POST로 받은 사용자 입력 값
$id = $_POST['id'];
$password = $_POST['password'];

// SQL 인젝션 방지
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
    // 입력된 비밀번호와 DB의 해시된 비밀번호 비교
    if (password_verify($password, $row['password'])) {
        // 세션에 사용자 정보 저장
        $_SESSION['userId'] = $row['id'];

        // 로그인 성공 후 사용자 ID를 URL 파라미터로 전달
        header("Location: ../templates/main.html?userId=" . urlencode($row['id']));
        exit();
    } else {
        // 비밀번호 불일치
        echo "<script>alert('비밀번호가 일치하지 않습니다. 다시 시도해 주세요.'); window.history.back();</script>";
        exit();
    }
} else {
    // 사용자가 존재하지 않음
    echo "<script>alert('ID가 존재하지 않습니다. 다시 시도해 주세요.'); window.history.back();</script>";
    exit();
}

// 연결 종료
$conn->close();
?>
