let points = parseInt(localStorage.getItem("points")) || 0;

function checkFlag() {
    const flag = document.getElementById("flag").value;
    const correctFlag = "FLAG123"; // 정답으로 설정할 플래그
    const submitButton = document.querySelector("button"); // 제출 버튼 선택

    if (flag === correctFlag) {
        points += 10; // 정답일 경우 포인트 추가
        localStorage.setItem("points", points);
        document.getElementById("feedback").innerText = "정답입니다! 다음 문제를 푸세요.";
        
        // 다음 문제 잠금 해제
        let nextProblem = parseInt(localStorage.getItem("currentProblem")) + 1;
        const nextProblemButton = document.getElementById("q" + nextProblem);
        if (nextProblemButton) {
            nextProblemButton.classList.remove("locked");
        }
        submitButton.style.display = "none";  // 제출 버튼 숨기기
    } else {
        alert('실패했습니다. 다시 시도하세요.');
    }

    document.getElementById("pointValue").innerText = points; // 포인트 업데이트
}

