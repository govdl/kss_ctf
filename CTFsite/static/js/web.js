function selectProblem(problemNumber) {
    localStorage.setItem("currentProblem", problemNumber);
    window.location.href = "list.html";
}
