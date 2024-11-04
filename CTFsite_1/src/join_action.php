<?php
// 데이터베이스 연결 설정
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

// MySQL 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 사용자가 입력한 값 가져오기
$user_id = $_POST['id'];
$email = $_POST['email'];
$user_password = $_POST['password'];

$hashed_password = password_hash($user_password, PASSWORD_DEFAULT); //비밀번호 해시로 저장

// 데이터베이스에 사용자 정보 삽입
$sql = "INSERT INTO login_table (id, email, password) VALUES ('$user_id', '$email', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('회원가입 성공!'); window.location.href='../templates/main.html';</script>"; //리디렉션
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
