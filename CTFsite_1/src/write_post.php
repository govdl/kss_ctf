<?php
session_start();
$db = new PDO('sqlite:database.db');

// 게시글 작성 처리
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $db->prepare("INSERT INTO posts (title, content) VALUES (:title, :content)");
    $stmt->execute([':title' => $title, ':content' => $content]);

    echo "게시글이 작성되었습니다.";
}
?>
