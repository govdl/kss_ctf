// 비밀번호 변경 후 메시지 업데이트
document.getElementById('changePasswordForm').onsubmit = function(event) {
    event.preventDefault(); // 기본 폼 제출 방지
    const formData = new FormData(this);
    fetch('change_password.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(message => {
        document.getElementById('passwordChangeMessage').innerText = message;
    });
};

// 게시글 작성 후 목록 업데이트
document.getElementById('writePostForm').onsubmit = function(event) {
    event.preventDefault(); // 기본 폼 제출 방지
    const formData = new FormData(this);
    fetch('write_post.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(message => {
        document.getElementById('postMessage').innerText = message;
        loadPosts(); // 게시글 목록 새로 고침
    });
};

// 게시글 목록 로드
function loadPosts() {
    fetch('get_posts.php')
    .then(response => response.text())
    .then(postsHTML => {
        document.getElementById('postList').innerHTML = postsHTML;
    });
}

// 페이지 로드 시 게시글 목록 가져오기
window.onload = loadPosts;
