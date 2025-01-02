function loginUser(event) {
    event.preventDefault(); // 폼 제출 방지
  
    const userId = document.getElementById("id").value; // ID 입력 필드
    const password = document.getElementById("password").value; // PW 입력 필드
  
    // 서버와의 통신을 위한 AJAX 요청
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../src/login_action.php", true); // login_action.php 파일로 요청
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  
    xhr.onload = function () {
      if (xhr.status === 200) {
        const response = JSON.parse(xhr.responseText); // 서버에서 반환된 JSON 응답
  
        if (response.success) {
          // 로그인 성공 시 localStorage에 로그인 상태와 사용자 ID 저장
          localStorage.setItem("isLoggedIn", "true"); // 로그인 상태 저장
          localStorage.setItem("userId", response.userId); // 서버에서 받은 userId 저장
  
          // 로그인 성공 후 main.html로 리디렉션
          window.location.href = "../templates/main.html";
        } else {
          alert(response.message); // 로그인 실패 메시지 표시
        }
      } else {
        alert("서버와의 통신 중 문제가 발생했습니다.");
      }
    };
  
    // 서버로 로그인 정보 전송
    xhr.send(
      "id=" +
        encodeURIComponent(userId) +
        "&password=" +
        encodeURIComponent(password)
    );
  }
  
  // 로그인 폼 이벤트 리스너 등록
  document.getElementById("loginForm").addEventListener("submit", loginUser);