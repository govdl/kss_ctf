<?php
session_start();
$db = new PDO('sqlite:database.db');

// 게시글 목록 가져오기
$posts = $db->query("SELECT * FROM posts")->fetchAll(PDO::FETCH_ASSOC);

foreach ($posts as $post) {
    echo "<li><h3>" . htmlspecialchars($post['title']) . "</h3><p>" . htmlspecialchars($post['content']) . "</p></li>";
}
?>
